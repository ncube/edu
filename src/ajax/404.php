<?php 
class Ajax {
    public $data;
    public function __construct() {
        // Set Header for 404
        header("HTTP/1.0 404 Not Found");

        $data['error'] = '404';
        $this->data = $data;
    }
}