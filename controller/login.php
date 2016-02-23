<?php 
class Login extends Mvc {
    public function _index() {

        $post = Input::post();

        if (empty($post)) {
            header('Location: /');
            exit();
        }


        $validation = Validate::login($post);
        $token = Token::check($post['token']);

        if ($validation === TRUE && $token === TRUE) {
            User::login($post['username'], $post['password']);
        } else {
            if (!$token) {
                echo 'Security Token Missing';
            } else {
                print_r($validation);
            }
        }

    }
}