<?php
require_once 'classes/init.php';  

// Application
if ($GLOBALS['config']['server']['status']) {
    new App();
} else {
    die();
}