<?php
class Ajax {
    public $data;
    public function __construct() {
        switch (Input::get('type')) {
            case 'msgs':
                self::msgs();
                break;
            
            case 'notif':
                self::notif();
                break;
            
            default:
                $this->data = FALSE;
                break;
        }
    }

    public function notif() {
        $notif = new Notif;
        $notif->getUnread();
        
        $unread = $notif->unread;
        usort($unread, function($b, $a) {
            return $a['time'] - $b['time'];
        });
        
        foreach($unread as $key => $value) {
            $unread[$key]['profile_pic'] = User::getProfilePic($value['profile_pic']);
            $time = new Time($value['time']);
            $unread[$key]['time'] = $time->hrf;
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

        $data['data'] = $unread;
        $data['count'] = $notif->unread_count;

        $this->data = $data;
    }

    public function msgs() {
        $notif = new Notif;
        $notif->getUnreadMsgs();
        $notifMsg = $notif->unread_msgs;

        foreach($notifMsg as $key => $value) {
            $notifMsg[$key]['profile_pic'] = User::getProfilePic($value['profile_pic']);
            $notifMsg[$key]['first_name'] = ucwords($value['first_name']);
            $notifMsg[$key]['last_name'] = ucwords($value['last_name']);
            $time = new Time($value['time']);
            $notifMsg[$key]['time'] = $time->hrf;
        }

        $data['data'] = $notifMsg;
        $data['count'] = $notif->unread_msgs_count;

        usort($notifMsg, function($b, $a) {
            return $a['time'] - $b['time'];
        });

        $this->data = $data;
    }
}