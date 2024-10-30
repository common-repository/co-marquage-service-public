<?php
namespace Kienso\Comarquage\Front;

use Kienso\Comarquage\Config;

defined( 'ABSPATH' ) || exit;

class Loader {

	public function __construct() {

		if(is_admin()) return; // Run following only on frontend

		add_action( 'wp_head', [&$this, 'noindex'] , 5 );
		add_action( 'wp_enqueue_scripts', [&$this,'comarquage_scripts'], 0 );

		new Display();
	}

	/**
	 * No index comarquage page in search engine !!! Duplicate content
	 */
	function noindex() {
		if( !empty($_GET['xml']) ) echo '<meta name="robots" content="noindex,follow" />';
	}

	/**
	 * Load frontend scripts
	 */
	function comarquage_scripts() {

		// Leaflet
		if ( Config::$options->comarquage_global_pivot_enable && Config::$options->comarquage_global_js_leaflet_enable ) {

			// JS
			wp_register_script('leaflet', KIENSO_COMARQUAGE_URL .'vendor/leaflet/leaflet.js', null, '1.4.0', true );
			wp_enqueue_script( 'leaflet' );

			// CSS
			wp_register_style( 'leaflet', KIENSO_COMARQUAGE_URL .'vendor/leaflet/leaflet.min.css', null, '1.4.0');
			wp_enqueue_style( 'leaflet' );
		}

		// Comarquage
		if ( Config::$options->comarquage_global_css_enable ) {
			// CSS
			wp_register_style( 'comarquage', KIENSO_COMARQUAGE_URL .'assets/css/comarquage.css', null, KIENSO_COMARQUAGE_VERSION);
			wp_enqueue_style( 'comarquage' );
		}

		// JS
		wp_register_script('comarquage', KIENSO_COMARQUAGE_URL .'assets/js/comarquage.js', array('jquery'), KIENSO_COMARQUAGE_VERSION, true );
		wp_enqueue_script( 'comarquage' );
	}
}
