<?php
class QuestionsModel {
    public $data;
    
    public function __construct($url) {
        
        $user_data = User::getUserData(['username', 'first_name', 'last_name', 'user_id', 'email', 'profile_pic'])[0];
        
        $this->data['title'] = 'Question - NCube School';
        $this->data['first_name'] = ucwords($user_data['first_name']);
        $this->data['last_name'] = ucwords($user_data['last_name']);
        $this->data['token'] = Token::generate();
        $this->data['username'] = $user_data['username'];
        
        $this->data['side_active']['questions'] = ' active';
        
        $this->data['profile_pic'] = User::getProfilePic($user_data['profile_pic']);
        
        $this->data['question'] = Question::getPublicQuestion($url[0])[0];
        $this->data['q_user'] = User::getPublicUserData($this->data['question']['user_id'])[0];
        $this->data['q_user']['profile_pic'] = User::getProfilePic($this->data['q_user']['profile_pic']);

        $this->data['question']['up_count'] = Question::getVoteUpCount($this->data['question']['q_id']);
        $this->data['question']['down_count'] = Question::getVoteDownCount($this->data['question']['q_id']);
        $this->data['question']['level'] = Question::getDifficultyLevel($this->data['question']['q_id']);
        $this->data['question']['answers_count'] = Question::getAnswersCount($this->data['question']['q_id']);

        $answers = Question::getAnswers($this->data['question']['q_id']);
        foreach ($answers as $key => $value) {
            $answers[$key]['user'] = User::getPublicUserData($value['user_id'])[0];
            $answers[$key]['user']['profile_pic'] = User::getProfilePic($answers[$key]['user']['profile_pic']);
        }
        $this->data['answers'] = $answers;
        
        require_once 'include/header.php';
        
        
    }
}