<?php

$files = ['DB', 'logs', 'server'];

global $CONFIG;

foreach($files as $values) {
    $file = file_get_contents(__DIR__.'/'.$values.'.json');
    $config[$values] = json_decode($file, true);
}

$GLOBALS['config'] = $config;