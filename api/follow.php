<?php 
class Follow {
    public function _index() {
        // Deny access if not logged in
        new Protect('api');

        $post = Input::post();

        $token = Token::ajaxCheck($post['token']);
        $data['success'] = FALSE;

        $data['errors'] = NULL;

        if (!empty($post['username'] && $token === TRUE)) {
            $follow = User::follow($post['username']);
            if ($follow === TRUE) {
                $data['success'] = TRUE;
            } else {
                $data['errors'][] = $follow;
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