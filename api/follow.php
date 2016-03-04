<?php 
class Follow {
    public function _index() {
        // Deny acces if not logged in
        new Protect('api');

        $post = Input::post();

        $token = Token::check($post['token']);

        if (!empty($post['username'] && $token === TRUE)) {
            $follow = User::follow($post);
            if ($follow !== TRUE) {
                $errors[] = $follow;
            }
        } else {
            if (!$token) {
                $errors[] = 'Security Token Missing';
            }
        }
        if (!empty($errors)) {
            return $errors;
        } else {
            return TRUE;
        }
    }
}