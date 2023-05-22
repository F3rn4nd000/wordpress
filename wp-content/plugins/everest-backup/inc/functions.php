<?php
/**
 * Functions and definitions for Everest Backup plugin.
 *
 * @package everest-backup
 */

use Everest_Backup\Backup_Directory;
use Everest_Backup\Filesystem;
use Everest_Backup\Logs;
use Everest_Backup\Modules\Cloner;
use Everest_Backup\Transient;
use Everest_Backup\Proc_Lock;
use Everest_Backup\Temp_Directory;

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns SSE URL conditionally.
 *
 * @return string
 * @since 2.0.0
 */
function everest_backup_get_sse_url() {

	$sse_url = set_url_scheme( EVEREST_BACKUP_BACKUP_DIR_URL . '/sse.php', 'admin' );

	$response_code = absint( wp_remote_retrieve_response_code( wp_remote_head( $sse_url ) ) );

	return 200 === $response_code ? $sse_url : admin_url( '/admin-ajax.php?action=everest_process_status' );
}

function everest_backup_get_logger_speed() {
	static $speed;

	if ( ! $speed ) {
		$proc_lock = Proc_Lock::get();
		if ( ! empty( $proc_lock['logger_speed'] ) ) {
			$speed = absint( $proc_lock['logger_speed'] );
		} else {
			$general = everest_backup_get_settings( 'general' );
			$speed   = ! empty( $general['logger_speed'] ) ? absint( $general['logger_speed'] ) : 200;
		}
	}

	return $speed;
}

function everest_backup_is_gzip_lib_enabled() {
	if ( ! function_exists( 'gzopen' ) ) {
		return false;
	}

	return everest_backup_is_php_function_enabled( 'gzopen' );
}

/**
 * Returns current request ID.
 *
 * @return string
 * @since 2.0.0
 */
function everest_backup_current_request_id() {

	static $id;

	if ( ! $id ) {
		$proc_lock = Proc_Lock::get();
		$id = ! empty( $proc_lock['request_id'] ) ? sanitize_text_field( $proc_lock['request_id'] ) : uniqid();
	}

	return $id;

}

/**
 * Returns current timestamp.
 *
 * @return string
 * @since 2.0.0
 */
function everest_backup_current_request_timestamp() {

	static $timestamp;

	if ( ! $timestamp ) {
		$proc_lock = Proc_Lock::get();
		$timestamp = ! empty( $proc_lock['time'] ) ? absint( $proc_lock['time'] ) : time();
	}

	return $timestamp;

}

/**
 * Returns path to current request storage directory.
 *
 * @return string
 */
function everest_backup_current_request_storage_path( $to = '' ) {

	static $path;

	if ( ! $path ) {
		$path = untrailingslashit( Temp_Directory::init()->join_path( everest_backup_current_request_id() ) );
		if ( ! is_dir( $path ) ) {
			Filesystem::init()->mkdir_p( $path );
		}
	}

	return wp_normalize_path( trailingslashit( $path ) . $to );
}

/**
 * Returns changelog as array.
 *
 * @return array
 * @since 1.1.7
 */
function everest_backup_parsed_changelogs() {

	$transient = new Transient( 'changelogs' );

	$changelogs = $transient->get();

	if ( $changelogs ) {
		return $changelogs;
	}

	$tags_matches = array();

	preg_match_all(
	"/(a href\=\")([^\?\"]*)(\")/i",
	wp_remote_retrieve_body(
		wp_remote_get(
			set_url_scheme( 'http://plugins.svn.wordpress.org/everest-backup/tags' ),
			array(
				'sslverify' => false
				)
			)
		),
		$tags_matches
	);

	$version_dates = array();

	if ( ! empty( $tags_matches[2] ) ) {
		if ( is_array( $tags_matches[2] ) && ! empty( $tags_matches[2] ) ) {
			foreach ( $tags_matches[2] as $maybe_dir ) {

				if ( ! absint( $maybe_dir[0] ) ) {
					continue;
				}

				$version_response = wp_remote_get(
					set_url_scheme( "http://plugins.svn.wordpress.org/everest-backup/tags/{$maybe_dir}readme.txt" ),
					array(
						'sslverify' => false
					)
				);

				$version_dates[ 'v' . str_replace( '/', '', $maybe_dir ) ] = wp_remote_retrieve_header( $version_response, 'last-modified' );

			}
		}
	}

	$response = wp_remote_get(
		set_url_scheme( 'https://plugins.svn.wordpress.org/everest-backup/trunk/changelog.txt' ),
		array(
			'sslverify' => false
		)
	);

	$body     = wp_remote_retrieve_body( $response );
	$body     = str_replace( "\r\n", "\n", $body );
	$contents = $body ? explode( "\n", $body ) : array();

	if ( ! isset( $contents[0] ) ) {
		$contents = Filesystem::init()->get_file_content( EVEREST_BACKUP_PATH . 'changelog.txt', 'array' );
	}

	unset( $contents[0] );

	$contents = array_values( array_filter( array_map( 'trim', $contents ) ) );

	$version = '';

	if ( is_array( $contents ) && ! empty( $contents ) ) {
		foreach ( $contents as $content ) {
			preg_match('/=([^=]+)=/', $content, $match);

			if ( ! empty( $match[1] ) ) {
				$version = trim( $match[1] );
			} else {
				$changelogs[ $version ]['release_date'] = ! empty( $version_dates[ $version ] ) ? $version_dates[ $version ] : '';
				$changelogs[ $version ]['changes'][]    = $content;
			}
		}
	}

	$transient->set( $changelogs, DAY_IN_SECONDS );

	return $changelogs;

}

/**
 * Returns last key of array.
 *
 * @param array $array
 * @return string|int|null
 * @since 1.0.4
 */
function everest_backup_array_key_last( $array ) {

	if ( ! $array || ! is_array( $array ) ) {
		return null;
	}

	if ( function_exists( 'array_key_last' ) ) {
		return array_key_last( $array );
	} else {
		end( $array );
		return key( $array );
	}
}

/**
 * Filter out excluded plugins from plugins list.
 *
 * @return array
 * @since 1.1.4
 */
function everest_backup_filter_plugin_list( $plugin_lists ) {

	if ( ! $plugin_lists || ! is_array( $plugin_lists ) ) {
		return array();
	}

	$excluded = array();

	if ( ! is_ssl() || everest_backup_is_localhost() ) {
		// SSL related plugins.
		$excluded[] = 'really-simple-ssl/rlrsssl-really-simple-ssl.php';
		$excluded[] = 'wordpress-https/wordpress-https.php';
		$excluded[] = 'wp-force-ssl/wp-force-ssl.php';
		$excluded[] = 'force-https-littlebizzy/force-https.php';
	}

	$excluded[] = 'invisible-recaptcha/invisible-recaptcha.php';
	$excluded[] = 'wps-hide-login/wps-hide-login.php';
	$excluded[] = 'hide-my-wp/index.php';
	$excluded[] = 'hide-my-wordpress/index.php';
	$excluded[] = 'mycustomwidget/my_custom_widget.php';
	$excluded[] = 'lockdown-wp-admin/lockdown-wp-admin.php';
	$excluded[] = 'rename-wp-login/rename-wp-login.php';
	$excluded[] = 'wp-simple-firewall/icwp-wpsf.php';
	$excluded[] = 'join-my-multisite/joinmymultisite.php';
	$excluded[] = 'multisite-clone-duplicator/multisite-clone-duplicator.php';
	$excluded[] = 'wordpress-mu-domain-mapping/domain_mapping.php';
	$excluded[] = 'wordpress-starter/siteground-wizard.php';
	$excluded[] = 'pro-sites/pro-sites.php';
	$excluded[] = 'wpide/WPide.php';
	$excluded[] = 'page-optimize/page-optimize.php';
	$excluded[] = 'wp-hide-security-enhancer/wp-hide.php'; // @since 2.0.0

	return array_diff( $plugin_lists, $excluded );
}


/**
 * Directly clone and restore package using provided migration key.
 *
 * @requires AJAX
 * @since 1.1.4
 */
function everest_backup_direct_clone( $migration_key ) {
	if ( ! $migration_key ) {
		return;
	}

	$_REQUEST['verify_key']    = true;
	$_REQUEST['migration_key'] = $migration_key;
	$_REQUEST['ebwp_migration_nonce'] = everest_backup_create_nonce( 'ebwp_migration_nonce' );

	$cloner = new Cloner();
	$cloner->handle_migration_key();

	$key_info = $cloner->get_key_info();

	if ( ! $key_info ) {
		return;
	}

	$_REQUEST = array(
		'action'                    => EVEREST_BACKUP_IMPORT_ACTION,
		'everest_backup_ajax_nonce' => everest_backup_create_nonce( 'everest_backup_ajax_nonce' ),
		'ebwp_migration_nonce'      => everest_backup_create_nonce( 'ebwp_migration_nonce' ),
		'page'                      => 'everest-backup-migration_clone',
		'file'                      => $key_info['name'],
		'size'                      => $key_info['size'],
		'download_url'              => $key_info['url'],
		'cloud'                     => 'server',
	);

	define( 'EVEREST_BACKUP_DOING_CLONE', true );
	define( 'EVEREST_BACKUP_DOING_ROLLBACK', true );

	do_action( 'wp_ajax_' . EVEREST_BACKUP_IMPORT_ACTION );
}

