<?php 
class SettingsModel {
    public $data;
    public function __construct($url) {
        $user_data = User::getUserData(['username', 'first_name', 'last_name', 'user_id', 'email', 'profile_pic'])[0];

        $this->data['title'] = 'Settings - NCube School';
        $this->data['first_name'] = ucwords($user_data['first_name']);
        $this->data['last_name'] = ucwords($user_data['last_name']);
        $this->data['email'] = $user_data['email'];
        $this->data['token'] = Token::generate();
        $this->data['username'] = $user_data['username'];

        $this->data['url'] = $url;
        
        require_once 'include/header.php';

        $this->data['side_active']['settings'] = ' side-menu-active';
        $this->data['active'] = NULL;
        if (!empty($url[0])) {
            $this->data['active'][$url[0]] = ' stngs-menu-item-active';
        }

        $this->data['profile_pic'] = User::getProfilePic($user_data['profile_pic']);
    }
}