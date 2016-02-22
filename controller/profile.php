<?php 
class Profile {
    public function _index($args) {
        if (empty($args['url'][0])) {
            $args['url'][0] = User::getUserData('username');
        }
        $username = $args['url'][0];
        $user_id = User::getPublicUserId($username);

        $data = User::getPublicData($user_id);

        echo '<pre>';
        if ($data) {
            print_r($data);
        } else {
            echo 'Sorry User not found or Private User';
        }
        echo '</pre>';
    }
}