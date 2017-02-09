<?php
class Ajax {
    public $data;
    public function __construct() {
        // Add Token Check
        
        $notif = new Notif;
        $notif->getUnread();
        
        $unread = $notif->unread;
        usort($unread, function($b, $a) {
            return $a['time'] - $b['time'];
        });
        
        foreach($unread as $key => $value) {
            $user_data = new User($value['user_id']);
            $user_data->getPublicData();
            $user_data->getProfilePic();
            $unread[$key]['profile_pic'] = $user_data->user_data['profile_pic'];
            $unread[$key]['time'] = date("d M h:i A", $value['time']);
            $unread[$key]['first_name'] = ucwords($value['first_name']);
            $unread[$key]['last_name'] = ucwords($value['last_name']);
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
            $unread[$key]['msg'] = $msg;
            $unread[$key]['link'] = $link;
        }
    
        $data['notif'] = $unread;
        $data['notif_count'] = $notif->unread_count;
        
        // Messages
        $notif->getUnreadMsgs();
        $notifMsg = $notif->unread_msgs;
        
        foreach($notifMsg as $key => $value) {
            $user = new User($value['user_id']);
            $user->getUserData(['first_name', 'last_name', 'gender',  'profile_pic']);
            $user->getProfilePic();
            $notifMsg[$key]['profile_pic'] = $user->user_data;
            $notifMsg[$key]['first_name'] = ucwords($value['first_name']);
            $notifMsg[$key]['last_name'] = ucwords($value['last_name']);
            $notifMsg[$key]['time'] = date("d M h:i A", $value['time']);
        }
    
        usort($notifMsg, function($b, $a) {
            return $a['time'] - $b['time'];
        });
        
        $data['notif_msg'] = $notifMsg;
        $data['notif_msg_count'] = $notif->unread_msgs_count;
        
        // User Data
        $user = new User;
        $user->getUserData(['first_name', 'last_name', 'gender',  'profile_pic']);
        $user->getProfilePic();
        
        $data['user'] = $user->user_data;
        
        // Questions
        $questions = new Question($GLOBALS['url_array']['1']);
        $questions->getPublicQuestions();

        $questions = (isset($questions->public_questions)) ? $questions->public_questions : [];
        
        foreach($questions as $key => $value) {
            $question = new Question($value['q_id']);
            $questions[$key]['up_count'] = $question->getVoteUpCount();
            $user_data = new User($value['user_id']);
            $user_data->getPublicData();
            $user_data->getProfilePic();
            $questions[$key]['user_data'] = $user_data->user_data;
            $questions[$key]['answers'] = $question->getAnswersCount();
            $vote = $question->getVote();
            if ($vote == 1) {
                $questions[$key]['my_data']['vote_up_class'] = 'vote-up-active';
            } else if ($vote == 0) {
                $questions[$key]['my_data']['vote_down_class'] = 'vote-down-active';
            }
            $time = new Time($value['time']);
            $questions[$key]['time'] = $time->hrf;
        }

        $data['questions'] = $questions;

        // Groups
        $data['groups'] = Group::getPublicGroups();
        
        $this->data = $data;
    }
}