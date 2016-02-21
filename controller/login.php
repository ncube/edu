<?php
class Login extends Mvc {
    public function _index($args) {
        
        $post = $args['post'];

        if(empty($args['post'])) {
            header('Location: /');
            exit();
        }
               
        
        $validation = Validate::login($post);
        
        if ($validation === true) {
            User::login($post['username'], $post['password']);
        } else {
            print_r($validation);
        }
        
    }
}