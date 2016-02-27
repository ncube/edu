<?php
class Session {
    public static function exists($name) {
        return (isset($_SESSION[$name])) ? TRUE : FALSE;
    }
    
    public static function create($name, $value) {
        return $_SESSION[$name] = $value;
    }
    
    public static function get($name) {
        return $_SESSION[$name];
    }
    
    public static function delete($name) {
        if(self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }
    
    public static function flash($name, $string = NULL) {
        if(self::exists($name) && $string === NULL) {
            $session = self::get($name);
            self::delete($name);
            return $session;
        } else {
            self::create($name, $string);
        }
        return FALSE;
    }
    
    public function login($user_id) {
        self::create('user_id', $user_id);
    }
    
    public function errors($errors, $to = NULL) {
        
        if ($to === NULL) {
            return self::flash('errors');
        } else {
            self::flash('errors', $errors);
            header('Location: '.$to);
            exit();
        }
    }
}