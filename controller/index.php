<?php
class Index extends Mvc {
    public function _index($args) {
        
        // Deny acces if not logged in
        new Protect;
        
        // Init MVC
        self::init('IndexModel', 'index', $args['get']['url']);
    }
}