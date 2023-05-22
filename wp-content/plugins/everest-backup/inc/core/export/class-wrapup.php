<?php
/**
 * Core export Wrapup class file.
 *
 * @package Everest_Backup
 */

namespace Everest_Backup\Core\Export;

use Everest_Backup\Core\Archiver;
use Everest_Backup\Filesystem;
use Everest_Backup\Logs;
use Everest_Backup\Modules\Migration;
use Everest_Backup\Tags;
use Everest_Backup\Traits\Export;

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Wrapup {

	use Export;

	private static function delete_from_server( $zip ) {

		if ( ! file_exists( $zip ) ) {
			return;
		}

		$params = self::read_config( 'Params' );

		/**
		 * Filter hook to avoid delete from server if the cloud upload fails.
		 * Return true if you want to avoid the delete from server.
		 *
		 * @since 1.1.5
		 */
		if ( true === apply_filters( 'everest_backup_avoid_delete_from_server', false ) ) {
			return;
		}

		if ( empty( $params['save_to'] ) ) {
			return;
		}

		if ( 'server' === $params['save_to'] ) {
			return;
		}

		if ( empty( $params['delete_from_server'] ) ) {
			return;
		}

		Logs::info( __( 'Deleting the backup file from the server.', 'everest-backup' ) );

		/**
		 * Filesystem class object.
		 *
		 * @var Filesystem
		 */
		$filesystem = Filesystem::init();

		$filesystem->delete( $zip );

	}

	private static function files_stats( $listpath ) {
		$total = 0;
		$size  = 0;

		$handle = fopen( $listpath, "r" );

		if ( is_resource( $handle ) ) {
			while( !feof( $handle ) ){
				$line = fgets( $handle );

				if ( ! $line ) {
					continue;
				}

				$line = trim( $line );

				if ( ! file_exists( $line ) ) {
					continue;
				}

				if ( 'ebwp' === pathinfo( $line, PATHINFO_EXTENSION ) ) {
					continue;
				}

				$size += filesize( $line );
				$total++;

				$line = '';
			}

			fclose( $handle );

			$handle = false;
		}

		return compact( 'total', 'size' );

	}

	private static function run() {

		Logs::set_proc_stat(
			array(
				'log'      => 'info',
				'status'   => 'in-process',
				'progress' => 80,
				'message'  => __( 'Wrapping things up', 'everest-backup' ),
			)
		);

		$zip = self::get_archive_path();

		$listpath = everest_backup_current_request_storage_path( self::$LISTFILENAME );

		if ( ! file_exists( $listpath ) ) {
			throw new \Exception( __( 'Files list not found, aborting backup.', 'everest-backup' ) );
		}

		Logs::set_proc_stat(
			array(
				'log'      => 'info',
				'status'   => 'in-process',
				'progress' => 80,
				'message'  => __( 'Checking available space', 'everest-backup' ),
			)
		);

		sleep( 1 );

		$stats = self::files_stats( $listpath );

		if ( ! everest_backup_is_space_available( EVEREST_BACKUP_BACKUP_DIR_PATH, $stats['size'] ) ) {
			throw new \Exception( __( 'Required space not available, aborting backup.', 'everest-backup' ) );
		}

		Logs::set_proc_stat(
			array(
				'log'      => 'info',
				'status'   => 'in-process',
				'progress' => 80,
				'message'  => __( 'Space available, archiving files', 'everest-backup' ),
			)
		);

		$archiver = new Archiver( $zip );

		if ( $archiver->open() ) {

			$archiver->set_metadata(
				array(
					'stats'      => $stats,
					'filename'   => self::get_archive_name(),
					'request_id' => everest_backup_current_request_id(),
					'tags'       => everest_backup_generate_tags_from_params( self::read_config( 'Params' ) ),
					'config'     => self::read_config(),
				)
			);

			$handle = fopen( $listpath, "r" );

			if ( is_resource( $handle ) ) {

				$count = 1;

				while( !feof( $handle ) ){
					$line = fgets( $handle );

					if ( ! $line ) {
						continue;
					}

					$filepath = trim( $line );

					if ( ! file_exists( $filepath ) ) {
						continue;
					}

					if ( 'ebwp' === pathinfo( $line, PATHINFO_EXTENSION ) ) {
						continue;
					}

					if ( $archiver->add_file( $filepath ) ) {

						$progress = ( $count / $stats['total'] ) * 100;

						Logs::set_proc_stat(
							array(
								'status'   => 'in-process',
								'progress' => round( $progress * 0.2 + 80, 2 ), // Starts from 80 ends at 100.
								'message'  => sprintf(
									__( 'Archiving files: %d%% completed', 'everest-backup' ),
									esc_html( $progress )
								),
								'detail' => sprintf( __( 'Archived: %1$s out of %2$s', 'everest-backup' ), esc_html( $count ), esc_html( $stats['total'] ) )
							)
						);

						$count++;

					}

					$line = '';
				}

				fclose( $handle );

				$handle = false;
			}

			$archiver->close();

		}

		$migration = new Migration(
			array(
				'file'       => basename( $zip ),
				'auto_nonce' => true,
			)
		);

		$time_elapsed = everest_backup_is_debug_on() ? time() - everest_backup_current_request_timestamp() . ' seconds' : human_time_diff( everest_backup_current_request_timestamp() );

		Logs::info( sprintf( __( 'Time elapsed: %s', 'everest-backup'  ), $time_elapsed ) );

		Logs::info( sprintf( __( 'File size: %s', 'everest-backup' ), esc_html( everest_backup_format_size( filesize( $zip ) ) ) ) );

		Logs::done( __( 'Backup completed', 'everest-backup' ) );

		do_action( 'everest_backup_after_zip_done', $zip, $migration->get_url() );

		self::delete_from_server( $zip );

		everest_backup_send_success(
			array(
				'zipurl'        => everest_backup_convert_file_path_to_url( $zip ),
				'migration_url' => $migration->get_url(),
			)
		);

	}

}
