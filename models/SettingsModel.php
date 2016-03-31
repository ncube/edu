<?php 
class SettingsModel {
    public $data;
    public function __construct($url) {
        $userData = User::getUserData(['username', 'first_name', 'last_name', 'user_id', 'email', 'profile_pic'])[0];

        $this->data['title'] = 'Settings - NCube School';
        $this->data['first_name'] = ucwords($userData['first_name']);
        $this->data['last_name'] = ucwords($userData['last_name']);
        $this->data['email'] = $userData['email'];
        $this->data['token'] = Token::generate();
        $this->data['username'] = $userData['username'];

        $this->data['url'] = $url;


        $this->data['side_active']['settings'] = ' side-menu-active';
        $this->data['active'] = NULL;
        if (!empty($url[0])) {
            $this->data['active'][$url[0]] = ' stngs-menu-item-active';
        }

        if (empty($userData['profile_pic'])) {
            $this->data['profile_pic'] = '/public/images/profile-pic.png';
        } else {
            $this->data['profile_pic'] = '/data/images/profile/'.$userData['profile_pic'].'.jpg';
        }
    }
}