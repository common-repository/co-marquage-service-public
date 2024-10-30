<?php
/**
 * Comarquage service-public.fr Plugin.
 *
 * @package      KIENSO
 * @copyright    Copyright (C) 2017, Kienso
 * @link         https://www.kienso.fr
 * @since        0.4.0
 *
 * @wordpress-plugin
 * Plugin Name:       Comarquage service-public.fr
 * Version:           0.5.76
 * Plugin URI:        https://www.kienso.fr/wordpress-co-marquage-service-public/
 * Description:       Affiche les informations de service-public.fr. Flux de comarquage : v3. Page de sommaire : [comarquage category="part/pro/asso"]. Fiche : [comarquage category="part" xml="F18910"]
 * Author:            Kienso
 * Author URI:        https://www.kienso.fr
 * License:           GPLv3
 * License URI:       http://www.gnu.org/licenses/gpl.html
 */
namespace Kienso\Comarquage;

defined('ABSPATH') || exit();

/* Constantes
 --------------------------------------------------------------------------- */
const version = '0.5.76';

/* Main Class
 --------------------------------------------------------------------------- */
final class Comarquage
{
    public function __construct()
    {
        // Load define
        $this->define_constants();

        // Class autoloader
        spl_autoload_register([&$this, 'autoload_class']);

        $this->load();
    }

    private function define_constants()
    {
        define('KIENSO_COMARQUAGE_VERSION', version);
        define('KIENSO_COMARQUAGE_FILE', __FILE__);
        define('KIENSO_COMARQUAGE_DIR', trailingslashit(plugin_dir_path(__FILE__)));
        define('KIENSO_COMARQUAGE_URL', trailingslashit(plugin_dir_url(__FILE__)));
        define('KIENSO_COMARQUAGE_DIR_ASSETS', KIENSO_COMARQUAGE_DIR . trailingslashit('assets'));
        define('KIENSO_COMARQUAGE_URL_ASSETS', KIENSO_COMARQUAGE_URL . trailingslashit('assets'));
        define('KIENSO_COMARQUAGE_INCLUDES', KIENSO_COMARQUAGE_DIR . trailingslashit('includes'));
        define('KIENSO_COMARQUAGE_CONFIG', KIENSO_COMARQUAGE_INCLUDES . trailingslashit('config'));
        define('KIENSO_COMARQUAGE_TEMPLATES', KIENSO_COMARQUAGE_DIR . trailingslashit('templates'));
    }

    /**
     * Class autoloader
     * @param  string $class the class name
     * @return boolean true if our class, false if not
     */
    private function autoload_class($class)
    {
        if (strpos($class, 'Kienso\Comarquage') === false) {
            return false;
        } // If not our namespace stop autoloader
        $class = str_replace('Kienso\Comarquage', '', $class); // Remove base namespace
        $class = strtolower($class); // go to lowercase
        $class = str_replace('_', '-', $class);
        $file =
            KIENSO_COMARQUAGE_INCLUDES .
            str_replace('\\', DIRECTORY_SEPARATOR, $class . '.class.php'); // Transform namespace to file path
        if (file_exists($file)) {
            include_once $file;
            return true;
        }
        return false;
    }

    /**
     * The main loader. Call the other loader
     */
    private function load()
    {
        new Config();
        new Message();
        new Install\Loader();
        new Updater\Loader();
        new Admin\Loader();
        new Front\Loader();
    }
}

$GLOBALS['kienso_comarquage'] = new Comarquage();
