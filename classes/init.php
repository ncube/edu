<?php 
require_once 'config/Config.php';
class App {
    public function __construct() {                
        
        // Auto Load Classes
        spl_autoload_register(function($class) {

            $paths = ['controller/', 'classes/', 'models/'];

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