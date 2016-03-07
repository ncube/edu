<?php 
class Request {
    public function _index() {
        // Deny access if not logged in
        new Protect('api');

        $post = Input::post();

        $token = Token::check($post['token']);

        if (!empty($post['username']) && !empty($post['type']) && $token === TRUE) {
            $request = User::request($post);
            if ($request === TRUE) {
                $data['success'][] = TRUE;
            } else {
                $data['errors'][] = $request;
            }
        } else {
            if (!$token) {
                $data['errors'][] = 'Security Token Missing';
            } else {
                $data['errors'][] = 'Username & Type Required';
            }
        }
        if (!empty($data)) {
            return $data;
        } else {
            return FALSE;
        }
    }
}