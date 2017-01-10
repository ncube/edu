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

        // Parse Url
        $url = rtrim(Input::get('url'), '/');
        $url_array = Utils::parseUrl($url);
        $url_array[0] = ($url_array[0] === 'index.php') ? 'index' : $url_array[0];

        // Load Global Variables
        $GLOBALS['url'] = $url;
        $GLOBALS['url_array'] = $url_array;

        // Load Controller        
        require_once 'controller.php';

        new Controller;
    }
}