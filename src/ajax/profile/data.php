<?php
class Ajax {
    public $data;
    
    public function __construct() {
        $post = Input::post();
        $token = Token::ajaxCheck($post['token']);
        
        $data['success'] = FALSE;
        $data['errors'] = NULL;
        
        if ($token === TRUE) {
            $username = empty($post['username']) ? User::getPublicUsername(Session::get('user_id')) : $post['username'];
            
            $profile_id = User::getPublicUserId($username);
            $user = new User($profile_id);
            $user->getPublicData();
            $user->getProfilePic();
            $profile_data = $user->user_data;
            
            $data['user_id'] = $profile_id;
            $data['username'] = $username;
            $data['first_name'] = ucwords($profile_data['first_name']);
            $data['last_name'] = ucwords($profile_data['last_name']);
            $data['email'] = $profile_data['email'];
            $data['profile_pic'] = $profile_data['profile_pic'];
            
            $data['followers'] = $user->followerCount();
            $data['questions'] = Question::countUserQuestions($profile_data['user_id']);
            $data['answers'] = Question::countUserAnswers($profile_data['user_id']);
            
            $data['following'] = User::checkFollow($username);
            $data['default'] = empty($post['username']) ? TRUE : FALSE;
                
                $data['success'] = TRUE;
        } else {
            $data['errors'][] = 'Security Token Missing';
        }
        
        $this->data = $data;
    }
}