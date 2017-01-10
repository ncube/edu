<?php

$files = ['DB', 'logs', 'server', 'libs', 'content', 'routes'];

foreach($files as $value) {
    require_once(__DIR__.'/'.$value.'.php');
}

$GLOBALS['config'] = $config;
$GLOBALS['content'] = $content;
$GLOBALS['routes'] = $routes;