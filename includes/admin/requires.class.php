<?php
namespace Kienso\Comarquage\Admin;

use Kienso\Comarquage\Config;
use Kienso\Comarquage\Message;

defined( 'ABSPATH' ) || exit;

class Requires {

	/* Construct
	----------------------------------------------------- */
	function __construct() {

	}

	/* Get PHP Value
	----------------------------------------------------- */
	public static function get_phpvalue($value_name) {

		// Get current php value
		$current_value = ini_get($value_name);

		// Return info
		$test = $value_name . ' : ';
		$test .= $current_value . '<br>';

		return $test;
	}

	/* Get Defined
	----------------------------------------------------- */
	public static function get_defined($value_name) {

		if(!defined($value_name)) $current_value = 'NOT DEFINED';
		else $current_value = constant($value_name);

		if(empty($current_value)) $current_value = '0';

		// Return info
		$test = $value_name . ' : ';
		$test .= $current_value . '<br>';
		return $test;
	}

	/* Display plugin require
	----------------------------------------------------- */
	public static function display(){

		if ( !current_user_can( 'manage_options' ) ) return;

		$html = '<div contenteditable="true" style="padding:1%; margin:10px 0; background-color:#FFF; border:1px solid #ddd; width:98%; overflow-y:scroll;">';

		$html .= '<p style="margin-bottom:0px;"><strong><u>1) SERVEUR</u></strong></p>';
		if(function_exists('apache_get_version')) $html .= 'serveur web : ' . apache_get_version() . '<br>';
		$html .= 'SERVER_NAME : ' . $_SERVER['SERVER_NAME'] . '<br>';
		$html .= 'SERVER_SOFTWARE : ' . $_SERVER['SERVER_SOFTWARE'] . '<br>';
		$html .= 'SERVER_PROTOCOL : ' . $_SERVER['SERVER_PROTOCOL'] . '<br>';

		$html .= '<br><p style="margin-bottom:0px;"><strong><u>2) PHP</u></strong></p>';

		$html .= 'version de PHP : ' . phpversion() . '<br>';
		$html .= Requires::get_phpvalue('memory_limit');
		$html .= Requires::get_phpvalue('max_execution_time');
		$html .= '<br><u>extensions : </u><br>';
		$html .= 'xml : ' . ( extension_loaded('xml') ? '<span style="color:green">installé</span>' : '<span style="color:red">manquante</span>' ) . '<br>';
		$html .= 'xmlreader : ' . ( extension_loaded('xmlreader') ? '<span style="color:green">installé</span>' : '<span style="color:red">manquante</span>' ) . '<br>';
		$html .= 'simplexml : ' . ( extension_loaded('SimpleXML') ? '<span style="color:green">installé</span>' : '<span style="color:red">manquante</span>' ) . '<br>';
		$html .= 'libxml : ' . ( extension_loaded('libxml') ? '<span style="color:green">installé</span>' : '<span style="color:red">manquante</span>' ) . '<br>';

		$html .= '<br><u>Classe : </u><br>';
		$html .= 'ZipArchive : ' . ( class_exists('ZipArchive') ? '<span style="color:green">installé</span>' : '<span style="color:red">manquante</span>' ) . '<br>';

		$html .= '<br><p style="margin-bottom:0px;"><strong><u>3) WORDPRESS</u></strong></p>';
		$html .= Requires::get_defined('WP_SITEURL');
		$html .= Requires::get_defined('WP_HOME');
		$html .= Requires::get_defined('ABSPATH');
		$html .= Requires::get_defined('UPLOADS');
		$html .= Requires::get_defined('WP_TEMP_DIR');
		$html .= Requires::get_defined('WP_DEBUG');
		$html .= Requires::get_defined('WP_DEBUG_DISPLAY');
		$html .= Requires::get_defined('SCRIPT_DEBUG');
		$html .= Requires::get_defined('WP_NETWORK_ADMIN');
		$html .= Requires::get_defined('WP_CACHE');
		$html .= Requires::get_defined('WP_MEMORY_LIMIT');
		$html .= Requires::get_defined('WP_PLUGIN_DIR');
		$html .= Requires::get_defined('ALTERNATE_WP_CRON');

		$html .= '<br><u>plugin comarquage : </u><br>';
		$html .= Requires::get_defined('KIENSO_COMARQUAGE_VERSION');
		$html .= Requires::get_defined('KIENSO_COMARQUAGE_DIR');
		$html .= Requires::get_defined('KIENSO_COMARQUAGE_INCLUDES');

		$html .= '<br></div>';

		echo $html;
	}

	/* Check Requirment
	----------------------------------------------------- */
	public static function br_trigger_error($message, $errno) {
		if(isset($_GET['action']) && $_GET['action'] == 'error_scrape') {
			echo '<strong>Co-marquage : </strong> ' . $message;
			exit;
		} else {
			trigger_error($message, $errno);
		}
	}

	public static function install_check(){

		// Check PHP extensions and functionnality
		if(!ini_get('allow_url_fopen')) Requires::br_trigger_error('PHP n\'est pas configurer pour la gestion de fichier. Modifier votre configuration PHP : allow_url_fopen', E_USER_ERROR);
		if(!extension_loaded('xml')) Requires::br_trigger_error('L\'extension PHP suivante est manquante : xml', E_USER_ERROR);
		if(!extension_loaded('libxml')) Requires::br_trigger_error('L\'extension PHP suivante est manquante : libxml', E_USER_ERROR);
		if(!extension_loaded('simplexml')) Requires::br_trigger_error('L\'extension PHP suivante est manquante : simplexml', E_USER_ERROR);
		if(!class_exists('ZipArchive')) Requires::br_trigger_error('La class PHP suivante est manquante : ZipArchive (php**-zip)', E_USER_ERROR);

		// FileSystem Check
		if(!is_writable(Config::$comarquage_dir)) Requires::br_trigger_error('Impossible d\'&eacute;crire dans le repertoire : ' . Config::$comarquage_dir, E_USER_ERROR);

	}
}
