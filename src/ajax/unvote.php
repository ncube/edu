<?php 
class Ajax {
    public $data;
    public function __construct() {
        $data['success'] = FALSE;
        $data['errors'] = NULL;

        // TODO: Add Token check.

        $post = Input::post();
        $q_id = $post['q_id'];
        if (empty($q_id)) {
            $data['errors'] = 'Question Id required';
        } else {
            Question::unVoteQuestion($q_id);
            $data['success'] = TRUE;
        }
        return $data;
    }
}