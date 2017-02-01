<?php
class Question {
    
    public $public_questions;
    public $id;

    public function __construct($id = NULL) {
        $this->id = $id;
    }

    public function postQuestion($data) {
        $allowed = ['title', 'content'];
        
        $data = Restrict::data($data, $allowed);
        $data['user_id'] = Session::get('user_id');
        $data['q_id'] = md5(uniqid(mt_rand, TRUE));
        $data['time'] = time();
        $data['public'] = 1;
        
        $db = DB::connect();
        $db->insert('question', $data);
        return TRUE;
    }
    
    public function postAnswer($content, $id) {
        $data['user_id'] = Session::get('user_id');
        $data['content'] = $content;
        $data['q_id'] = $id;
        $data['time'] = time();
        
        $db = DB::connect();
        $db->insert('answer', $data);
        return TRUE;
    }
    
    public function getPublicQuestions() {
        $db = DB::connect();
        $this->public_questions = PhpConvert::toArray($db->fetch(array('question'), array('public' => 1)));
    }
    
    public function getAnswers($id) {
        $db = DB::connect();
        return PhpConvert::toArray($db->fetch(array('answer'), array('q_id' => $id)));
    }
    
    public function getPublicQuestion($id) {
        $db = DB::connect();
        return PhpConvert::toArray($db->fetch(array('question'), array('q_id' => $id, 'public' => 1)));
    }
    
    public function voteQuestion($id, $vote) {
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
    
    public function countQuestionViews($id) {
        $db = DB::connect();
        $count = $db->fetch(array('question' => ['views']), array('q_id' => $id))[0];
        if (!empty($count)) {
            $count = $count->views;
            $count++;
            $db->updateIf('question', array('views' => $count), array('q_id' => $id));
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function getQuestionViews($id) {
        $db = DB::connect();
        return $db->fetch(array('question' => ['views']), array('q_id' => $id))[0]->views;
    }
    
    public function getVoteUpCount($id) {
        $db = DB::connect();
        return $db->fetchCount('vote', array('q_id' => $id, 'vote' => 1));
    }
    
    public function getAnswersCount($id) {
        $db = DB::connect();
        return $db->fetchCount('answer', array('q_id' => $id));
    }
    
    public function getVote($id) {
        $db = DB::connect();
        $data = PhpConvert::toArray($db->fetch(array('vote' => ['vote']), array('user_id' => Session::get('user_id'), 'q_id' => $id)));
        
        if (count($data) > 0) {
            return $data[0]['vote'];
        } else {
            return [];
        }
        
    }
    
    public function unVoteQuestion($id) {
        $db = DB::connect();
        $db->deleteIf('vote', array('q_id' => $id, 'user_id' => Session::get('user_id')));
        return TRUE;
    }
    
    public function exists($id) {
        $db = DB::connect();
        if ($db->fetchCount('question', array('q_id' => $id)) === 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}