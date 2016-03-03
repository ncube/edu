<?php 
class InitApi {
    public function init($url) {
        $controller = 'NotFound';
        $method = '_index';

        if (file_exists('api/'.$url[0].'.php')) {
            $controller = $url[0];
            unset($url[0]);
        }
        require_once 'api/'.$controller.'.php';

        $controller = new $controller;

        if (isset($url[1])) {
            if (method_exists($controller, $url[1])) {
                $method = $url[1];
                unset($url[1]);
            }
        }

        $url = $url ? array_values($url) : [];

        return call_user_func_array([$controller, $method], $url);
    }
}