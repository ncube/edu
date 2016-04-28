<?php 
class Requests extends Mvc {
    public function _index() {
        $user_id = Session::get('user_id');
        $requests = User::getRequests();


        foreach($requests as $key => $value) {
            $user_data = User::getPublicUserData($value['user_id'])[0];

            echo '
                <form action="/requests/accept" method="post">
                    '.$user_data['username'].'
                    <input type="hidden" name="username" value="'.$user_data['username'].'">
                    <input type="hidden" name="token" value="'.Token::generate().'">
                    <input type="submit" value="Accept">
                </form>
                <br>
            ';
        }

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