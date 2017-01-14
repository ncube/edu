<?php
class Ajax {
    public $data;
    public function __construct() {
        // Add Token Check
        
        $notif = Notif::getUnread();
        
        usort($notif, function($b, $a) {
            return $a['time'] - $b['time'];
        });
        
        foreach($notif as $key => $value) {
            $notif[$key]['profile_pic'] = User::getProfilePic($value['profile_pic']);
            $notif[$key]['time'] = date("d M h:i A", $value['time']);
            $notif[$key]['first_name'] = ucwords($value['first_name']);
            $notif[$key]['last_name'] = ucwords($value['last_name']);
            switch ($value['type']) {
                case 'F':
                    $msg = 'is following you';
                    $link = '/profile/'.$value['username'];
                    break;
                
                default:
                    $msg = '';
                    $link = '#';
                    break;
        }
        $notif[$key]['msg'] = $msg;
        $notif[$key]['link'] = $link;
    }
    
    $data['notif'] = $notif;
    $data['notif_count'] = Notif::getUnreadCount();
    
    // Messages
    
    $notifMsg = Notif::getUnreadMsg();
    
    foreach($notifMsg as $key => $value) {
        $notifMsg[$key]['profile_pic'] = User::getProfilePic($value['profile_pic']);
        $notifMsg[$key]['first_name'] = ucwords($value['first_name']);
        $notifMsg[$key]['last_name'] = ucwords($value['last_name']);
        $notifMsg[$key]['time'] = date("d M h:i A", $value['time']);
    }
    
    usort($notifMsg, function($b, $a) {
        return $a['time'] - $b['time'];
    });
    
    $data['notif_msg'] = $notifMsg;
    $data['notif_msg_count'] = Notif::getUnreadMsgCount();
    
    // User Data
    
    $data['user'] = User::getUserData(['first_name', 'last_name', 'profile_pic'])[0];
    $data['user']['profile_pic'] = User::getProfilePic($data['user']['profile_pic']);
    
    // Questions
    
    $questions = Question::getPublicQuestions();
    
    foreach($questions as $key => $value) {
        $questions[$key]['up_count'] = Question::getVoteUpCount($value['q_id']);
        $questions[$key]['user_data'] = User::getPublicUserData($value['user_id'], ['profile_pic', 'first_name', 'last_name'])[0];
        $questions[$key]['answers'] = Question::getAnswersCount($value['q_id']);
        $questions[$key]['pic'] = User::getProfilePic($questions[$key]['user_data']['profile_pic']);
        $vote = Question::getVote($value['q_id']);
        if ($vote == 1) {
            $questions[$key]['my_data']['vote_up_class'] = 'vote-up-active';
        } else if ($vote == 0) {
            $questions[$key]['my_data']['vote_down_class'] = 'vote-down-active';
        }
        $time = new Time($value['time']);
        $questions[$key]['time'] = $time->hrf;
    }

    $data['questions'] = $questions;
    
    $this->data = $data;
}
}