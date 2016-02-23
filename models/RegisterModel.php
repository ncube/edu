<?php 
class RegisterModel {
    public $data;
    public function __construct() {
        $this->data['title'] = "Register - NCube School";
        $this->data['action'] = "";
        $this->data['token'] = Token::generate();
    }
}