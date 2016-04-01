<?php 
class GroupModel {
    public $data;

    public function __construct($url) {
        $userData = User::getUserData(['username', 'first_name', 'last_name', 'user_id', 'email', 'profile_pic'])[0];

        $this->data['first_name'] = ucwords($userData['first_name']);
        $this->data['last_name'] = ucwords($userData['last_name']);

        $this->data['side_active']['groups'] = ' side-menu-active';

        if (empty($userData['profile_pic'])) {
            $this->data['profile_pic'] = '/public/images/profile-pic.png';
        } else {
            $this->data['profile_pic'] = '/data/images/profile/'.$userData['profile_pic'].'.jpg';
        }

        $this->data['title'] = 'Group - Ncube';
        $this->data['token'] = Token::generate();

        $this->data['grp_data'] = User::getGroupData($url[0])[0];
        $this->data['grp_id'] = $this->data['grp_data']['group_id'];

        $this->data['grp_page'] = $url[1];
    }
}