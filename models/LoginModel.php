<?php 
class LoginModel {
    public $data;

    public function __construct() {
        $this->data['title'] = 'Login - NCube School';
        $this->data['loginAction'] = 'login';
        $this->data['registerAction'] = 'register';
        $this->data['token'] = Token::generate();
        
        $errors = Session::errors('errors');
        if (gettype($errors) === 'string') {
            $errors = array($errors);
        }
                
        $this->data['errors'] = $errors;        
    }
}