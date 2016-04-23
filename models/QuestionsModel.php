<?php 
class QuestionsModel {
    public $data;

    public function __construct() {

        $user_data = User::getUserData(['username', 'first_name', 'last_name', 'user_id', 'email', 'profile_pic'])[0];

        $this->data['title'] = 'Questions - NCube School';
        $this->data['first_name'] = ucwords($user_data['first_name']);
        $this->data['last_name'] = ucwords($user_data['last_name']);
        $this->data['token'] = Token::generate();
        $this->data['username'] = $user_data['username'];

        $this->data['side_active']['questions'] = ' side-menu-active';

        $this->data['profile_pic'] = User::getProfilePic($user_data['profile_pic']);
        
        require_once 'include/header.php';

        $questions = Question::getPublicQuestions();




        foreach($questions as $key => $value) {
            $questions[$key]['up_count'] = Question::getVoteUpCount($value['q_id']);
            $questions[$key]['down_count'] = Question::getVoteDownCount($value['q_id']);
            $questions[$key]['level'] = Question::getDifficultyLevel($value['q_id']);
            $questions[$key]['user_data'] = User::getPublicUserData($value['user_id'], ['profile_pic', 'first_name', 'last_name'])[0];
            $questions[$key]['answers'] = Question::getAnswersCount($value['q_id']);
            $questions[$key]['pic'] = User::getProfilePic($user_data['profile_pic']);
            $vote = Question::getVote($value['q_id']);
            if ($vote == 1) {
                $questions[$key]['my_data']['vote_up_class'] = 'vote-up-active';
            } else if ($vote == 0) {
                $questions[$key]['my_data']['vote_down_class'] = 'vote-down-active';
            }
        }

        $this->data['questions'] = $questions;


    }
}