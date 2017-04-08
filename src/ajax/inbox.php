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
                    Inbox::sendMessage($username, $msg);
                    // Notif::raiseMsgNotif(User::getPublicUserId($username));
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
            $msgs = Inbox::getMessages($post['username']);
            $data['success'] = TRUE;
            foreach($msgs as $key => $value) {
                $time = new Time($value['time']);
                $msgs[$key]['time'] = $time->hrf;
            }
            $data['msgs'] = $msgs;
            Inbox::read(User::getPublicUserId($post['username']));
            //TODO: Replace with function
            $db = DB::connect();
            $db->updateIf('msg_notif', array('status' => 1), array('user_id' => User::getPublicUserId($post['username']), 'to_id' => Session::get('user_id')));
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