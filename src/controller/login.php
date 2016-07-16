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
        
        $errors = NULL;
        
        if ($validation === TRUE && $token === TRUE) {
            if (!User::login($post['username'], $post['password'])) {
                $errors = 'Username or Password is Incorrect'; 
            }
        } else {
            $errors = $validation;
            if (!$token) {
                $errors = 'Security Token Missing';
            }
        }
        if (!empty($errors)) {
            Session::errors($errors, '/');
        }
    }
}