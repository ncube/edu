<?php 
class Unfollow {
    public function _index() {
        // Deny access if not logged in
        new Protect('api');

        $post = Input::post();

        $token = Token::ajaxCheck($post['token']);
        $data['success'] = FALSE;

        $data['errors'] = NULL;

        if (!empty($post['username'] && $token === TRUE)) {
            $unfollow = User::unFollow($post['username']);
            if ($unfollow === TRUE) {
                $data['success'] = TRUE;
            }
        } else {
            if (!$token) {
                $data['errors'][] = 'Security Token Missing';
            } else {
                $data['errors'][] = 'Username Required';
            }
        }
        if (!empty($data)) {
            return $data;
        } else {
            return FALSE;
        }
    }
}