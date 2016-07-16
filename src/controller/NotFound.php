<?php 
class NotFound extends Mvc {

    public function _index() {

        // Set Header for 404
        header("HTTP/1.0 404 Not Found");

        // Init MVC
        self::init('NotFoundModel', 'NotFound', Input::get('url'));
    }
}