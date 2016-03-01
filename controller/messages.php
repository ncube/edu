<?php 
class Messages extends Mvc {
    public function _index($url) {
        new Protect;
        if (Input::exists()) {
            if (Token::check(Input::post('token'))) {
                //TODO: Check for empty messages, Validate messages
                $msg = Input::post('msg');
                User::sendMessage(Input::post('username'), $msg);
            } else {
                echo 'Security Token Missing';
                die();
            }
        }
        self::init('MessagesModel', 'messages', $url);
    }
}