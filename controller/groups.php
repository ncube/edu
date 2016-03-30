<?php 
class Groups extends Mvc {
    public function _index($url) {
        new Protect;
        if (!empty($url[0])) {
            self::init('GroupModel', 'group', $url);
        } else {
            self::init('GroupsListModel', 'groupsList', $url);
        }
    }

    public function create() {
        // TODO: Validate

        $post = Input::post();
        $token = Token::check($post['token']);
        if (!empty($post['name']) && $token === TRUE) {
            $data = NULL;
            $data['group_id'] = md5(uniqid());
            $data['group_name'] = $post['name'];
            $data['desp'] = $post['desp'];
            $data['status'] = 1;
            $data['time'] = time();

            DB::insert('group', $data);
            DB::insert('group_user', array('user_id' => Session::get('user_id'), 'group_id' => $data['group_id'], 'type' => 'A', 'time' => time(), 'status' => '1'));
            echo 'Group Created';
        } else {
            echo 'Empty or security token missing';
        }
    }
}