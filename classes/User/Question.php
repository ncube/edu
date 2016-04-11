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

    public function getPublicQuestions() {
        return PhpConvert::toArray(DB::fetch(array('question'), array('public' => 1)));
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

    public function questionDifficulty($id, $level) {
        $user_id = Session::get('user_id');
        $count = DB::fetchcount('difficulty', array('user_id' => $user_id, 'q_id' => $id));
        if (!empty($id)) {
            if (!$count == 0) {
                DB::updateIf('difficulty', array('level' => $level), array('user_id' => $user_id, 'q_id' => $id));
            } else {
                DB::insert('difficulty', array('user_id' => $user_id, 'q_id' => $id, 'level' => $level, 'time' => time()));
            }
            return TRUE;
        }
    }

    public function countQuestionViews($id) {
        $count = DB::fetch(array('question' => ['views']), array('q_id' => $id))[0]->views;
        if (!empty($count)) {
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

    public function getVoteDownCount($id) {
        return DB::fetchCount('vote', array('q_id' => $id, 'vote' => 0));
    }

    public function getDifficultyLevel($id) {
        $data = PhpConvert::toArray(DB::fetch(array('difficulty' => ['level']), array('q_id' => $id)));
        if (empty($data)) {
            return 0;
        }
        foreach($data as $key => $value) {
            $data[$key] = $value['level'];
        }
        return array_sum($data) / count($data);
    }

    public function getAnswersCount($id) {
        return DB::fetchCount('answer', array('q_id' => $id));
    }
}