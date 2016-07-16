<?php 
class Difficulty {
    public function _index() {
        new Protect('ajax');
        $data['success'] = FALSE;
        $data['errors'] = NULL;

        // TODO: Add Token check.

        $post = Input::post();
        $q_id = $post['q_id'];
        $level = $post['level'];
        if (empty($q_id)) {
            $data['errors'] = 'Question Id Required';
        } else {
            Question::questionDifficulty($q_id, $level);
            $data['success'] = TRUE;
        }
        return $data;
    }
}