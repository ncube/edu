<?php 
class Post {
    public function _index() {
        new Protect('ajax');
        $data['success'] = FALSE;
        $data['errors'] = NULL;

        $post = Input::post();
        $post = $post['post_data'];
        if (!empty($post)) {
            User::post($post);
        } else {
            $data['errors'] = 'No Data Received';

        }

        return $data;
    }
}