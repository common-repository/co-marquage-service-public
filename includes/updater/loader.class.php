<?php
namespace Kienso\Comarquage\Updater;

defined( 'ABSPATH' ) || exit;

class Loader {

    public function __construct() {
        new Updater();
    }
}