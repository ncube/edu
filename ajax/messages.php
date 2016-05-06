<?php 
class Messages {
    public function _index() {
        // Deny access if not logged in
        new Protect('ajax');

        $post = Input::post();
        $token = Token::ajaxCheck($post['token']);
        $data['success'] = FALSE;
        $data['errors'] = NULL;

        if (!empty($post['username'] && $token === TRUE)) {
            $msgs = Message::getMessages($post['username']);
            foreach($msgs as $key => $value) {
                $msgs[$key]['time'] = date("d-M h:i A", $value['time']);
            }
            $data['msgs'] = $msgs;
            Message::read(User::getPublicUserId($post['username']));
            //TODO: Replace with function
            DB::updateIf('msg_notif', array('status' => 1), array('user_id' => User::getPublicUserId($post['username']), 'to_id' => Session::get('user_id')));

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

    public function send() {
        new Protect('ajax');
        if (Input::exists()) {
            if (Token::ajaxCheck(Input::post('token'))) {
                // TODO: Check for empty messages, Validate messages

                $username = Input::post('username');
                $msg = Input::post('msg');
                if (!empty($username)) {
                    Message::sendMessage($username, $msg);
                    Notif::raiseMsgNotif(User::getPublicUserId($username));
                } else {
                    return 'Username Required';
                }
            } else {
                return 'Security Token Missing';
            }
        }
        return FALSE;
    }
}