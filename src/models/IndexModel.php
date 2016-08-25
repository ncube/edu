<?php 
class IndexModel {
    public $data;

    public function __construct() {

        $user_data = User::getUserData(['username', 'first_name', 'last_name', 'user_id', 'email', 'profile_pic'])[0];

        $this->data['title'] = 'Home - NCube School';
        $this->data['first_name'] = ucwords($user_data['first_name']);
        $this->data['last_name'] = ucwords($user_data['last_name']);
        $this->data['token'] = Token::generate();
        $this->data['username'] = $user_data['username'];

        $this->data['side_active']['home'] = ' active';

        $this->data['profile_pic'] = User::getProfilePic($user_data['profile_pic']);
        
        require_once 'include/header.php';
    }
}