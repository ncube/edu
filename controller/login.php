<?php
class Login extends Mvc {
    public function _index($args) {

        if(empty($args['post'])) {
            header('Location: /');
            exit();
        }
        
        ?><pre><?php
        print_r($args['post']);
        ?></pre><?php
    }
}