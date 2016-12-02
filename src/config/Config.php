<?php

$files = ['DB', 'logs', 'server', 'libs', 'content', 'pages', 'routes'];

foreach($files as $value) {
    require_once(__DIR__.'/'.$value.'.php');
}

$GLOBALS['config'] = $config;
$GLOBALS['pages'] = $pages;
$GLOBALS['content'] = $content;
$GLOBALS['routes'] = $routes;