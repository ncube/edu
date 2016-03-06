<?php 
class Index extends Mvc {
    public function _index($url) {

        // Deny access if not logged in
        new Protect;

        // Init MVC
        self::init('IndexModel', 'index');
    }
}