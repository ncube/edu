<?php 
class Logout extends Mvc {
    public function _index() {

        $token = $token = Token::check(Input::post('token'));

        if ($token) {
            // Destroy Session
            session_destroy();

            // Redirect to index
            Redirect::to('/');
        } else {
            echo 'Security Token Missing';
        }
    }
}