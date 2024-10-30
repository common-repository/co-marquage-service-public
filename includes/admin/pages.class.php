<?php
namespace Kienso\Comarquage\Admin;



defined( 'ABSPATH' ) || exit;

class Pages {
	public function __construct() {
		add_action('admin_menu', [&$this, 'add_menu']);
	}

	public function add_menu() {
		add_options_page(
			'comarquage-setting',
			'Co-marquage SP',
			'manage_options',
			'comarquage-options',
			[&$this, 'page_settings']
		);
	}

	function page_settings() {
		require_once("pages/settings.php");
	}
}
