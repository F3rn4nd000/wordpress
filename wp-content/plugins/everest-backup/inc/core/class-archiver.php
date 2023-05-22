<?php
/**
 * New core archiver for version 2.0.0 and above.
 *
 * @package Everest_Backup
 */

namespace Everest_Backup\Core;

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class Archiver {

	private static $READ_LIMIT = KB_IN_BYTES * 512; // 512 KB

	private $zippath = null;

	private $ziphandle = null;

	public function __construct( $zippath = null ) {
		$this->set_zippath( $zippath );
	}

	protected function get_entryname( $file ) {

		$file = wp_normalize_path( $file );

		/**
		 * Special treatments for the files generated from Everest Backup.
		 * Handling these things during backup will help us during restore.
		 */
		if ( false !== strpos( $file, EVEREST_BACKUP_TEMP_DIR_PATH ) ) {
			if ( false !== strpos( $file, 'ebwp-database' ) ) {
				return str_replace( trailingslashit( dirname( $file, 2 ) ), 'ebwp-files/', $file );
			}

			return str_replace( trailingslashit( dirname( $file ) ), 'ebwp-files/', $file ); // These are probably our config files.
		}

		return str_replace( trailingslashit( wp_normalize_path( untrailingslashit( WP_CONTENT_DIR ) ) ), '', $file );

	}

	public function set_zippath( $zippath ) {
		$this->zippath = wp_normalize_path( $zippath );
	}

	public function get_ziphandle() {
		return $this->ziphandle;
	}

	public function open( $mode = 'wb' ) {
		$this->ziphandle = gzopen( $this->zippath, $mode );

		if ( ! is_resource( $this->ziphandle ) ) {
			return false;
		}

		return true;
	}

	public function add_file( $file ) {

		$file = wp_normalize_path( $file );

		if ( ! is_file( $file ) || ! is_readable( $file ) ) {
			return false;
		}

		$path = $this->get_entryname( $file );

		$handle = fopen( $file, 'rb' );

		gzwrite( $this->ziphandle, "EBWPFILE_START:{$path}\n" );

		while ( ! feof( $handle ) ) {
			gzwrite( $this->ziphandle, fread( $handle, self::$READ_LIMIT ) );
		}

		gzwrite( $this->ziphandle, "\nEBWPFILE_END:{$path}\n" );

		return fclose( $handle );
	}

	public function close() {
		return gzclose( $this->ziphandle );
	}

	public function set_metadata( $metadata = array() ) {

		if ( ! is_resource( $this->ziphandle ) ) {
			return;
		}

		$metajson = wp_json_encode( $metadata );
		gzwrite( $this->ziphandle, "EBWPFILE_METADATA:{$metajson}\n" );
	}

	public function get_metadatas() {

		static $metadata;

		if ( ! $metadata ) {
			if ( $this->open( 'r' ) ) {
				$metajson = ltrim( gzgets( $this->ziphandle ), 'EBWPFILE_METADATA:' );
				$this->close();

				$metadata = json_decode( $metajson, true );
			}
		}

		return $metadata;
	}

	public function get_metadata( $key ) {
		$metadata = $this->get_metadatas();
		return isset( $metadata[ $key ] ) ? $metadata[ $key ] : null;
	}
}