<?php 
class Ajax {
    public $data;
    public function __construct() {
        switch ($GLOBALS['url_array'][3]) {
            case 'get':
                self::get();
                break;

            case 'send':
                self::send();
                break;
            
            default:
                $this->data = FALSE;
                break;
        }
    }

    public function send() {
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

    public function get() {
        $post = Input::post();
        $token = Token::ajaxCheck($post['token']);
        $data['success'] = FALSE;
        $data['errors'] = NULL;

        if (!empty($post['username'] && $token === TRUE)) {
            $msgs = Message::getMessages($post['username']);
            $data['success'] = TRUE;
            foreach($msgs as $key => $value) {
                $msgs[$key]['time'] = date("d-M h:i A", $value['time']);
            }
            $data['msgs'] = $msgs;
            Message::read(User::getPublicUserId($post['username']));
            //TODO: Replace with function
            DB::updateIf('msg_notif', array('status' => 1), array('user_id' => User::getPublicUserId($post['username']), 'to_id' => Session::get('user_id')));
        } else {
            if (!$token) {
                $data['errors'][] = 'Security Token Missing';
            } else {
                $data['errors'][] = 'Username Required';
            }
        }
        if (!empty($data)) {
            $this->data = $data;
        } else {
            $this->data = FALSE;
        }
    }
}