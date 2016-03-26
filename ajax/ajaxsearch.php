<?php 
class AjaxSearch {
    public function _index() {
        // Deny access if not logged in
        new Protect('ajax');

        $post = Input::post();

        $token = Token::ajaxCheck($post['token']);
        
        // TODO: Add Token Support
        $token = TRUE;

        $data['errors'] = NULL;

        if (!empty($post['username'] && $token === TRUE)) {
            return Search::publicUsername($post['username']);
        } else {
            if (!$token) {
                $data['errors'][] = 'Security Token Missing';
            } else {
                $data['errors'][] = 'Username Required';
            }
        }
        if (!empty($data)) {
            return $data;
        } else {
            return FALSE;
        }
    }
}