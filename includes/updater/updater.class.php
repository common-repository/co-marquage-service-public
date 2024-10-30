<?php
namespace Kienso\Comarquage\Updater;

use Kienso\Comarquage\Config;
use Kienso\Comarquage\Message;
use Kienso\Comarquage\Helpers;

defined( 'ABSPATH' ) || exit;

class Updater {

	function __construct() {

		// Declare function to run weekly by WP Cron scheduler
		// DISABLED
		// add_action( 'comarquage_weekly_xml_update', [ &$this, 'run' ], 10 ); // Run weekly update
	}

	/**
	 * Update xmls for all categories
	 * @param  boolean $force force the update
	 */
	public static function run() {
		foreach(Config::CATEGORIES as $cat ) {
			Updater::update_categorie_xml( $cat );
		}
	}

	/**
	 * Download and extract xmls archive
	 * @param string $cat co-marquage categorie
	 */
	public static function update_categorie_xml( $cat = 'part' ) {

		Message::add_debug('info', 'Begin - update_categorie_xml. category : ' . $cat );

		// Save begin time
		$begin_time = time();

		// Test if categorie exist
		if ( !in_array( $cat, Config::CATEGORIES ) ) {
			Message::add('Comarquage', 'Cette catégorie n\'existe pas : ' . $cat . '. Disponible : part, pro ou asso');
			return false;
		}

		// Download zip file
		Message::add_debug('info', 'Begin download : ' . Config::SP_ZIP[$cat] );
		// $tmp_file = download_url( Config::SP_ZIP[$cat], 600, true ); // Before Certificat issue
		$http_result = Helpers::download(Config::SP_ZIP[$cat], true);

		// Test if file is download
		if ( is_wp_error( $http_result ) ) {
			Message::add('error', 'Impossible de telecharger le fichier ZIP contenant les données de comarquage. Source : ' . Config::SP_ZIP[$cat] );
			Message::add_debug('info', 'error details - ' . serialize($http_result) );
			return false;
		} else {
			$tmp_file =  $http_result['filename']; // get temp file path
		}

		$file_array = array(
			'name' => basename( Config::SP_ZIP[$cat] ),
			'tmp_name' => $tmp_file
		);

		// Destination directory
		Config::set_categories_dir($cat, $begin_time);
		if ( !file_exists(Config::$categories_dir[$cat] ) ) {
			// Create directory for xml files
			if ( !mkdir(Config::$categories_dir[$cat], 0777, true) ) {
				Message::add('error', 'Impossible de cr&eacute;er le repertoire : ' . Config::$categories_dir[$cat] );
				return false;
			}
		}

		// Unzip - hpeldin Contributor
		$zip_temp = $file_array[ 'tmp_name' ];
		$zip = new \ZipArchive;

		if ( $zip->open( $zip_temp ) === TRUE ) {

			if( is_writable(Config::$categories_dir[$cat]) ) $zip->extractTo( Config::$categories_dir[$cat] );
			else Message::add('error', 'Impossible d\'extraire le fichier ZIP contenant les données de comarquage. Destination : ' . Config::$categories_dir[$cat] );

			$zip->close();
			unlink( $zip_temp ); // remove temp file
		} else {
			Message::add('error', 'Impossible d\'ouvrir le fichier ZIP contenant les données de comarquage.' );
		}

		// Save last update time
		Config::set_categories_update_time($cat, $begin_time);

		// Suppression des anciennes versions
		$files = scandir( Config::$comarquage_dir . $cat, 1);

		// On depile les chemins . et ..
		array_pop($files);
		array_pop($files);

		// On depile les trois derniers telechargement
		array_shift($files);
		array_shift($files);
		array_shift($files);

		// Delete files and directories;
		foreach ($files as $rep ) {
			$dir = Config::$comarquage_dir . $cat . "/" . $rep . "/";
			array_map('unlink', glob($dir . "*.xml"));
			if(is_dir($dir)) Helpers::delete_directory($dir);
		}

		Message::add_debug('info', 'End - update_categorie_xml. category : ' . $cat );
	}
}