<?php
namespace Kienso\Comarquage\Install;

use Kienso\Comarquage\Config;
use Kienso\Comarquage\Admin\Requires;
use Kienso\Comarquage\Admin\Options;

defined( 'ABSPATH' ) || exit;

class Loader {

	public function __construct() {
		register_activation_hook( KIENSO_COMARQUAGE_FILE, [ &$this, 'activate'] );
		register_deactivation_hook( KIENSO_COMARQUAGE_FILE, [ &$this, 'deactivate'] );
	}

	/**
	* On plugin activate
	*/
	public static function activate() {

		// Create comarquage directory in uploads
		if(!file_exists(Config::$comarquage_dir)) wp_mkdir_p(Config::$comarquage_dir);

		// Check Requires before activate
		Requires::install_check();

		// Setup plugin default options
		Options::setup_default_options();

		// Scheduled XML Update and Run it now
		wp_clear_scheduled_hook( 'comarquage_daily_xml_update' );

		// DISABLED
		// wp_schedule_event( time(), 'weekly', 'comarquage_weekly_xml_update' ); // Weekly download XMl files
	}

	/**
	* on plugin deactivate
	* @return [type] [description]
	*/
	public static function deactivate() {
		// Delete XML Update Schedule
		wp_clear_scheduled_hook( 'comarquage_daily_xml_update' );
	}
}
