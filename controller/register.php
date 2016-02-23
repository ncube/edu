<?php 
class Register extends Mvc {

    public function _index() {

        // TODO: Add from CSRF

        $post = Input::post();

        if (!empty(($post))) {
            $validate = Validate::register($post);
            if ($validate === TRUE) {
                User::addUser($post);
                echo 'Registered';
            } else {
                echo '<pre>';
                print_r($validate);
                echo '</pre>';
            }
        } else {
            self::init('RegisterModel', 'register', $arg);
        }

    }
}