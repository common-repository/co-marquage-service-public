<?php
namespace Kienso\Comarquage;

defined( 'ABSPATH' ) || exit;

class Message {

    static $messages = [];

    function __construct() {
        add_action( 'admin_notices', [&$this, 'display'] );
    }

    /**
     * Display all messages in pool
     * @return [type] [description]
     */
    public static function display() {
        foreach(Message::$messages as $type => $message) {
            if(is_admin()) {
                echo '<div class="notice notice-'. $type .' is-dismissible"><p>' . $message . '</p></div>';
            } else {
                echo '<div class="co-alert co-alert-'. $type .'" role="alert">' . $message . '</div>';
            }
        }
        Message::$messages = []; // Reset messages pool
    }

    /**
     * Add message to the pool
     * @param string $type    info, warning, error, success
     * @param string $message message text
     */
    public static function add($type, $message = '' ) {
        // Set default value of $type to 'info'
        if (!isset($type) || empty($type)) {
            $type = 'info';
        }

        Message::$messages[$type] = $message;

        // On frontend display messages when they occur
        if( !is_admin() ) {
            Message::display();
        }
    }

    /**
     * Add debug message to the pool
     * @param string $type    info, warning, error, success
     * @param string $message message text
     */
    public static function add_debug($type, $message ) {
        // Set default value of $type to 'info'
        if (!isset($type) || empty($type)) {
            $type = 'info';
        }

        if ( Config::$options->comarquage_debug_enable ) {
            Message::add( 'debug', 'debug - ' . $type . ' : ' . $message);
        }
    }

}
