<?php
require_once 'classes/init.php';

// Configuration
function loadConfig() {
    $file = file_get_contents('config.json');
    $data = json_decode($file, true);
    return $data;
}
$config = loadConfig();

// Application
if ($config['status']) {
    new App;
} else {
    die();
}