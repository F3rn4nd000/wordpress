<?php
/**
 * Core class for new export feature. This class will initialize required exporting classes.
 *
 * @package Everest_Backup
 */

namespace Everest_Backup\Core;

use Everest_Backup\Core\Export\Contents;
use Everest_Backup\Core\Export\Database;
use Everest_Backup\Core\Export\Media;
use Everest_Backup\Core\Export\Plugins;
use Everest_Backup\Core\Export\Setup;
use Everest_Backup\Core\Export\Themes;
use Everest_Backup\Core\Export\Wrapup;

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Core class for new export feature. This class will initialize required exporting classes.
 *
 * @since 2.0.0
 */
class Export {

	public static function load_file( $current ) {
		$path = EVEREST_BACKUP_CORE_DIR_PATH . "export/class-{$current}.php";

		if ( file_exists( $path ) ) {
			require_once $path;
		}
	}

	/**
	 * Init export.
	 *
	 * @return void
	 */
	public static function init( $params = array() ) {

		$params  = $params ? $params : everest_backup_get_ajax_response( EVEREST_BACKUP_EXPORT_ACTION );
		$current = ! empty( $params['next'] ) ? $params['next'] : 'setup';

		self::load_file( $current );

		switch ( $current ) {
			case 'setup':
				Setup::init( $params );
				break;

			case 'database':
				Database::init( $params );
				break;

			case 'plugins':
				Plugins::init( $params );
				break;

			case 'media':
				Media::init( $params );
				break;

			case 'themes':
				Themes::init( $params );
				break;

			case 'content':
				Contents::init( $params );
				break;

			default:
				Wrapup::init( $params );
				break;
		}

		everest_backup_send_json();
	}

}
