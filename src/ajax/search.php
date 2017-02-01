<?php 
class Ajax {
    public $data;
    public function __construct() {
        $post = Input::post();
        $token = Token::ajaxCheck($post['token']);
        $data['errors'] = NULL;

        if (!empty($post['username'] && $token === TRUE)) {
            $t = Search::publicUsername($post['username']);
            foreach($t as $key => $value) {
                $user_data = new User($value['user_id']);
                $user_data->getPublicData();
                $t[$key]['profile_pic'] = $user_data->getProfilePic();
            }
            $data = $t;
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