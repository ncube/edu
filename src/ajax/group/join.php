<?php
class Ajax {
    public $data;
    public function __construct() {

        $data['success'] = FALSE;
        $data['errors'] = NULL;

        $post = Input::post();

        $token = Token::ajaxCheck($post['token']);

        if($token) {
            $id = Session::get('user_id');
            $data['id'] = $id;
            $group = new Group($post['id']);
            $data['success'] = $group->joinAsMember();;
        } else {
            $data['errors'] = 'Security Token Missing';
        }

        $this->data = $data;
    }

}