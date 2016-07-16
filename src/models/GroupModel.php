<?php 
class GroupModel {
    public $data;

    public function __construct($url) {
        $user_data = User::getUserData(['username', 'first_name', 'last_name', 'user_id', 'email', 'profile_pic'])[0];

        $this->data['first_name'] = ucwords($user_data['first_name']);
        $this->data['last_name'] = ucwords($user_data['last_name']);

        $this->data['side_active']['groups'] = ' side-menu-active';

        $this->data['profile_pic'] = User::getProfilePic($user_data['profile_pic']);

        $this->data['title'] = 'Group - Ncube';
        $this->data['token'] = Token::generate();

        $this->data['grp_data'] = Group::getGroupData($url[0])[0];
        $this->data['grp_id'] = $this->data['grp_data']['group_id'];

        $this->data['grp_page'] = $url[1];

        require_once 'include/header.php';
    }
}