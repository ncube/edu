<?php 
require_once 'config/Config.php';
class App {
    public function __construct() {
        
        //Start Session
        session_start();
        
        // Auto Load Classes
        spl_autoload_register(function($class) {

            $paths = ['controller/', 'classes/', 'classes/DB/', 'models/'];

            foreach($paths as $path) {
                $file = $path.$class.'.php';
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        });
                
        // Sanitize Input Data
        $safe_data = Sanitize::nonDatabase();

        // Load Controller
        LoadController::init($safe_data);
    }
}