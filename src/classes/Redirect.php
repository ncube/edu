<?php 
class Redirect {
    public static function to($location) {
        header('Location: '.$location);
        exit();
    }

    public static function ref() {
        
        $ref = $_SERVER['HTTP_REFERER'];
        $ref = explode('/', filter_var(rtrim($ref, '/'), FILTER_SANITIZE_URL));
 
        unset($ref[0]);
        unset($ref[1]);
        unset($ref[2]);
        $url = "/";
        foreach($ref as $value) {
            $url .= $value.'/';
        }
        self::to($url);
    }
}