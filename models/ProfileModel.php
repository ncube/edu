<?php
class ProfileModel {
    public $data;
    public function __construct($username) {
        $this->data['title'] = ucwords($username);
        $this->data['username'] = $username;
        $this->data['token'] = Token::generate();
    }
}