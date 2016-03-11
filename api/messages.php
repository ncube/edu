<?php 
class Messages {
    public function _index() {
        // Deny access if not logged in
        new Protect('api');

        $post = Input::post();
        $token = Token::ajaxCheck($post['token']);
        $data['success'] = FALSE;
        $data['errors'] = NULL;

        if (!empty($post['username'] && $token === TRUE)) {
            $msgs = User::getMessages($post['username']);
            foreach($msgs as $key => $value) {
                $msgs[$key]['time'] = date("d-M h:i A", $value['time']);
            }
            $data['msgs'] = $msgs;

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