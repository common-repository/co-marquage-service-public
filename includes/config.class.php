<?php
namespace Kienso\Comarquage;

use Kienso\Comarquage\Admin\Options;

defined( 'ABSPATH' ) || exit;

Class Config {

    // Constantes
    const CATEGORIES = [ 'part', 'pro', 'asso' ];
    const UPLOADS_FOLDER = 'comarquage';

    // DISABLED
    const SP_ZIP = [
        "part" => null, // "https://api.wp.kienso.fr/comarquage/30/part.zip",
        "pro" => null, // "https://api.wp.kienso.fr/comarquage/30/pro.zip",
        "asso" => null, // "https://api.wp.kienso.fr/comarquage/30/asso.zip"
    ];
    //public $comarquage_pivots_url = "https://lecomarquage.service-public.fr/donnees_locales_v3/all/";
    const SP_PIVOTS = "https://lecomarquage.service-public.fr/donnees_locales_v3/all/";

    // Static variables
    static $options = []; // Plugin options
    static $comarquage_dir; // comarquage uploads directory
    static $categories_dir = []; // categories uploads directory
    static $categories_update_time = []; // categories last update time
    static $code_departements = [];

    function __construct() {

        Config::$options = Options::get_all_options();

        // Root uploads for comarquage files
        $upload_dir = wp_upload_dir();
        Config::$comarquage_dir = $upload_dir['basedir'] . '/' . Config::UPLOADS_FOLDER . '/';

        // Set categories infos
        foreach( Config::CATEGORIES as $cat ) {
            Config::$categories_update_time[$cat] = empty( Config::$options->comarquage_update_time[$cat] ) ? 0 : Config::$options->comarquage_update_time[$cat];
            Config::set_categories_dir($cat, Config::$categories_update_time[$cat]);
        }

        // Include config files
        Config::$code_departements = include KIENSO_COMARQUAGE_CONFIG . 'code_departements.php';
    }

    public static function set_categories_dir($cat, $time) {
        Config::$categories_dir[$cat] = Config::$comarquage_dir . $cat . '/' . $time . '/';
    }

    public static function set_categories_update_time($cat, $time) {
        Message::add_debug('info', 'Begin set_categories_update_time ' . $cat . ' ' . $time );
        Config::$categories_update_time[$cat] = $time;
        update_option( 'comarquage_update_time', Config::$categories_update_time);
        Message::add_debug('info', 'End set_categories_update_time - ' . serialize(Config::$categories_update_time) );
    }

}
