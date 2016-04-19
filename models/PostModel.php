<?php 
class PostModel {
    public $data;

    public function __construct($url) {

        $user_data = User::getUserData(['username', 'first_name', 'last_name', 'user_id', 'email', 'profile_pic'])[0];

        $this->data['title'] = 'Post - NCube School';
        $this->data['first_name'] = ucwords($user_data['first_name']);
        $this->data['last_name'] = ucwords($user_data['last_name']);
        $this->data['token'] = Token::generate();
        $this->data['username'] = $user_data['username'];

        $this->data['side_active']['home'] = ' side-menu-active';

        $this->data['profile_pic'] = User::getProfilePic($user_data['profile_pic']);

        $feed = User::getPublicPost($url[0]);
        if (!empty($feed)) {
            foreach($feed as $key => $value) {
                $id = $value['user_id'];
                $temp = User::getPublicUserData($id, ['username', 'profile_pic'])[0];

                foreach($temp as $key2 => $value2) {
                    $feed[$key][$key2] = $value2;
                }

                if ($feed[$key]['profile_pic'] === NULL) {
                    $feed[$key]['profile_pic'] = '/public/images/profile-pic.png';
                } else {
                    $feed[$key]['profile_pic'] = '/data/images/profile/'.$feed[$key]['profile_pic'].'.jpg';
                }

                $comments = PhpConvert::toArray(DB::fetch('comment', array('post_id' => $value['unique_id'])));
                foreach($comments as $key2 => $value2) {
                    $user_data = User::getPublicUserData($value2['user_id'])[0];
                    $comments[$key2]['profile_pic'] = User::getProfilePic($user_data['profile_pic']);
                    $comments[$key2]['username'] = $user_data['username'];
                }

                $feed[$key]['comments'] = $comments;

            }
        }

        $this->data['feed'] = $feed;
    }
}