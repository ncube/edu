<?php 
class VoteDown {
    public function _index() {
        new Protect('ajax');
        $data['success'] = FALSE;
        $data['errors'] = NULL;

        $post = Input::post();
        $q_id = $post['q_id'];
        if (empty($q_id)) {
            $data['errors'] = 'Question Id required';
        } else {
            Question::voteQuestion($q_id, FALSE);
            $data['success'] = TRUE;
        }
        return $data;
    }
}