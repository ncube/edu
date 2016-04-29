<?php 
class Requests extends Mvc {
    public function _index($url) {
        self::init('RequestsModel', 'requests', $url);
    }

    public function accept() {
        $post = Input::post();
        if (!empty($post['username'])) {
            if (Token::check($post['token']) === TRUE) {
                User::accept(Input::post());
            } else {
                echo 'Security Token Missing';
            }
        } else {
            echo 'username required';
        }
    }
}