if ( ! function_exists( 'everest_backup_compress_init' ) ) {

	/**
	 * Pluggable function to initialize backup/compression.
	 *
	 * @param array $args [Optional] Arguments for compress.
	 * @since 1.1.2
	 */
	function everest_backup_compress_init( $args = array() ) {

		$_args = wp_parse_args(
			$args,
			array(
				'type'              => 'backup',
				'params'            => array(),
				'disable_send_json' => false,
			)
		);

		$params = ! empty( $_args['params'] ) ? $_args['params'] : everest_backup_get_ajax_response( EVEREST_BACKUP_EXPORT_ACTION );

		if ( empty( $params['next'] ) ) {
			Logs::init( $_args['type'] );
		}

		if ( true === $_args['disable_send_json'] ) {
			add_filter( 'everest_backup_disable_send_json', '__return_true' );
		}

		$_REQUEST['t']                         = time();
		$_REQUEST['action']                    = EVEREST_BACKUP_EXPORT_ACTION;
		$_REQUEST['everest_backup_ajax_nonce'] = everest_backup_create_nonce( 'everest_backup_ajax_nonce' );

		do_action( 'wp_ajax_' . EVEREST_BACKUP_EXPORT_ACTION, $params );

		$res = json_decode( wp_remote_retrieve_body( wp_remote_get( everest_backup_get_sse_url() ) ), true );

		if ( empty( $res['status'] ) ) {
			return;
		}

		if ( 'in-process' === $res['status'] ) {
			$_args['params'] = $res && is_array( $res ) ? $res : array();
			return everest_backup_compress_init( $_args );
		}

	}
}

/**
 * Wrapper for disk_free_space.
 *
 * @param string $directory A directory of the filesystem or disk partition.
 * @return float|false
 * @since 1.0.9
 */
function everest_backup_disk_free_space( $directory ) {
	if ( function_exists( 'disk_free_space' ) ) {
		return @disk_free_space( $directory ); // @phpcs:ignore
	}
}

/**
 * Checks disk free space.
 *
 * @param string $directory A directory of the filesystem or disk partition.
 * @param string $size Size to check in directory.
 * @return boolean
 * @since 1.0.9
 */
function everest_backup_is_space_available( $directory, $size, $log_warning = true ) {
	$enabled = everest_backup_is_php_function_enabled( 'disk_free_space' );

	if ( $enabled ) {
		return everest_backup_disk_free_space( $directory ) > $size;
	} else {

		if ( $log_warning ) {
			Logs::warn( __( 'Disk free space function is disabled by hosting.', 'everest-backup' ) );
			Logs::warn( __( 'Using dummy file to check free space (it can take some time).', 'everest-backup' ) );
		}

		return Filesystem::init()->custom_check_free_space( $directory, $size );
	}
}

/**
 * Check if php function is enabled or disabled in 'disable_functions' list.
 *
 * @param string $function_name
 * @return bool
 * @since 1.1.4
 */
function everest_backup_is_php_function_enabled( $function_name ) {
	$disabled = explode( ',', ini_get( 'disable_functions' ) );
	return ! in_array( $function_name, array_map( 'trim', $disabled ), true );
}

/**
 * Returns true if any process related to Everest Backup is running.
 *
 * @return bool
 * @since 1.0.7
 */
function everest_backup_is_process_running() {
	return ! empty( Proc_Lock::get() );
}

/**
 * Formats bytes to human readable size format.
 *
 * @param int $bytes Number of bytes. Note max integer size for integers.
 * @return string|false
 * @since 1.0.7
 * @uses size_format();
 */
function everest_backup_format_size( $bytes ) {
	return size_format( $bytes, 2 );
}

/**
 * Returns the slug of WordPress core theme.
 *
 * @return string
 * @since 1.0.7
 */
function everest_backup_get_fallback_theme() {
	$core_theme = \WP_Theme::get_core_default_theme();

	if ( ! $core_theme ) {
		return;
	}

	return $core_theme->get_stylesheet();
}

/**
 * Checks if current page is being reloaded.
 *
 * @return boolean
 */
function everest_backup_is_reloading() {
	return ! empty( $_SERVER['HTTP_CACHE_CONTROL'] )
	&& ( ( 'no-cache' === $_SERVER['HTTP_CACHE_CONTROL'] ) || ( 'max-age=0' === $_SERVER['HTTP_CACHE_CONTROL'] ) );
}

/**
 * Checks if current page is Everest Backup page.
 *
 * @return boolean
 */
function everest_backup_is_ebwp_page() {
	$get = everest_backup_get_submitted_data( 'get' );

	if ( ! isset( $get['page'] ) ) {
		return;
	}

	if ( false === strstr( $get['page'], 'everest-backup' ) ) {
		return;
	}

	return true;

}

/**
 * Activate Everest Backup related plugin.
 * Wrapper function for `activate_plugin()`.
 *
 * @param string $plugin Path to the plugin file relative to the plugins directory.
 * @return null|\WP_Error
 * @since 1.0.5
 */
function everest_backup_activate_ebwp_addon( $plugin ) {
	return activate_plugin( $plugin, '', is_multisite() );
}

/**
 * Whether or not use fallback archiver library for compression.
 * It also loads fallback archiver class file.
 *
 * @return bool
 * @since 1.0.7
 * @see https://github.com/Ne-Lexa/php-zip
 */
function everest_backup_use_fallback_archiver() {
	$path  = EVEREST_BACKUP_PATH . 'vendor/autoload.php';
	$debug = everest_backup_get_settings( 'debug' );

	/**
	 * If overridden using debug mode.
	 */
	if ( ! empty( $debug['use_fallback_archiver'] ) ) {

		if ( ! class_exists( 'PhpZip\ZipFile' ) ) {
			require $path;
		}

		return true;
	}

	if ( ! class_exists( 'ZipArchive' ) ) {

		if ( ! class_exists( 'PhpZip\ZipFile' ) ) {
			require $path;
		}

		return true;
	}

}

/**
 * Returns loads and returns nelexa zip instance.
 *
 * @return \PhpZip\ZipFile
 */
function everest_backup_get_nelexa_zip() {
	require_once EVEREST_BACKUP_PATH . 'vendor/autoload.php';
	return new \PhpZip\ZipFile();
}

/**
 * Returns archiver object.
 *
 * @return array
 * @since 1.1.4
 */
function everest_backup_get_archiver() {
	if ( ! everest_backup_use_fallback_archiver() ) {
		return array(
			'type' => 'ziparchive',
			'lib'  => new \ZipArchive(),
		);
	}

	return array(
		'type' => 'fallback_archiver',
		'lib'  => new \PhpZip\ZipFile()
	);
}

/**
 * Compare php version.
 *
 * @param string  $new_version New or current php version.
 * @param string  $old_version Old php version.
 * @param string  $operator The possible operators are: <, lt, <=, le, >, gt, >=, ge, ==, =, eq, !=, <>, ne respectively.
 * @param boolean $only_minor Whether to only check minor versions.
 * @return int|bool
 * @since 1.0.4
 */
function everest_backup_version_compare( $new_version, $old_version, $operator, $only_minor = false ) {

	$pos = 1; // Position to indicate what's a major version (x.[x].x.x = 1).

	if ( $only_minor ) {

		// Get parts as array.
		$new = explode( '.', $new_version );
		$old = explode( '.', $old_version );

		// Check if it's a major version update.
		$is_major_update = version_compare( $new[ $pos ], $old[ $pos ], $operator ) || version_compare( intval( $new_version ), intval( $old_version ), $operator );

		// Check if it's a minor update.
		$is_minor_update = ( ! $is_major_update && version_compare( strstr( $new_version, '.' ), strstr( $old_version, '.' ), $operator ) );

		return $is_minor_update;
	}

	return version_compare( $new_version, $old_version, $operator );

}

/**
 * Returns percent of file chunks.
 *
 * @param int $bytes Bytes downloaded.
 * @param int $total_size Total size of file in bytes.
 * @since Everest Backup 1.0.7
 * @return int
 */
function everest_backup_get_download_percent( $bytes, $total_size ) {

	if ( ! $total_size ) {
		return 0;
	}

	static $percent = 0;

	$percent += ( ( $bytes / $total_size ) * 100 );

	return round( $percent, 1 );

}


