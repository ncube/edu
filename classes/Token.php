<?php 
class Token {
    // Add token name to config
    public static function generate() {
        return Session::create('csrf_form_token', base64_encode(openssl_random_pseudo_bytes(32)));
    }

    public static function check($token) {
        $tokenName = 'csrf_form_token';

        if (Session::exists($tokenName) && $token === Session::get($tokenName)) {
            Session::delete($tokenName);
            return TRUE;
        }
        return FALSE;
    }

    public static function ajaxCheck($token) {
        $tokenName = 'csrf_form_token';

        if (Session::exists($tokenName) && $token === Session::get($tokenName)) {
            return TRUE;
        }
        return FALSE;
    }
}