<?php 
class Input {
    public static function exists($type = 'post') {
        switch ($type) {
            case 'post':
                return (!empty($_POST)) ? TRUE : FALSE;
                break;
            case 'get':
                return (!empty($_GET)) ? TRUE : FALSE;
                break;
            default:
                return FALSE;
                break;
        }
    }

    public static function get($item = NULL) {
        $safe_data = Sanitize::nonDatabase();

        if ($item === NULL) {
            return $safe_data['get'];
        } else {
            return $safe_data['get'][$item];
        }
        return '';
    }

    public static function post($item = NULL) {
        $safe_data = Sanitize::nonDatabase();

        if ($item === NULL) {
            return $safe_data['post'];
        } else {
            return $safe_data['post'][$item];
        }
        return '';
    }
}