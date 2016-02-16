<?php
class LoginModel {
    public $data;
    
    public function __construct() {
        $this->data['title'] = 'Login - NCube School';
        $this->data['action'] = 'login';
    }
}