/**
 * Download helper to download files in chunks and save it.
 *
 * @link https://gist.github.com/irazasyed/7533127
 *
 * @param  string  $source       Source Path/URL to the file you want to download.
 * @param  string  $dest         Destination Path to save your file.
 * @param  integer $chunk_size   (Optional) How many bytes to download per chunk (In MB). Defaults to 5 MB.
 * @param  integer $total_size   (Optional) @since 1.0.7 Total size of the file.
 * @param  boolean $return_bytes (Optional) Return number of bytes saved. Default: true.
 *
 * @return integer               Returns number of bytes delivered.
 */
function everest_backup_chunk_download_file( $source, $dest, $chunk_size = 5, $total_size = 0, $return_bytes = true ) {

	$context = stream_context_create(
		array(
			'ssl' => array(
				'verify_peer'      => false,
				'verify_peer_name' => false,
			),
		)
	);

	// @phpcs:disable
	$data        = '';
	$chunksize   = $chunk_size * MB_IN_BYTES.
	$bytes_count = 0;
	$handle      = fopen( $source, 'rb', false, $context );
	$fp          = fopen( $dest, 'wb', false, $context );

	if ( false === $handle ) {
		return false;
	}

	while ( ! feof( $handle ) ) {
		$data   = fread( $handle, $chunksize );
		$length = strlen( $data );

		fwrite( $fp, $data, $length );

		Logs::set_proc_stat(
			array(
				'status'   => 'in-process',
				'message'  => __( 'Downloading file from host...', 'everest-backup' ),
				'progress' => everest_backup_get_download_percent( $length, $total_size ),
			)
		);

		if ( $return_bytes ) {
			$bytes_count += $length;
		}
	}

	$status = fclose( $handle );
	fclose( $fp );

	if ( $return_bytes && $status ) {
		return $bytes_count; // Return number of bytes delivered like readfile() does.
	}

	// @phpcs:enable

	return $status;
}


/**
 * Returns list of everest-backup installed addons according to the filter.
 *
 * @param string $filter Filter addon. Supports `all`, `active`, and `paused`.
 * @return array
 * @since 1.0.0
 */
