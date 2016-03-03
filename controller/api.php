<?php 
class Api {
    public function _index($url) {
        require_once 'api/init.php';

        header('Content-Type: application/json');
        echo json_encode(InitApi::init($url));
    }
}