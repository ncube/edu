<?php
class Question {
    public function postQuestion($data) {
        $allowed = ['title', 'content'];
        
        $data = Restrict::data($data, $allowed);
        $data['user_id'] = Session::get('user_id');
        $data['q_id'] = md5(uniqid(mt_rand, TRUE));
        $data['time'] = time();
        $data['public'] = 1;
        
        DB::insert('question', $data);
        return TRUE;
    }
    
    public function postAnswer($content, $id) {
        $data['user_id'] = Session::get('user_id');
        $data['content'] = $content;
        $data['q_id'] = $id;
        $data['time'] = time();
        
        DB::insert('answer', $data);
        return TRUE;
    }
    
    public function getPublicQuestions() {
        return PhpConvert::toArray(DB::fetch(array('question'), array('public' => 1)));
    }
    
    public function getAnswers($id) {
        return PhpConvert::toArray(DB::fetch(array('answer'), array('q_id' => $id)));
    }
    
    public function getPublicQuestion($id) {
        return PhpConvert::toArray(DB::fetch(array('question'), array('q_id' => $id, 'public' => 1)));
    }
    
    public function voteQuestion($id, $vote) {
        $user_id = Session::get('user_id');
        $count = DB::fetchcount('vote', array('user_id' => $user_id, 'q_id' => $id));
        if (!empty($id)) {
            if (!$count == 0) {
                DB::updateIf('vote', array('vote' => $vote), array('q_id' => $id, 'user_id' => $user_id));
            } else {
                DB::insert('vote', array('user_id' => $user_id, 'q_id' => $id, 'vote' => $vote, 'time' => time()));
            }
            return TRUE;
        }
    }
    
    public function countQuestionViews($id) {
        $count = DB::fetch(array('question' => ['views']), array('q_id' => $id))[0];
        if (!empty($count)) {
            $count = $count->views;
            $count++;
            DB::updateIf('question', array('views' => $count), array('q_id' => $id));
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function getQuestionViews($id) {
        return DB::fetch(array('question' => ['views']), array('q_id' => $id))[0]->views;
    }
    
    public function getVoteUpCount($id) {
        return DB::fetchCount('vote', array('q_id' => $id, 'vote' => 1));
    }
    
    public function getAnswersCount($id) {
        return DB::fetchCount('answer', array('q_id' => $id));
    }
    
    public function getVote($id) {
        
        $data = PhpConvert::toArray(DB::fetch(array('vote' => ['vote']), array('user_id' => Session::get('user_id'), 'q_id' => $id)));
        
        if (count($data) > 0) {
            return $data[0]['vote'];
        } else {
            return [];
        }
        
    }
    
    public function unVoteQuestion($id) {
        DB::deleteIf('vote', array('q_id' => $id, 'user_id' => Session::get('user_id')));
        return TRUE;
    }
    
    public function exists($id) {
        if (DB::fetchCount('question', array('q_id' => $id)) === 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}