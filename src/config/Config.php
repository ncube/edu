<?php

$files = ['DB', 'logs', 'server', 'libs', 'content', 'routes', 'routes_ajax'];

foreach($files as $value) {
    require_once(__DIR__.'/'.$value.'.php');
}

$GLOBALS['config'] = $config;
$GLOBALS['content'] = $content;
$GLOBALS['routes_ajax'] = $routes_ajax;
$GLOBALS['routes'] = $routes;