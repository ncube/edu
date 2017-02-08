<?php
class Ajax {
    public $data;
    public function __construct() {

        $data['success'] = FALSE;
        $data['errors'] = NULL;

        $post = Input::post();
        $group = new Group($post['id']);

        $token = Token::ajaxCheck($post['token']);
        $id = Session::get('user_id');

        if($group->isAdmin($id)) {
            if($token) {
                $data['id'] = $id;
                $group = new Group($post['id']);
                $data['success'] = $group->rejectUser($post['user_id']);;
            } else {
                $data['errors'] = 'Security Token Missing';
            }
        } else {
            $data['errors'] = 'Access Denied';
        }

        $this->data = $data;
    }

}