<?php 
class Register extends Mvc {

    public function _index() {

        // TODO: Add from CSRF

        $post = Input::post();

        if (!empty(($post))) {
            $validate = Validate::register($post);
            $token = Token::check($post['token']);
            if ($validate === TRUE && $token === TRUE) {
                User::addUser($post);
                echo 'Registered';
            } else {
                if (!$token) {
                    echo 'Security Token is missing';
                }
                echo '<pre>';
                print_r($validate);
                echo '</pre>';
            }
        } else {
            self::init('RegisterModel', 'register', $arg);
        }

    }
}