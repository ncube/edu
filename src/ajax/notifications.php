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
        $notif = Notif::getUnread();
        
        usort($notif, function($b, $a) {
            return $a['time'] - $b['time'];
        });
        
        foreach($notif as $key => $value) {
            $notif[$key]['profile_pic'] = User::getProfilePic($value['profile_pic']);
            $time = new Time($value['time']);
            $notif[$key]['time'] = $time->hrf;
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

        $data['data'] = $notif;
        $data['count'] = Notif::getUnreadCount();

        $this->data = $data;
    }

    public function msgs() {
        $notifMsg = Notif::getUnreadMsg();

        foreach($notifMsg as $key => $value) {
            $notifMsg[$key]['profile_pic'] = User::getProfilePic($value['profile_pic']);
            $notifMsg[$key]['first_name'] = ucwords($value['first_name']);
            $notifMsg[$key]['last_name'] = ucwords($value['last_name']);
            $time = new Time($value['time']);
            $notifMsg[$key]['time'] = $time->hrf;
        }

        $data['data'] = $notifMsg;
        $data['count'] = Notif::getUnreadMsgCount();

        usort($notifMsg, function($b, $a) {
            return $a['time'] - $b['time'];
        });

        $this->data = $data;
    }
}