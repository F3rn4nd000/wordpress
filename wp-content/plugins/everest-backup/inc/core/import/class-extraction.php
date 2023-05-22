<?php
/**
 * Handle file extraction during import.
 *
 * @package EverestBackup
 */

namespace Everest_Backup\Core\Import;

use Everest_Backup\Core\Archiver;
use Everest_Backup\Filesystem;
use Everest_Backup\Logs;
use Everest_Backup\Traits\Import;

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Extraction {

	use Import;

	private static function normalize_file_contents( $filepath, $find_and_replace ) {

		if ( false !== strpos( $filepath, LANGDIR ) ) {
			//Bail if we are inside language directory.
			return;
		}

		if ( ! is_file( $filepath ) ) {
			return;
		}

		return @file_put_contents( $filepath, strtr( @file_get_contents( $filepath ), $find_and_replace ) );
	}

	private static function run() {

		$metadata = self::get_metadata();

		if ( empty( $metadata['FilePath'] ) ) {
			throw new \Exception( __( 'Archive file path missing from metadata. Aborting restore.', 'everest-backup' ) );
		}

		Logs::info( __( 'Restoring files', 'everest-backup' ) );

		$timer_start = time();

		$stats = $metadata['stats'];

		$archiver = new Archiver( $metadata['FilePath'] );

		if ( $archiver->open( 'rb' ) ) {

			$find_and_replace = self::get_find_replace();

			$type   = ''; // Current folder type, "others" means wp-content folder root.
			$path   = '';
			$count  = 1;
			$handle = false;

			while ( ! gzeof( $archiver->get_ziphandle() ) ) {
				$line = gzgets( $archiver->get_ziphandle() );

				/**
				 * First step for extraction.
				 * ===============================================
				 * Find file start.
				 * If found, then set handle and move to next line.
				 * ===============================================
				 */
				if ( false !== strpos( $line, 'EBWPFILE_START:' ) ) {
					$path = trim( str_replace( 'EBWPFILE_START:', '', $line ) );
					$path = str_replace( chr( 0 ), '', $path ); // Fix for null byte issue.

					if ( false !== strpos( $path, 'ebwp-files' ) ) {
						$type = 'ebwp-files';
						$path = everest_backup_current_request_storage_path( $path );
					} else {
						$_type = strstr( $path, '/' , true );

						$type = $_type ? $_type : 'others';
						$path = wp_normalize_path( WP_CONTENT_DIR . '/' . $path );
					}

					$dir = dirname( $path );

					if ( ! is_dir( $dir ) ) {
						Filesystem::init()->mkdir_p( $dir );
					}

					if ( file_exists( $path ) ) {
						@unlink( $path );
					}

					$handle = @fopen( $path, 'wb' );
					continue;
				}

				/**
				 * Third step for extraction.
				 * ========================================
				 * If we are end of current extrating file,
				 * then close the handle and release memory.
				 * If the archive still has other lines,
				 * then move to new line.
				 * ========================================
				 */
				if ( false !== strpos( $line, 'EBWPFILE_END:' ) ) {
					if ( is_resource( $handle ) ) {
						fclose( $handle );
					}

					if ( 'others' === $type ) {
						self::normalize_file_contents( $path, $find_and_replace );
					}

					$calc     = ( $count / $stats['total'] ) * 100 ;
					$progress = $calc > 100 ? 100 : $calc;

					$count++;

					Logs::set_proc_stat(
						array(
							'status'   => 'in-process',
							'progress' => round( $progress * 0.3 + 30, 2 ), // At the end, it is always going to be 60%
							'message'  => sprintf(
								__( 'Restoring files [ %1$s ] : %2$d%% completed', 'everest-backup' ),
								esc_html( ucwords( str_replace( '-', ' ', $type ) ) ),
								esc_html( $progress )
							),
							'detail' => sprintf( __( 'Restored: %1$s out of %2$s', 'everest-backup' ), esc_html( $count ), esc_html( $stats['total'] ) )
						)
					);

					$type   = '';
					$line   = '';
					$path   = '';
					$handle = false;

					continue;
				}

				/**
				 * Second step for extraction.
				 * ===============================
				 * As long as our handle is set,
				 * keep writing data of that file.
				 * ===============================
				 */
				if ( $handle ) {
					fwrite( $handle, $line );
				}

			}

			$archiver->close();

		}

		Logs::set_proc_stat(
			array(
				'log'      => 'info',
				'status'   => 'in-process',
				'progress' => 60,
				'message'  => sprintf(
					__( 'Restored %1$d files. Time taken: %2$s', 'everest-backup' ),
					esc_html( $stats['total'] ),
					esc_html( human_time_diff( $timer_start ) )
				),
				'detail' => __( 'Removing uploaded archive file', 'everest-backup' ),
				'next'   => 'wrapup' // Set next.
			)
		);

		unlink( $metadata['FilePath'] );
	}

}

