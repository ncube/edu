<?php
class Hash {
    public static function generate($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }
    
    public static function verify($password, $hash) {
        return password_verify($password, $hash);
    }
}