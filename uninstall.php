<?php
defined( 'ABSPATH' ) || exit;
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit();

function comarquage_delete_plugin() {

    // TODO !!!!!

	// 1) Delete XML
	// $upload_dir = wp_upload_dir();
	// $upload_dir['basedir'] . '/comarquage/';

	// 2) Delete Options in database
	// if ( ! class_exists( 'Comarquage_Options' ) ) {
	// 	require_once 'admin/class-options.php';
	// 	new Kienso\ComarquageComarquage_Options;
	// }

	// Delete plugin Options
	// Comarquage_Options::delete_options();

}
comarquage_delete_plugin();
?>
