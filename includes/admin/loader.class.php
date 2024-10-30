<?php
namespace Kienso\Comarquage\Admin;

defined( 'ABSPATH' ) || exit;

class Loader {

	public function __construct() {

		if ( !is_admin() ) return; // Run following only on Admin

		new Options();
		new Pages();
		new Notices();

		// Add link under the bloc in the plugins page
		add_filter("plugin_action_links_" . plugin_basename( KIENSO_COMARQUAGE_FILE ), [&$this, 'settings_link'] );
	}

	public function settings_link($links) {
		$settings_link = '<a href="options-general.php?page=comarquage-options.php">Réglages</a>';
		array_unshift($links, $settings_link);
		return $links;
	}
}