function everest_backup_installed_addons( $filter = 'all' ) {

	if ( ! function_exists( 'get_plugins' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}

	static $ebwp_addons = array();

	$ebwp_active = array();
	$ebwp_paused = array();

	$prefix = 'everest-backup-';

	if ( ! $ebwp_addons ) {
		wp_cache_flush();
		$plugins = array_keys( get_plugins() );

		if ( is_array( $plugins ) && ! empty( $plugins ) ) {
			foreach ( $plugins as $plugin ) {
				if ( false !== strpos( $plugin, $prefix ) ) {
					$ebwp_addons[] = $plugin;
				}
			}
		}
	}

	if ( 'all' === $filter ) {
		return $ebwp_addons;
	}

	if ( is_array( $ebwp_addons ) && ! empty( $ebwp_addons ) ) {
		foreach ( $ebwp_addons as $ebwp_addon ) {
			if ( is_plugin_active( $ebwp_addon ) ) {
				$ebwp_active[] = $ebwp_addon;
			} else {
				$ebwp_paused[] = $ebwp_addon;
			}
		}
	}

	return 'paused' === $filter ? $ebwp_paused : $ebwp_active;

}


/**
 * Flush Elementor cache
 *
 * @return void
 */
function everest_backup_elementor_cache_flush() {
	delete_post_meta_by_key( '_elementor_css' );
	delete_option( '_elementor_global_css' );
	delete_option( 'elementor-custom-breakpoints-files' );
}

/**
 * Returns an array of excluded folders names.
 *
 * @return array
 * @since 1.1.6
 */
function everest_backup_get_excluded_folders() {

	static $remote_data;

	if ( ! $remote_data ) {
		$url = add_query_arg( 't', time(), EVEREST_BACKUP_EXCLUDED_FOLDERS_JSON_URL ); // For busting cache.

		$res = wp_remote_get(
			$url,
			array(
				'sslverify' => false,
			)
		);

		$json = wp_remote_retrieve_body( $res );

		$remote_data = json_decode( $json, true );
		$remote_data = $remote_data && is_array( $remote_data ) ? $remote_data : array();
	}

	$defaults = array(
		'plugins',
		'themes',
		'upgrade',
		'uploads',
		'ebwp-temps',
		'ebwp-backups',
		'debug.log',
	);

	$folders = array_merge( $defaults, $remote_data );
	$folders = array_values( array_filter( array_unique( array_map( 'trim', $folders ) ) ) );

	return apply_filters( 'everest_backup_filter_excluded_folders', $folders );
}

/**
 * Returns an array of addons data.
 *
 * @param string $category Addons category.
 * @return array
 * @since 1.0.1
 */
function everest_backup_fetch_addons( $category = '' ) {

	/**
	 * Cache function internally.
	 */
	static $json;

	if ( ! $json ) {

		if ( ! class_exists( 'Everest_Backup\Transient' ) ) {
			require_once EVEREST_BACKUP_PATH . 'inc/classes/class-transient.php';
		}

		$transient = new Transient( 'fetch_addons' );

		if ( everest_backup_is_debug_on() ) {
			$transient->delete();
		}

		$json = $transient->get();

		if ( ! $json ) {

			$url = add_query_arg( 't', time(), EVEREST_BACKUP_ADDONS_JSON_URL ); // @since 1.1.2 For busting cache.

			$res = wp_remote_get(
				$url,
				array(
					'sslverify' => false,
				)
			);

			$json = wp_remote_retrieve_body( $res );

			if ( ! is_array( json_decode( $json, true ) ) ) {
				return;
			}

			$transient->set( $json, HOUR_IN_SECONDS );
		}
	}

	if ( ! $json ) {
		return;
	}

	$decoded = json_decode( $json, true );

	if ( ! is_array( $decoded ) ) {
		return;
	}

	/**
	 * Hook to filter fetched addons data,
	 *
	 * @since 1.0.2
	 */
	$addons = apply_filters( 'everest_backup_filter_fetch_addons', $decoded );

	$data[ $category ] = ! empty( $addons[ $category ] ) ? $addons[ $category ] : '';

	return array(
		'categories' => array_keys( $addons ),
		'data'       => $category ? $data : $addons,
	);

}

/**
 * Returns the addon information according to its provided category and slug.
 *
 * @param string $category Addon category.
 * @param string $slug     Addon slug.
 * @return array
 * @since 1.0.1
 */
function everest_backup_addon_info( $category, $slug ) {
	$all_addons = everest_backup_fetch_addons( $category );

	$addons = ! empty( $all_addons['data'][ $category ] ) ? $all_addons['data'][ $category ] : '';

	if ( ! $addons ) {
		return;
	}

	$info = ! empty( $addons[ $slug ] ) ? $addons[ $slug ] : '';

	if ( ! is_array( $info ) ) {
		return;
	}

	$ebwp_addons = everest_backup_installed_addons();
	$plugin      = $slug . '/' . $slug . '.php';

	$installed = in_array( $plugin, $ebwp_addons, true );

	$info['plugin']    = $plugin;
	$info['installed'] = $installed;
	$info['active']    = $installed && is_plugin_active( $plugin );

	/**
	 * Hook to filter addon information.
	 *
	 * @param array $info Addon information.
	 * @since 1.0.2
	 */
	$info = apply_filters( 'everest_backup_filter_addon_info', $info, compact( 'category', 'slug' ) );

	return $info;

}

/**
 * Fetch content for upsell from upsell.json
 *
 * @return array
 */
function everest_backup_fetch_upsell() {

	if ( ! defined( 'EVEREST_BACKUP_UPSELL_JSON_URL' ) ) {
		return;
	}

	/**
	 * Cache function internally.
	 */
	static $data = array();

	if ( $data ) {
		return $data;
	}

	if ( ! class_exists( 'Everest_Backup\Transient' ) ) {
		require_once EVEREST_BACKUP_PATH . 'inc/classes/class-transient.php';
	}

	$transient = new Transient( 'fetch_upsell' );

	if ( everest_backup_is_debug_on() ) {
		$transient->delete();
	}

	$data = $transient->get();

	$url = add_query_arg( 't', time(), EVEREST_BACKUP_UPSELL_JSON_URL );

	$json = wp_remote_retrieve_body(
		wp_remote_get(
			$url,
			array(
				'sslverify' => false,
			)
		)
	);

	if ( ! is_array( json_decode( $json, true ) ) ) {
		return;
	}

	$decode = json_decode( $json, true );

	if ( ! is_array( $decode ) ) {
		return;
	}

	$fields = array(
		'domain',
		'plugins',
		'themes',
		'date',
	);

	if ( everest_backup_is_localhost() ) {
		$fields[0] = 'localhost';
	}

	$upsells = array();

	if ( is_array( $fields ) && ! empty( $fields ) ) {
		foreach ( $fields as $field ) {
			if ( ! isset( $decode[ $field ] ) ) {
				continue;
			}

			$_data = $decode[ $field ];

			switch ( $field ) {
				case 'domain':
					$homeurl = str_replace( array( 'https://', 'http://' ), '', home_url() );

					if ( ! empty( $_data[ $homeurl ] ) ) {
						$upsells[] = $_data[ $homeurl ];
					}

					break;

				case 'plugins':

					if ( ! function_exists( 'is_plugin_active' ) ) {
						require_once ABSPATH . 'wp-admin/includes/plugin.php';
					}

					if ( is_array( $_data ) && ! empty( $_data ) ) {
						foreach ( $_data as $plugin_slug => $plugin_upsell ) {
							if ( is_plugin_active( $plugin_slug ) ) {
								$upsells[] = $plugin_upsell['active'];
							} else {
								$upsells[] = $plugin_upsell['deactive'];
							}
						}
					}

					break;

				case 'themes':

					$active_theme = get_option( 'template', '' );

					if ( ! empty( $_data[ $active_theme ] ) ) {
						$upsells[] = $_data[ $active_theme ];
					}

					break;

				case 'date':

					$today = strtotime( date( 'd-m-Y' ) );

					if ( is_array( $_data ) && ! empty( $_data ) ) {
						foreach ( $_data as $dates ) {
							if ( strtotime( $dates['from'] ) > $today ) {
								continue;
							}

							if ( $today > strtotime( $dates['to'] ) ) {
								continue;
							}

							$upsells[] = $dates['contents'];
						}
					}

					break;

				case 'localhost':
					$upsells[] = $_data;

					break;
				default:
					break;
			}
		}
	}

	$data = array_values( array_filter( call_user_func_array( 'array_merge', $upsells ) ) );

	$transient->set( $data, DAY_IN_SECONDS );

	return $data;

}

/**
 * Fetch contents for sidebar from sidebar.json
 *
 * @param string $page Current everest backup admin page.
 * @return array
 */
function everest_backup_fetch_sidebar( $page ) {

	/**
	 * Cache function internally.
	 */
	static $json;

	if ( ! $json ) {

		if ( ! class_exists( 'Everest_Backup\Transient' ) ) {
			require_once EVEREST_BACKUP_PATH . 'inc/classes/class-transient.php';
		}

		$transient = new Transient( 'fetch_sidebar' );

		if ( everest_backup_is_debug_on() ) {
			$transient->delete();
		}

		$json = $transient->get();

		if ( ! $json ) {

			$url = add_query_arg( 't', time(), EVEREST_BACKUP_SIDEBAR_JSON_URL ); // @since 1.1.2 For busting cache.

			$res = wp_remote_get(
				$url,
				array(
					'sslverify' => false,
				)
			);

			$json = wp_remote_retrieve_body( $res );

			if ( ! is_array( json_decode( $json, true ) ) ) {
				return;
			}

			$transient->set( $json, HOUR_IN_SECONDS );
		}
	}

	if ( ! $json ) {
		return;
	}

	$decoded = json_decode( $json, true );

	if ( ! is_array( $decoded ) ) {
		return;
	}

	$data = array(
		'links'  => ! empty( $decoded['links'] ) ? $decoded['links'] : array(),
		'global' => ! empty( $decoded['global'] ) ? $decoded['global'] : array(),
		'paged'  => ! empty( $decoded['paged'][ $page ] ) ? $decoded['paged'][ $page ] : array(),
	);

	return $data;

}

/**
 * Logs memory used.
 */
function everest_backup_log_memory_used() {
	if ( everest_backup_is_debug_on() ) {
		/* translators: %s is the memory used value. */
		Logs::info( sprintf( __( 'Memory used: %s', 'everest-backup' ), everest_backup_format_size( memory_get_peak_usage( true ) ) ) );
	}
}

/**
 * Checks if debugging is defined.
 *
 * @return bool
 */
function everest_backup_is_debug_on() {

	$is_enabled = ( file_exists( wp_normalize_path( EVEREST_BACKUP_BACKUP_DIR_PATH . '/DEBUGMODEON' ) ) || ( defined( 'EVEREST_BACKUP_DEBUG' ) && EVEREST_BACKUP_DEBUG ) );

	return apply_filters( 'everest_backup_debug_mode', $is_enabled );
}

/**
 * If current connection is localhost.
 *
 * @return bool
 * @since 1.0.0
 */
function everest_backup_is_localhost() {
	$whitelist   = array( '127.0.0.1', '::1' );
	$remote_addr = ! empty( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	if ( in_array( $remote_addr, $whitelist, true ) ) {
		return true;
	}
}

/**
 * Add query args to API auth redirect url.
 *
 * @uses add_query_arg
 * @param array $args An associative array of key/value pairs: `array( 'key1' => 'value1', 'key2' => 'value2', )`.
 * @return string Returns new url.
 * @since 1.0.0
 * @since 1.0.8 `client_redirect` is now default query args parameter. No need to pass in $args.
 */
function everest_backup_add_redirect_url_query_arg( $args = array() ) {
	$redirect_url = EVEREST_BACKUP_AUTH_REDIRECT_URL;

	/**
	 * Parse "client_redirect".
	 *
	 * @since 1.0.8
	 */
	$args['client_redirect'] = network_admin_url( '/admin.php?page=everest-backup-settings&tab=cloud' );

	if ( ! empty( $args['cloud'] ) ) {
		$args['client_redirect'] = add_query_arg(
			array(
				'cloud' => $args['cloud'],
			),
			$args['client_redirect'],
		);
	}

	$args['client_redirect'] = rawurlencode( $args['client_redirect'] );

	return add_query_arg( $args, $redirect_url );
}

/**
 * Removes url argument passed as $key from the url.
 *
 * @param string|string[] $key — Query key or keys to remove.
 * @return string  New URL query string.
 * @since
 */
function everest_backup_remove_redirect_url_query_arg( $key ) {
	$redirect_url = EVEREST_BACKUP_AUTH_REDIRECT_URL;

	return remove_query_arg( $key, $redirect_url );
}

/**
 * Recursively sanitize the array values.
 *
 * @param array $data Array data to sanitize.
 * @return array $data Sanitized array data.
 * @since 1.0.0
 */
function everest_backup_sanitize_array( array $data ) {
	foreach ( $data as $key => &$value ) {
		if ( is_array( $value ) ) {
			$value = everest_backup_sanitize_array( $value );
		} else {
			if ( is_int( $value ) ) {
				$value = (int) $value;
			} elseif ( is_string( $value ) ) {
				$value = sanitize_text_field( wp_unslash( $value ) );
			}
		}
	}

	return $data;
}

/**
 * Returns settings data.
 *
 * @param string $key Array key for the settings data.
 * @return mixed If key is provided or not empty then it returns all the data according to key else it will return all settings data.
 * @since 1.0.0
 * @since 1.1.2 Added `everest_backup_filter_settings` filter hook.
 */
function everest_backup_get_settings( $key = '' ) {

	if ( 'debug' === $key ) {
		if ( ! everest_backup_is_debug_on() ) {
			// Bail if debug mode is off and values being asked for debugging purpose.
			return;
		}
	}

	/**
	 * Filter: everest_backup_filter_settings.
	 *
	 * @since 1.1.2
	 */
	$settings = apply_filters(
		'everest_backup_filter_settings',
		get_option( EVEREST_BACKUP_SETTINGS_KEY, array() )
	);

	if ( $key ) {
		return isset( $settings[ $key ] ) ? $settings[ $key ] : '';
	}

	return $settings;
}

/**
 * Update settings.
 *
 * @param array $settings Settings data to save.
 * @return void
 * @since 1.0.0
 */
function everest_backup_update_settings( $settings ) {

	if ( ! $settings ) {
		return;
	}

	$sanitized_settings = everest_backup_sanitize_array( $settings );

	update_option( EVEREST_BACKUP_SETTINGS_KEY, $sanitized_settings );
}

/**
 * Returns maximum file upload size.
 *
 * @return int If returns 0 then it means "unlimited" or no limit.
 * @since 1.0.0
 */
function everest_backup_max_upload_size() {

	$wp_limit = wp_max_upload_size();

	return (int) apply_filters( 'everest_backup_filter_max_upload_size', $wp_limit );
}

/**
 * Returns cron cycles for schedule backup.
 *
 * @return array
 * @since 1.0.0
 */
function everest_backup_cron_cycles() {
	return apply_filters(
		'everest_backup_filter_cron_cycles',
		array(
			'everest_backup_hourly'  => array(
				'interval' => null, // Disabled.
				'display'  => __( 'Hourly ( PRO )', 'everest-backup' ),
			),
			'everest_backup_daily'   => array(
				'interval' => DAY_IN_SECONDS, // 24 hours.
				'display'  => __( 'Daily', 'everest-backup' ),
			),
			'everest_backup_weekly'  => array(
				'interval' => WEEK_IN_SECONDS, // 1 week.
				'display'  => __( 'Weekly', 'everest-backup' ),
			),
			'everest_backup_monthly' => array(
				'interval' => MONTH_IN_SECONDS, // 1 month.
				'display'  => __( 'Monthly', 'everest-backup' ),
			),
		)
	);
}

/**
 * Returns an array of locations to save the backup packages.
 *
 * @return array
 * @since 1.0.0
 */
function everest_backup_package_locations() {
	return (array) apply_filters(
		'everest_backup_filter_package_locations',
		array(
			'server' => array(
				'label'       => __( 'Local Web Server', 'everest-backup' ),
				'description' => __( 'Save the backup package locally on your host server.', 'everest-backup' ),
				'is_active'   => true,
			),
		)
	);
}

/**
 * Where should the current package be saved.
 * If current operation is Ajax then it returns `Additional Settings` value,
 * If current operation is Cron then it returns `Settings > Schedule Backup` value.
 *
 * @return string
 * @since 1.0.0
 * @since 2.0.0
 */
function everest_backup_is_saving_to() {
	if ( wp_doing_ajax() ) {
		$response = everest_backup_get_ajax_response( EVEREST_BACKUP_EXPORT_ACTION );

		if ( ! empty( $response['save_to'] ) ) {
			return $response['save_to'];
		}

		// @since 2.0.0
		$configpath = everest_backup_current_request_storage_path( EVEREST_BACKUP_CONFIG_FILENAME );

		if ( file_exists( $configpath ) ) {
			$decode = json_decode( file_get_contents( $configpath ), true );

			if ( ! empty( $decode['Params']['save_to'] ) ) {
				return $decode['Params']['save_to'];
			}
		}

		return 'server';
	}

	if ( wp_doing_cron() ) {
		$schedule_backup_data = everest_backup_get_settings( 'schedule_backup' );
		return ! empty( $schedule_backup_data['save_to'] ) ? $schedule_backup_data['save_to'] : 'server';
	}
}

/**
 * Array search. Compatible with multi dimensional arrays.
 *
 * @param array      $array Array data to run the search.
 * @param string|int $field Field to check as key in the array.
 * @param mixed      $values Value respective to the field.
 * @return int|string $key Array key.
 * @since 1.0.0
 */
function everest_backup_array_search( $array, $field, $values ) {
	if ( is_array( $array ) && ! empty( $array ) ) {
		foreach ( $array as $key => $val ) {
			if ( ! isset( $val[ $field ] ) ) {
				continue;
			}

			if ( is_array( $values ) ) {
				if ( is_array( $values ) && ! empty( $values ) ) {
					foreach ( $values as $value ) {
						if ( $value === $val[ $field ] ) {
							return $key;
						}
					}
				}
			}

			if ( $values === $val[ $field ] ) {
				return $key;
			}
		}
	}
}

/**
 * List of items to exlude from backup. Eg; Plugins, Themes...
 *
 * @return array
 * @since 1.0.0
 * @since 1.0.9 Added `type` to array.
 * @since 1.1.2 Added `ignore_content` for excluding wp-content option.
 */
function everest_backup_get_backup_excludes() {
	return apply_filters(
		'everest_backup_filter_backup_excludes',
		array(
			'ignore_database' => array(
				'type'        => 'database',
				'label'       => __( 'Database (Sql)', 'everest-backup' ),
				'description' => __( 'Ignore database', 'everest-backup' ),
			),
			'ignore_plugins'  => array(
				'type'        => 'plugins',
				'label'       => __( 'Plugins (Files)', 'everest-backup' ),
				'description' => __( 'Ignore plugins', 'everest-backup' ),
			),
			'ignore_themes'   => array(
				'type'        => 'themes',
				'label'       => __( 'Themes (Files)', 'everest-backup' ),
				'description' => __( 'Ignore themes', 'everest-backup' ),
			),
			'ignore_media'    => array(
				'type'        => 'media',
				'label'       => __( 'Media (Files)', 'everest-backup' ),
				'description' => __( 'Ignore media', 'everest-backup' ),
			),
			'ignore_content'  => array(
				'type'        => 'content',
				'label'       => __( 'Others (Files)', 'everest-backup' ),
				'description' => __( 'Ignore other files and folders from wp-content folder', 'everest-backup' ),
			),
		)
	);
}

/**
 * Generate tags array from params.
 *
 * @param array $params Parameters to manipulate backup modules set during start of backup.
 * @return array
 * @since 2.0.0 Converted from class method to function.
 */
function everest_backup_generate_tags_from_params( $params ) {

	$excludes = everest_backup_get_backup_excludes();

	$tags = array();

	if ( is_array( $params ) && ! empty( $params ) ) {
		foreach ( $params as $key => $value ) {
			if ( ! isset( $excludes[ $key ] ) ) {
				continue;
			}

			if ( empty( $excludes[ $key ]['type'] ) ) {
				continue;
			}

			if ( ! absint( $value ) ) {
				continue;
			}

			$tags[] = $excludes[ $key ]['type'];
		}
	}

	return $tags;
}

/**
 * Process types used by logs.
 *
 * @return array
 * @since 1.0.0
 */
function everest_backup_get_process_types() {
	return apply_filters(
		'everest_backup_filter_process_types',
		array(
			'debug'           => __( 'Debug', 'everest-backup' ), // @since 1.1.1
			'abort'           => __( 'Abort', 'everest-backup' ),
			'backup'          => __( 'Backup', 'everest-backup' ),
			'rollback'        => __( 'Rollback', 'everest-backup' ),
			'restore'         => __( 'Restore', 'everest-backup' ),
			'clone'           => __( 'Clone', 'everest-backup' ),
			'schedule_backup' => __( 'Schedule Backup', 'everest-backup' ),
		)
	);
}

/**
 * Returns true if doing the clone.
 *
 * @return bool
 * @since 1.0.4
 */
function everest_backup_doing_clone() {
	return defined( 'EVEREST_BACKUP_DOING_CLONE' ) && EVEREST_BACKUP_DOING_CLONE;
}

/**
 * Returns true if doing the rollback.
 *
 * @return bool
 * @since 1.0.0
 */
function everest_backup_doing_rollback() {
	return defined( 'EVEREST_BACKUP_DOING_ROLLBACK' ) && EVEREST_BACKUP_DOING_ROLLBACK;
}

/**
 * Returns array of info of provided backup file path.
 *
 * @param string $backup_file Full path to the backup file.
 * @return array
 * @since 1.0.0
 */
function everest_backup_get_backup_file_info( $backup_file ) {

	if ( ! is_file( $backup_file ) ) {
		return array();
	}

	return array(
		'filename' => basename( $backup_file ),
		'path'     => $backup_file,
		'url'      => everest_backup_convert_file_path_to_url( $backup_file ),
		'size'     => filesize( $backup_file ),
		'time'     => filemtime( $backup_file ),
	);
}

/**
 * Check if file extension is excluded in settings by the user.
 *
 * @param string $file Full path to the backup file.
 * @return bool
 * @since 1.0.0
 */
function everest_backup_is_extension_excluded( $file ) {
	if ( ! is_file( $file ) ) {
		return false;
	}

	$general    = everest_backup_get_settings( 'general' );
	$extensions = ! empty( $general['exclude_files_by_extension'] ) ? $general['exclude_files_by_extension'] : '';

	if ( ! $extensions ) {
		return false;
	}

	$excluded = explode( ', ', $extensions );

	$extension = pathinfo( $file, PATHINFO_EXTENSION );

	return in_array( $extension, $excluded, true );
}

/**
 * Returns backup file full path according to the passed backup file name.
 *
 * @param string $backup_filename File name of backup package.
 * @param bool   $check If passed true then it checks if file exist or not.
 * @return string
 * @since 1.0.0
 */
function everest_backup_get_backup_full_path( $backup_filename, $check = true ) {

	if ( ! $backup_filename ) {
		return;
	}

	$backup_dir = EVEREST_BACKUP_BACKUP_DIR_PATH;

	$backup_file_path = wp_normalize_path( "{$backup_dir}/{$backup_filename}" );

	if ( ! $check ) {
		return $backup_file_path;
	}

	return is_file( $backup_file_path ) ? $backup_file_path : '';

}

function everest_backup_send_json( $data = null ) {
	if ( ! apply_filters( 'everest_backup_disable_send_json', false ) ) {
		wp_send_json( $data );
	}

	return $data;
}

/**
 * Sends json success response with logs.
 *
 * @param mixed $data Optional. Data to encode as JSON, then print and die. Default null.
 * @param int   $status_code Optional. The HTTP status code to output. Default null.
 * @param int   $options Optional. Options to be passed to json_encode(). Default 0.
 * @return void
 * @since 1.0.0
 */
function everest_backup_send_success( $data = null, $status_code = null, $options = 0 ) {

	/**
	 * Filter hook to disable die and send json from Everest Backup.
	 *
	 * @since 1.1.2
	 */
	$disable_send_json = apply_filters( 'everest_backup_disable_send_json', false );

	$res  = array();
	$logs = Logs::get();

	$res['logs']   = $logs;
	$res['result'] = $data;

	Logs::set_infostat( 'backup_status', 'success' );

	Logs::save();
	Logs::reset_and_close();

	Logs::set_proc_stat(
		array(
			'status'   => 'done',
			'progress' => 100,
			'data'     => $res,
		)
	);

	/**
	 * As it is possible that "everest_backup_send_success" and "everest_backup_send_error"
	 * could both be trigger in same script run, which can cause mis-matched json error in client slide.
	 * So to avoid that, we are not sending any response from this function if the $logs is empty.
	 */
	if ( ! $logs ) {
		if ( ! $disable_send_json ) {
			die;
		}

		return;
	}

	Proc_Lock::delete();

	do_action( 'everest_backup_before_send_json' );

	Filesystem::init()->delete( EVEREST_BACKUP_TEMP_DIR_PATH, true );

	if ( ! $disable_send_json ) {
		wp_send_json_success( $res, $status_code, $options );
	}
}

/**
 * Sends json error response with logs.
 *
 * @param mixed $data Optional. Data to encode as JSON, then print and die. Default null.
 * @param int   $status_code Optional. The HTTP status code to output. Default null.
 * @param int   $options Optional. Options to be passed to json_encode(). Default 0.
 * @return void
 * @since 1.0.0
 */
function everest_backup_send_error( $data = null, $status_code = null, $options = 0 ) {

	/**
	 * Filter hook to disable die and send json from Everest Backup.
	 *
	 * @since 1.1.2
	 */
	$disable_send_json = apply_filters( 'everest_backup_disable_send_json', false );

	$res  = array();
	$logs = Logs::get();

	$res['logs']   = $logs;
	$res['result'] = $data;

	Logs::set_infostat( 'backup_status', 'failed' );

	Logs::save();
	Logs::reset_and_close();

	Logs::set_proc_stat(
		array(
			'status' => 'error',
			'data'   => $res,
		)
	);

	Temp_Directory::init()->reset();

	/**
	 * As it is possible that "everest_backup_send_success" and "everest_backup_send_error"
	 * could both be trigger in same script run, which can cause mis-matched json error in client slide.
	 * So to avoid that, we are not sending any response from this function if the $logs is empty.
	 */
	if ( ! $logs ) {
		if ( ! $disable_send_json ) {
			die;
		}

		return;
	}

	Proc_Lock::delete();

	do_action( 'everest_backup_before_send_json' );

	Filesystem::init()->delete( EVEREST_BACKUP_TEMP_DIR_PATH, true );

	if ( ! $disable_send_json ) {
		wp_send_json_error( $res, $status_code, $options );
	}
}

/**
 * Returns post/get/request data.
 *
 * @param string $type Type of submission request to return.
 * @param bool   $ajax If true, it will return data merged with ajax response.
 * @return array
 * @since 1.0.0
 * @since 1.0.4
 */
function everest_backup_get_submitted_data( $type = 'request', $ajax = false ) {
	$data = array();

	switch ( $type ) {
		case 'post':
			$data = $_POST; // @phpcs:ignore
			break;

		case 'get':
			$data = $_GET; // @phpcs:ignore
			break;

		default:
			$data = $_REQUEST; // @phpcs:ignore
			break;
	}

	if ( $ajax && wp_doing_ajax() ) {
		$inputstream = file_get_contents( 'php://input' );
		$data_decode = (array) json_decode( $inputstream, true );
		return array_merge( $data, $data_decode );
	}

	return $data;
}

/**
 * Verify ajax nonce and return ajax body response.
 *
 * @param string|array $action Ajax action. If array is provided then the response action will be checked with each array element.
 * @return array body response.
 * @since 1.0.0
 */
function everest_backup_get_ajax_response( $action ) {
	if ( ! wp_doing_ajax() ) {
		return array();
	}

	if ( false === strpos( current_action(), 'everest_backup' ) ) {
		return array();
	}

	if ( ! everest_backup_verify_nonce( 'everest_backup_ajax_nonce' ) ) {
		$message = sprintf( __( 'Nonce verification failed. Action: "%s"', 'everest-backup' ), esc_html( $action ) );
		Logs::error( $message );
		everest_backup_send_error( $message );
	}

	if ( ! current_user_can( 'manage_options' ) ) {
		$message = __( 'Permission denied.', 'everest-backup' );
		Logs::error( $message );
		everest_backup_send_error( $message );
	}

	/**
	 * If nonce verified, lets bring things into action. No puns intended.
	 */
	$response = everest_backup_get_submitted_data( 'request', true );

	$res_action = ! empty( $response['action'] ) ? sanitize_text_field( wp_unslash( $response['action'] ) ) : '';

	$is_action_valid = is_array( $action ) ? in_array( $res_action, $action, true ) : ( $res_action === $action );

	if ( ! $is_action_valid ) {
		$message = __( 'Invalid action provided.', 'everest-backup' );
		Logs::error( $message );
		Logs::$is_sensitive = true;
		Logs::error( sprintf( __( 'Expected action: %1$s Received: %2$s', 'everest-backup' ), esc_html( $action ), esc_html( $res_action ) ) );
		Logs::$is_sensitive = false;
		everest_backup_send_error( $message );
	}

	if ( ! isset( $response['cloud'] ) ) {
		$response['cloud'] = 'server';
	}

	return $response;

}

/**
 * Returns admin email set by user or WP admin email as default.
 *
 * @return string
 * @since 1.0.0
 */
function everest_backup_get_admin_email() {
	$general = everest_backup_get_settings( 'general' );

	return ! empty( $general['admin_email'] ) ? $general['admin_email'] : get_option( 'admin_email' );
}


/**
 * PHP setup environment
 *
 * @return void
 */
function everest_backup_setup_environment() {

	if ( session_id() ) {
		session_write_close();
	}

	/**
	 * Increase memory limit.
	 */
	wp_raise_memory_limit();
	wp_cache_flush();

	/**
	 * Check and create temporary directory.
	 */
	Temp_Directory::init()->create();

	@ignore_user_abort( false );

	/**
	 * No time limit for script execution.
	 */
	if ( everest_backup_is_php_function_enabled( 'set_time_limit' ) ) {
		@set_time_limit( 0 );
		@ini_set( 'max_execution_time', 0 );
	}

	/**
	 * Set maximum time in seconds a script is allowed to parse input data
	 */
	@ini_set( 'max_input_time', '-1' ); // @phpcs:ignore

	/**
	 * Clean (erase) the output buffer and turn off output buffering
	 */
	if ( @ob_get_length() ) {
		@ob_end_clean();
	}

	/**
	 * Custom error handler.
	 */
	set_error_handler( // @phpcs:ignore
		function( $errno, $message, $file, $line ) {
			if ( ! $message ) {
				return;
			}

			/* translators: %1$s is the error message, %2$s is the file path and %3$s is the file line number. */
			$error = sprintf( __( '%1$s in %2$s on line %3$s' ), esc_html( $message ), esc_url_raw( $file ), absint( $line ) );

			switch ( $errno ) {

				case E_WARNING:
					Logs::warn( $error );
					break;

				case E_USER_WARNING:
					Logs::warn( $error );
					break;

				case E_NOTICE:
					Logs::warn( $error );
					break;

				case E_USER_NOTICE:
					Logs::warn( $error );
					break;

				case E_USER_ERROR:
					Logs::error( $error );
					break;

				default:
					Logs::error( $error );
					break;
			}

			return true;

		}
	);

	/**
	 * Catch errors and save them.
	 */
	register_shutdown_function(
		function() {
			$last_error = error_get_last();

			if ( ! is_array( $last_error ) ) {
				return;
			}

			/* translators: %1$s is the error message, %2$s is the file path and %3$s is the file line number. */
			$error = sprintf( __( '%1$s in %2$s on line %3$s' ), esc_html( $last_error['message'] ), esc_url_raw( $last_error['file'] ), absint( $last_error['line'] ) );

			Logs::error( $error );

			if ( E_ERROR === $last_error['type'] ) {

				/**
				 * Send response during fatal errors only.
				 */
				everest_backup_send_error();
			}
		}
	);
}

/**
 * Check if connection or process has been aborted by the user.
 *
 * @return bool
 * @since 1.0.0
 *
 * @see https://stackoverflow.com/a/16592945
 */
function everest_backup_has_aborted() {

	if ( wp_doing_cron() ) {
		return;
	}

	print ' ';
	flush();
	if ( ob_get_level() > 0 ) {
		ob_flush();
	}

	return connection_aborted() === 1;

}

/**
 * Wrapper function for `wp_nonce_field`
 *
 * @param string $action Scalar value to add context to the nonce.
 * @param bool   $referer Optional. Whether to set the referer field for validation. Default true.
 * @return string The token.
 * @since 1.0.0
 */
function everest_backup_nonce_field( $action, $referer = true ) {
	if ( $action ) {
		return wp_nonce_field( $action, $action, $referer );
	}
}

/**
 * Wrapper function for `wp_create_nonce`
 *
 * @param string $action Scalar value to add context to the nonce.
 * @return string The token.
 * @since 1.0.0
 */
function everest_backup_create_nonce( $action ) {
	if ( $action ) {
		return wp_create_nonce( $action );
	}
}

/**
 * Verify nonce.
 *
 * @param string $action Should give context to what is taking place and be the same when nonce was created.
 *
 * @return bool
 * @since 1.0.0
 */
function everest_backup_verify_nonce( $action ) {

	$nonce = ! empty( $_REQUEST[ $action ] ) ? sanitize_text_field( wp_unslash( $_REQUEST[ $action ] ) ) : '';

	if ( $nonce && $action ) {
		return wp_verify_nonce( $nonce, $action );
	}
}

/**
 * Returns WordPress uploads directory path.
 *
 * @return string
 * @since 1.0.0
 */
function everest_backup_get_uploads_dir() {
	$upload_dir = wp_upload_dir( null, false );
	if ( $upload_dir ) {
		if ( ! empty( $upload_dir['basedir'] ) ) {
			return trailingslashit( $upload_dir['basedir'] );
		}
	}
}

/**
 * Returns WordPress uploads directory url.
 *
 * @return string
 * @since 1.0.0
 */
function everest_backup_get_uploads_url() {
	$upload_dir = wp_upload_dir( null, false );
	if ( $upload_dir ) {
		if ( ! empty( $upload_dir['baseurl'] ) ) {
			return trailingslashit( $upload_dir['baseurl'] );
		}
	}
}

/**
 * Converts file paths to url.
 *
 * @param string $file Full path to file.
 * @return string
 * @since 1.0.0
 */
function everest_backup_convert_file_path_to_url( $file ) {

	if ( ! $file ) {
		return $file;
	}

	$abspath = wp_normalize_path( trailingslashit( ABSPATH ) );
	$homeurl = wp_normalize_path( trailingslashit( site_url() ) );

	return str_replace( $abspath, $homeurl, $file );
}

function everest_backup_get_activity_log_url() {
	return everest_backup_convert_file_path_to_url( EVEREST_BACKUP_ACTIVITY_PATH ) . '?t=' . time();
}

function everest_backup_get_issue_reporter_url() {

	if ( defined( 'EVEREST_BACKUP_ISSUE_REPORTER_URL' ) ) {
		return EVEREST_BACKUP_ISSUE_REPORTER_URL;
	}

	$sidebar_json = everest_backup_fetch_sidebar( null );

	return ! empty( $sidebar_json['links']['issue_reporter'] ) ? $sidebar_json['links']['issue_reporter'] : '';
}

function everest_backup_get_issue_reporter_data() {

	if ( ! is_user_logged_in() ) {
		return;
	}

	$user = wp_get_current_user();

	$display_name_explode = explode( ' ', $user->display_name );

	$data = array(
		'user_email' => $user->user_email
	);

	if ( count( $display_name_explode ) > 1 ) {
		$data['first_name'] = $display_name_explode[0];
		$data['last_name']  = $display_name_explode[ everest_backup_array_key_last( $display_name_explode ) ];
	}

	if ( ! everest_backup_is_localhost() ) {
		$data['site_url']      = site_url();
		$data['activity_url']  = everest_backup_get_activity_log_url();
		$data['session_token'] = wp_json_encode( everest_backup_get_current_user_ip_ua() );
	}

	$data['ebwp_active_addons'] = wp_json_encode( everest_backup_installed_addons( 'active' ) );

	return $data;
}

function everest_backup_get_current_user_ip_ua() {
	if ( ! is_user_logged_in() ) {
		return;
	}

	$session_token = get_user_meta( get_current_user_id(), 'session_tokens', true );

	if ( ! $session_token ) {
		return;
	}

	$token = $session_token[ everest_backup_array_key_last( $session_token ) ];

	return array(
		'ip' => ! empty( $token['ip'] ) ? $token['ip'] : '',
		'ua' => ! empty( $token['ua'] ) ? $token['ua'] : '',
	);
}

/**
 * Returns contents of WordPress .htaccess file.
 *
 * @return string
 * @since 1.0.0
 */
function everest_backup_get_htaccess() {
	$htaccess = EVEREST_BACKUP_HTACCESS_PATH;

	if ( is_file( $htaccess ) ) {
		return file_get_contents( $htaccess ); // @phpcs:ignore
	}
}

/**
 * Converts strings to hex string.
 *
 * @param string $string String to convert into hex.
 * @return string
 * @since 1.0.0
 */
function everest_backup_str2hex( $string ) {
	if ( is_string( $string ) ) {
		$hexstr = unpack( 'H*', $string );
		return array_shift( $hexstr );
	}
}

/**
 * Converts hex string to plain string.
 *
 * @param string $string Hex string to convert into plain string.
 * @return string
 * @since 1.0.0
 */
function everest_backup_hex2str( $string ) {
	if ( is_string( $string ) ) {
		return hex2bin( "$string" );
	}
}

/**
 * Locate and render files from view folder.
 *
 * @param string $template Template file name without extension.
 * @param array  $args Arguments that will be passed to the template.
 * @return void
 * @since 1.0.0
 */
function everest_backup_render_view( $template, $args = array() ) {
	$file = wp_normalize_path( EVEREST_BACKUP_VIEWS_DIR . $template . '.php' );

	if ( ! file_exists( $file ) ) {
		return;
	}

	$args = apply_filters( 'everest_backup_filter_view_renderer_args', $args, $template );

	everest_backup_print_notice();

	do_action( 'everest_backup_before_view_rendered', $template, $args );

	load_template( $file, false, $args );

	do_action( 'everest_backup_after_view_rendered', $template, $args );

}

/**
 * Set one time, dismissable notice.
 *
 * @param string $notice Notice message.
 * @param string $type Notice type.
 *
 * @see https://developer.wordpress.org/reference/hooks/admin_notices/#example for all notice types.
 *
 * @return void
 * @since 1.0.0
 */
function everest_backup_set_notice( $notice, $type ) { // @phpcs:ignore
	if ( ! session_id() ) {
		session_start();
	}

	$notices                 = isset( $_SESSION['ebwp_notice'] ) ? everest_backup_sanitize_array( $_SESSION['ebwp_notice'] ) : array();
	$_SESSION['ebwp_notice'] = compact( 'notice', 'type' );

}

/**
 * Prints HTML for the package location( Save To ) dropdown.
 *
 * @param array $args Arguments for the dropdown.
 *
 * @type `array $args['package_locations']` [Optional] Package locations array.
 * @type `string $args['name']` HTML name sttribute.
 * @type `string $args['id']` HTML id sttribute.
 * @type `string $args['class']` HTML class sttribute.
 * @type `string $args['selected']`Currently selected item.
 *
 * @return void
 * @since 1.0.0
 */
function everest_backup_package_location_dropdown( $args ) {

	$parsed_args = wp_parse_args(
		$args,
		array(
			'package_locations' => array(),
			'name'              => '',
			'id'                => '',
			'class'             => '',
			'selected'          => '',
		)
	);

	$package_locations = ! empty( $parsed_args['package_locations'] ) ? $parsed_args['package_locations'] : everest_backup_package_locations();
	$name              = $parsed_args['name'];
	$id                = $parsed_args['id'];
	$class             = $parsed_args['class'];
	$selected          = $parsed_args['selected'];

	ob_start();
	?>
	<select name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
		<?php
		if ( is_array( $package_locations ) && ! empty( $package_locations ) ) {
			foreach ( $package_locations as $key => $package_location ) {
				?>
				<option
					<?php
					selected( $selected, $key );
					disabled( ( false === $package_location['is_active'] ) );
					?>
					value="<?php echo esc_attr( $key ); ?>"
					title="<?php echo esc_attr( $package_location['description'] ); ?>"
				>
					<?php echo esc_html( $package_location['label'] ); ?> (&#8505;)
				</option>
				<?php
			}
		}
		?>
	</select>
	<?php
	$content = ob_get_clean();

	echo wp_kses(
		$content,
		array(
			'select' => array(
				'name'  => array(),
				'id'    => array(),
				'class' => array(),
			),
			'option' => array(
				'selected' => array(),
				'disabled' => array(),
				'value'    => array(),
				'title'    => array(),
			),
		)
	);
}

/**
 * Prints HTML for the backup files dropdown.
 *
 * @param array $args Arguments for the dropdown.
 *
 * @type `string $args['name']` HTML name sttribute.
 * @type `string $args['id']` HTML id sttribute.
 * @type `string $args['class']` HTML class sttribute.
 * @type `string $args['required']` Is dropdown required or not.
 * @type `string $args['selected']` Currently selected item.
 *
 * @return void
 * @since 1.0.0
 */
function everest_backup_backup_files_dropdown( $args ) {

	$parsed_args = wp_parse_args(
		$args,
		array(
			'name'     => '',
			'id'       => '',
			'class'    => '',
			'required' => false,
			'selected' => '',
			'order'    => 'asc',
		)
	);

	$name         = $parsed_args['name'];
	$id           = $parsed_args['id'];
	$class        = $parsed_args['class'];
	$required     = $parsed_args['required'];
	$selected     = $parsed_args['selected'];
	$order        = $parsed_args['order'];
	$backup_files = Backup_Directory::init()->get_backups_by_order( $order );

	$grouped_backups = array();

	if ( is_array( $backup_files ) && ! empty( $backup_files ) ) {
		foreach ( $backup_files as $backup_file ) {
			$file_info  = everest_backup_get_backup_file_info( $backup_file );
			$group_date = wp_date( 'F j, Y', $file_info['time'] );

			$grouped_backups[ $group_date ][] = $file_info;
		}
	}

	ob_start();
	?>
	<select name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>" required="<?php echo $required ? esc_attr( 'required' ) : ''; ?>" >
		<option value=""><?php esc_html_e( '--- Select ---', 'everest-backup' ); ?></option>
		<?php
		if ( is_array( $grouped_backups ) && ! empty( $grouped_backups ) ) {
			foreach ( $grouped_backups as $grouped_backup_date => $grouped_backup ) {
				?>
				<optgroup label="<?php echo esc_attr( $grouped_backup_date ); ?>">
				<?php
				if ( is_array( $grouped_backup ) && ! empty( $grouped_backup ) ) {
					foreach ( $grouped_backup as $backup ) {

						$filename  = $backup['filename'];
						$opt_label = $filename . ' [ ' . wp_date( 'h:i:s A', $backup['time'] ) . ' ]';
						?>
						<option title="<?php echo esc_attr( everest_backup_format_size( $backup['size'] ) ); ?>" <?php selected( $selected, $filename ); ?> value="<?php echo esc_attr( $filename ); ?>"><?php echo esc_html( $opt_label ); ?></option>
						<?php
					}
				}
				?>
				</optgroup>
				<?php
			}
		}
		?>
	</select>
	<?php
	$content = ob_get_clean();

	echo wp_kses(
		$content,
		array(
			'select'   => array(
				'name'     => array(),
				'id'       => array(),
				'class'    => array(),
				'required' => array(),
			),
			'optgroup' => array(
				'label' => array(),
			),
			'option'   => array(
				'selected' => array(),
				'disabled' => array(),
				'value'    => array(),
				'title'    => array(),
			),
		)
	);

}

/**
 * Breadcrumb function for Everest Backup admin pages.
 *
 * @return void
 * @since 1.0.0
 */
function everest_backup_breadcrumb() {
	$get = everest_backup_get_submitted_data( 'get' );

	$root = 'Everest Backup';
	$page = get_admin_page_title();
	$tab  = ! empty( $get['tab'] ) ? str_replace( array( '_', '-' ), ' ', ucwords( $get['tab'], '_' ) ) : '';

	?>
	<div class="everest-backup-breadcrumb" id="eb-breadcrumb">
		<svg xmlns="http://www.w3.org/2000/svg" width="17" viewBox="0 0 52.415 40.759">
		<path id="eb_icon_home" d="M25.511,12.828,8.735,26.645V41.557a1.456,1.456,0,0,0,1.456,1.456l10.2-.026a1.456,1.456,0,0,0,1.449-1.456V32.822a1.456,1.456,0,0,1,1.456-1.456h5.823a1.456,1.456,0,0,1,1.456,1.456v8.7a1.456,1.456,0,0,0,1.456,1.46l10.193.028a1.456,1.456,0,0,0,1.456-1.456V26.635L26.9,12.828A1.109,1.109,0,0,0,25.511,12.828Zm26.5,9.391L44.4,15.949V3.345a1.092,1.092,0,0,0-1.092-1.092h-5.1a1.092,1.092,0,0,0-1.092,1.092V9.952l-8.146-6.7a4.368,4.368,0,0,0-5.55,0L.4,22.219A1.092,1.092,0,0,0,.25,23.757l2.32,2.821a1.092,1.092,0,0,0,1.539.148L25.511,9.1a1.109,1.109,0,0,1,1.392,0l21.4,17.629a1.092,1.092,0,0,0,1.538-.146l2.32-2.821a1.092,1.092,0,0,0-.155-1.54Z" transform="translate(0.001 -2.254)" fill="#000000"/>
		</svg>

		<strong><?php echo esc_html( $root ); ?></strong> <span class="breadcrumb-separator">&#187;</span> <?php echo $tab ? wp_kses_post( "<strong>$page</strong> <span class='breadcrumb-separator'>&#187;</span> <small>$tab</small>" ) : wp_kses_post( "<small>$page</small>" ); ?>
	</div>
	<?php

}

/**
 * Prints tooltip html.
 *
 * @param string $tip Tip or description to print.
 * @since 1.0.9
 */
function everest_backup_tooltip( $tip ) {
	?>
	<div class="eb-tooltip">
		<span class="dashicons dashicons-info"></span>
		<span class="eb-tooltiptext"><?php echo wp_kses_post( $tip ); ?></span>
	</div>
	<?php
}

/**
 * Prints HTML for toggle switch.
 *
 * @param array $args Arguments for the toggle switch.
 * @return void
 * @since 1.0.0
 */
function everest_backup_switch( $args = array() ) {

	static $called = 0;

	$parsed_args = wp_parse_args(
		$args,
		array(
			'id'              => sprintf( 'ebwp-switch-%d', $called ),
			'class'           => '',
			'name'            => '',
			'value_checked'   => 1,
			'value_unchecked' => 0,
			'checked'         => false,
			'label_checked'   => __( 'Enable', 'everest-backup' ),
			'label_unchecked' => __( 'Disable', 'everest-backup' ),
		)
	);

	$called++;

	$id    = $parsed_args['id'];
	$class = trim( sprintf( 'toggle %s', $parsed_args['class'] ) );

	?>
	<div class="toggle-switch" id="toggle-<?php echo esc_attr( $id ); ?>">
		<input type="hidden" name="<?php echo esc_attr( $parsed_args['name'] ); ?>" value="<?php echo esc_attr( $parsed_args['value_unchecked'] ); ?>">
		<input <?php checked( $parsed_args['checked'] ); ?> name="<?php echo esc_attr( $parsed_args['name'] ); ?>" type="checkbox" class="<?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $id ); ?>" value="<?php echo esc_attr( $parsed_args['value_checked'] ); ?>">
		<label for="<?php echo esc_attr( $id ); ?>" data-checked="<?php echo esc_attr( $parsed_args['label_checked'] ); ?>" data-unchecked="<?php echo esc_attr( $parsed_args['label_unchecked'] ); ?>"></label>
	</div>
	<?php

}

/**
 * Print one time, dismissable notice.
 *
 * @return void
 * @since
 */
function everest_backup_print_notice() {
	if ( ! isset( $_SESSION['ebwp_notice'] ) ) {
		return;
	}

	$notice = everest_backup_sanitize_array( $_SESSION['ebwp_notice'] );

	?>
	<div class="notice is-dismissible <?php echo esc_attr( $notice['type'] ); ?>">
		<p><?php echo wp_kses_post( $notice['notice'] ); ?></p>
	</div>
	<?php

	unset( $_SESSION['ebwp_notice'] );
}

/**
 * Replace the first occurrence of a string within a string.
 *
 * @param string $search The value being searched for, otherwise known as the needle.
 * @param string $replace The replacement value that replaces found search values.
 * @param string $subject The string or array being searched and replaced on, otherwise known as the haystack.
 * @return string
 * @since 1.0.0
 */
function everest_backup_str_replace_once( $search, $replace, $subject ) {
	$pos = strpos( $subject, $search );
	if ( false !== $pos ) {
		return substr_replace( $subject, $replace, $pos, strlen( $search ) );
	}
}
