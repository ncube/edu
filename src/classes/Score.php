<?php 
class Score {

    public function calc($answered, $difficulty, $votes, $closed) {
        $base = 1.6;

        $score = (((2 ** $answered) * $difficulty * log($votes, $base)) / (2 ** $closed)) + 1;
        return $score;
    }

}