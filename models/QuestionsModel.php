<?php 
class QuestionsModel {
    public $data;

    public function __construct() {

        $userData = User::getUserData(['username', 'first_name', 'last_name', 'user_id', 'email', 'profile_pic'])[0];

        $this->data['title'] = 'Questions - NCube School';
        $this->data['first_name'] = ucwords($userData['first_name']);
        $this->data['last_name'] = ucwords($userData['last_name']);
        $this->data['token'] = Token::generate();
        $this->data['username'] = $userData['username'];

        $this->data['side_active']['questions'] = ' side-menu-active';

        if (empty($userData['profile_pic'])) {
            $this->data['profile_pic'] = '/public/images/profile-pic.png';
        } else {
            $this->data['profile_pic'] = '/data/images/profile/'.$userData['profile_pic'].'.jpg';
        }

        $this->data['questions'] = User::getPublicQuestions();
    }
}