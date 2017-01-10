<?php 
class Notifications {
    public function _index() {
        new Protect('ajax');

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

        $data['data'] = $notif;
        $data['count'] = Notif::getUnreadCount();

        return $data;
    }
}