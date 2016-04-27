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
            $t = Search::publicUsername($post['username']);
            foreach($t as $key => $value) {
                $t[$key]['profile_pic'] = User::getProfilePic($value['profile_pic']);
            }
            return $t;
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