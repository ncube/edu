<?php 
class MessagesModel {
    public $data;

    public function __construct($url) {

        $userData = User::getUserData(['username', 'first_name', 'last_name', 'user_id', 'email', 'profile_pic'])[0];

        $this->data['first_name'] = ucwords($userData['first_name']);
        $this->data['last_name'] = ucwords($userData['last_name']);
        
        $this->data['side_active']['messages'] = ' side-menu-active';
        
        if (empty($userData['profile_pic'])) {
            $this->data['profile_pic'] = '/public/images/profile-pic.png';
        } else {
            $this->data['profile_pic'] = '/data/images/profile/'.$userData['profile_pic'].'.jpg';
        }

        $this->data['title'] = 'Messages - Ncube';
        $this->data['token'] = Token::generate();
        $this->data['active_username'] = $url[0];
        $this->data['list_data'] = User::getAcceptedUsersData();

        if (!empty($url[0])) {
            $data = User::getMessages($url[0]);
            foreach($data as $key => $value) {
                $data[$key]['time'] = date("h:i A", $value['time']);
            }
            $this->data['msgs'] = $data;
        }

        $this->data['recipient'] = $url[0];
    }
}