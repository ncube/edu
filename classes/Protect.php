<?php
class Protect {
    public function __construct() {
        if (!Session::exists('user_id')) {
            Mvc::init('LoginModel', 'login', $args);
            die();
        }
    }
}