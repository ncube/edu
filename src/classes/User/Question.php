<?php
class Question {
    
    public $public_questions;
    public $id;

    public function __construct($id = NULL) {
        $this->id = $id;
    }

    public static function postQuestion($data) {
        $allowed = ['title', 'content'];
        
        $data = Restrict::data($data, $allowed);
        $data['user_id'] = Session::get('user_id');
        $data['q_id'] = md5(uniqid(mt_rand(), TRUE));
        $data['time'] = time();
        $data['public'] = 1;
        $data['views'] = 0;
        
        $db = DB::connect();
        $db->insert('question', $data);
        return TRUE;
    }
    
    public function postAnswer($content) {
        $data['user_id'] = Session::get('user_id');
        $data['content'] = $content;
        $data['q_id'] = $this->id;
        $data['time'] = time();
        
        $db = DB::connect();
        $db->insert('answer', $data);
        return TRUE;
    }
    
    public function getPublicQuestions() {
        $db = DB::connect();
        $this->public_questions = PhpConvert::toArray($db->fetch(array('question'), array('public' => 1)));
    }
    
    public function getAnswers() {
        $db = DB::connect();
        return PhpConvert::toArray($db->fetch(array('answer'), array('q_id' => $this->id)));
    }
    
    public function getPublicQuestion() {
        $db = DB::connect();
        return PhpConvert::toArray($db->fetch(array('question'), array('q_id' => $this->id, 'public' => 1)))[0];
    }
    
    public function voteQuestion($vote) {
        $id = $this->id;
        $user_id = Session::get('user_id');
        $db = DB::connect();
        $count = $db->fetchcount('vote', array('user_id' => $user_id, 'q_id' => $id));
        if (!empty($id)) {
            if (!$count == 0) {
                $db->updateIf('vote', array('vote' => $vote), array('q_id' => $id, 'user_id' => $user_id));
            } else {
                $db->insert('vote', array('user_id' => $user_id, 'q_id' => $id, 'vote' => $vote, 'time' => time()));
            }
            return TRUE;
        }
    }
    
    public function countQuestionViews() {
        $db = DB::connect();
        $count = $db->fetch(array('question' => ['views']), array('q_id' => $this->id))[0];
        if (!empty($count)) {
            $count = $count->views;
            $count++;
            $db->updateIf('question', array('views' => $count), array('q_id' => $this->id));
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function getQuestionViews() {
        $db = DB::connect();
        return $db->fetch(array('question' => ['views']), array('q_id' => $this->id))[0]->views;
    }
    
    public function getVoteUpCount() {
        $db = DB::connect();
        return $db->fetchCount('vote', array('q_id' => $this->id, 'vote' => 1));
    }
    
    public function getAnswersCount() {
        $db = DB::connect();
        return $db->fetchCount('answer', array('q_id' => $this->id));
    }
    
    public function getVote() {
        $db = DB::connect();
        $data = PhpConvert::toArray($db->fetch(array('vote' => ['vote']), array('user_id' => Session::get('user_id'), 'q_id' => $this->id)));
        
        return (count($data) > 0) ? $data[0]['vote'] : [];
    }
    
    public function unVoteQuestion() {
        $db = DB::connect();
        $db->deleteIf('vote', array('q_id' => $this->id, 'user_id' => Session::get('user_id')));
        return TRUE;
    }
    
    public function exists() {
        $db = DB::connect();
        if ($db->fetchCount('question', array('q_id' => $this->id)) === 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}