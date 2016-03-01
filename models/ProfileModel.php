<?php
class ProfileModel {
    public $data;
    public function __construct($username) {
        $this->data['title'] = ucwords($username);
        $this->data['username'] = $username;
        $this->data['token'] = Token::generate();
        
        $id = User::getPublicUserId($username);
        $userData = User::getPublicUserData($id);
        
        
        $this->data['first_name'] = ucwords($userData->first_name);
        $this->data['last_name'] = ucwords($userData->last_name);
        $this->data['email'] = $userData->email;
    }
}