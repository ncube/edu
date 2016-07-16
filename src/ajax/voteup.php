<?php 
class Voteup {
    public function _index() {
        new Protect('ajax');
        $data['success'] = FALSE;
        $data['errors'] = NULL;

        // TODO: Add Token check.

        $post = Input::post();
        $q_id = $post['q_id'];
        if (empty($q_id)) {
            $data['errors'] = 'Question Id required';
        } else {
            Question::voteQuestion($q_id, TRUE);
            $data['success'] = TRUE;
        }
        return $data;
    }
}