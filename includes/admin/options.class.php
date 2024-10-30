<?php
namespace Kienso\Comarquage\Admin;

defined( 'ABSPATH' ) || exit;

class Options {

	function __construct() {
		add_action('admin_init', [ &$this, 'register_setting' ] );
	}

	/**
	 * Set default options
	 * @return array $options list of default options
	 */
	public static function get_default_options() {
		$options = [
            // --- Core setting
			'comarquage_global_css_enable' 			=>  1,
			'comarquage_global_poweredby' 			=>  1,
			'comarquage_global_pivot_enable' 		=>  0,
			'comarquage_global_departement' 		=>  '91',
			'comarquage_global_code_insee' 			=>  '91386',
			'comarquage_update_time' 				=>  [],
			'comarquage_global_js_leaflet_enable' 	=>  1,
			'comarquage_global_page_part' 			=>  0,
			'comarquage_global_page_asso' 			=>  0,
			'comarquage_global_page_pro' 			=>  0,
			'comarquage_debug_enable' 				=>  0
		];
		return $options;
	}

	/**
	 * Return all options and their actual value
	 * @return object $options list of current options
	 */
	public static function get_all_options() {

		$DefaultOptions = \Kienso\Comarquage\Admin\Options::get_default_options(); // Get Default options list

		// Get options list
		$options = new \stdClass();
		foreach( $DefaultOptions as $option_name => $default_value ) {
			$opt = get_option($option_name);
			if(!$opt) add_option($option_name, $default_value); // Set default if not exist in database
			$options->$option_name = $opt ? $opt : '' ; // By Default 0 for uncheck checkbox - GET :)
		}
		return $options;
	}

	/**
	 * Setup Default value on first activation
	 */
	public static function setup_default_options() {

		$DefaultOptions = \Kienso\Comarquage\Admin\Options::get_default_options(); // Get Default options list

		// Setup Default value on the first time
		foreach( $DefaultOptions as $option_name => $default_value ) {
			// delete_option($option_name); // Only use this for test
			if(!get_option($option_name)) add_option($option_name, $default_value);
		}
	}

	/**
	 * Register setting for setting page
	 */
	function register_setting() {
		$options = $this->get_default_options();

		foreach( $options as $option_name => $default_value ) {
			register_setting('comarquage', $option_name);
		}
	}

	/**
	 * Delete options (on plugin delete)
	 */
	public static function delete_options() {
		$DefaultOptions = \Kienso\Comarquage\Admin\Options::get_default_options();
		// Setup Default value on the first time
		foreach( $DefaultOptions as $option_name => $default_value ) {
			if( get_option($option_name) ) delete_option($option_name);
		}
	}
}
