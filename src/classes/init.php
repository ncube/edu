<?php 
require_once 'config/Config.php';
class App {
    public function __construct() {

        //Start Session
        session_start();

        // Auto Load Classes
        spl_autoload_register(function($class) {

            // TODO: Move paths to config file.
            $paths = ['controller/', 'classes/', 'classes/DB/', 'models/', 'classes/Php/', 'classes/User/'];

            foreach($paths as $path) {
                $file = $path.$class.'.php';
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        });

        // Load Controller
        LoadController::init();
    }
}