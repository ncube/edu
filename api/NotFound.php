<?php 
class NotFound {
    public function _index() {
        // Set Header for 404
        header("HTTP/1.0 404 Not Found");

        return FALSE;
    }
}