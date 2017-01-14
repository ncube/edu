<?php
class Time {
    public $hrf;
    public function __construct($time) {
        $this->hrf = self::hrf($time);
    }

    public function hrf($time){
        $now = time();
        $offset = $now - $time;
        if($offset != null){
            $deltaS = $offset%60;
            $offset /= 60;
            $deltaM = $offset%60;
            $offset /= 60;
            $deltaH = $offset%24;
            $offset /= 24;
            $deltaD = ($offset > 1)?ceil($offset):$offset;
        } else{
            return FALSE;
        }
        if($deltaD >= 1){
            if($deltaD > 365){
                return date('Y M-j g:i A', $time);
            }
            if($deltaD > 28){
                return date('M-j g:i A', $time);
            }
            return date('j g:i A', $time);
        }
        if($deltaH == 1){
            return "1 hr";
        }
        if($deltaM == 1){
            return "1 min";
        }
        if($deltaH > 0){
            return $deltaH." hrs";
        }
        if($deltaM > 0){
            return $deltaM." mins";
        } else{
            return "few secs";
        }
    }
}