<?php
class Controller {
    public function __construct() {
        $url = $GLOBALS['url_array'];
        $route = new Route;
        $name = $route->page;

        // TODO: Change ajax architecture
        if($url[0] === 'ajax') {
            $controller = 'NotFound';

            $method = '_index';

            $controller = $url[0];
            unset($url[0]);
            require_once 'controller/'.$controller.'.php';

            $controller = new $controller;

            if (isset($url[1])) {
                if (method_exists($controller, $url[1])) {
                    $method = $url[1];
                    unset($url[1]);
                }
            }

            $url = $url ? array_values($url) : [];

            call_user_func_array([$controller, $method], array($url));
        } else {
            $page = $url[0];
            unset($url[0]);
            $url = $url ? array_values($url) : [];
            $page = new Core($name, $url, $page);
            $page->serve();
        }
    }
}