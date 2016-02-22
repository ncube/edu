<?php 
class IndexModel {
    public $data;

    public function __construct() {

        $userData = User::getUserData(['username', 'first_name', 'last_name', 'user_id', 'email']);

        $this->data['title'] = 'Home - NCube School';
        $this->data['first_name'] = ucwords($userData->first_name);
        $this->data['last_name'] = ucwords($userData->last_name);
    }
}