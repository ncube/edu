<?php 
class MessagesModel {
    public $data;

    public function __construct($url) {

        $user_data = User::getUserData(['username', 'first_name', 'last_name', 'user_id', 'email', 'profile_pic'])[0];

        $this->data['first_name'] = ucwords($user_data['first_name']);
        $this->data['last_name'] = ucwords($user_data['last_name']);
        
        $this->data['side_active']['messages'] = ' side-menu-active';
        
        $this->data['profile_pic'] = User::getProfilePic($user_data['profile_pic']);

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