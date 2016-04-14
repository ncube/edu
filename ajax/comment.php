<?php 
class Comment {
    public function _index() {
        new Protect('ajax');
        $data['success'] = FALSE;
        $data['errors'] = NULL;

        $post = Input::post();
        $post_id = $post['post_id'];
        $content = $post['content'];
        if (empty($post_id)) {
            $data['errors'] = 'Post Id Required';
        } else {
            User::comment($post_id, $content);
            $data['success'] = TRUE;
        }

        return $data;
    }
}