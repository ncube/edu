<?php
class Controller {
    public function __construct() {
        $url = $GLOBALS['url_array'];
        $route = new Route;
        $name = $route->page;

        // TODO: Change ajax architecture
        if($url[0] === 'ajax') {
            $route = $GLOBALS['routes_ajax'][$name];
            if ($route['protect']) {
                new Protect('ajax');
            }
            include 'ajax/'.$route['file'].'.php';
            $ajax = new Ajax;

            header('Content-Type: application/json');
            echo json_encode($ajax->data);
        } else {
            $protect = (isset($GLOBALS['routes'][$name]['protect'])) ? TRUE : FALSE;
            if ($protect) {
                new Protect;
            }
            $page = new Core($name);
            $page->serve();
        }
    }
}