<?php
namespace Kienso\Comarquage\Admin;

defined( 'ABSPATH' ) || exit;

/**
 * Notices class
 */
class Notices {
    public function __construct() {
        if ( !is_admin() ) return; // Run following only on Admin

        add_action( 'admin_notices', [&$this, 'outdated_notice'] );
        add_action( 'admin_notices', [&$this, 'unmaintained_notice'] );
    }

    public function outdated_notice() : void {
        // Display this notice only to the admin
        if ( !current_user_can( 'manage_options' ) ) return;

        // Display this notice only on the following pages: Plugins, Dashboard, Comarquage Options
        if ( !in_array( get_current_screen()->id, ['plugins', 'dashboard', 'settings_page_comarquage-options'] ) ) return;

        // Dismiss the notice
        if ( isset( $_GET['dismiss_comarquage_od_notice'] ) ) {
            set_transient( 'comarquage_od_notice_dismissed', true, 120 * DAY_IN_SECONDS );
            return;
        }

        // Check if the notice has been dismissed
        if ( get_transient( 'comarquage_od_notice_dismissed' ) ) return;

        // Plugin page URL
        $plugin_page_url = 'https://www.baseo.io/plugins/comarquage-service-public-wordpress/?utm_source=anc-plugin&utm_campaign=admin-page';

        // Set the url for dismiss notice
        $dismiss_url = add_query_arg( 'dismiss_comarquage_od_notice', '', $_SERVER['REQUEST_URI'] );

        // Display the notice
        ob_start();
        ?>
        <div class="notice notice-warning is-dismissible">
            <p>
                <b>Attention :</b> Le plugin comarquage Service-Public est obsolète.<br/>
                Il affiche des données datant de Septembre 2023.<br/>
                Nous vous conseillons de le désinstaller ou <a href="<?= $plugin_page_url ?>" target="_blank">d’acheter le nouveau plugin</a>.
            </p>
            <a href="<?= $dismiss_url ?>" class="notice-dismiss" style="display: inline-flex; align-items: center; text-decoration: none;">
                <span style="margin-left: 2px">ignorer</span>
            </a>
        </div>
        <?php
        echo ob_get_clean();
    }

    public function unmaintained_notice() : void {
        // Display this notice only to the admin on the following pages: Comarquage Options
        if ( !in_array( get_current_screen()->id, ['settings_page_comarquage-options'] ) ) return;


        // Plugin page URL
        $plugin_page_url = 'https://www.baseo.io/plugins/comarquage-service-public-wordpress/?utm_source=anc-plugin&utm_campaign=admin-page';

        // Display the notice
        ob_start();
        ?>
        <div class="notice notice-warning is-dismissible">
            <p>
                <b>Attention :</b> Ce plugin n’est plus maintenu. Plus d’informations, vous rendre sur <a href="<?= $plugin_page_url ?>" target="_blank">www.baseo.io</a>.
            </p>
        </div>
        <?php
        echo ob_get_clean();
    }
}