<?php
class Index extends Mvc {
    public function _index($args) {
        // Init MVC
        self::init('LoginModel', 'login', $args);
    }
}