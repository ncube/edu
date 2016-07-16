<?php 
class Likes {
    public function _index() {
        $data['count'] = User::getLikesCount();
        return $data;
    }
    public function like() {
        new Protect('ajax');
        $data['success'] = FALSE;
        $data['errors'] = NULL;

        // TODO: Add Token check.

        $post = Input::post();
        $post_id = $post['q_id'];
        if (!empty($post_id)) {
            $count = count(DB::fetch('post_likes', array('user_id' => Session::get('user_id'), 'post_id' => $post_id)));
            if ($count > 0) {
                DB::deleteIf('post_likes', array('post_id' => $post_id), array('user_id' => Session::get('user_id')));
                $data['success'] = TRUE;
            } else {
                User::likePost($post_id);
                $data['success'] = TRUE;
            }
        } else {
            $data['errors'] = 'Post Id required';
        }
        return $data;
    }
}