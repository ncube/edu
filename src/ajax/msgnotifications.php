<?php 
class MsgNotifications {
    public function _index() {
        new Protect('ajax');


        $notifMsg = Notif::getUnreadMsg();

        foreach($notifMsg as $key => $value) {
            $notifMsg[$key]['profile_pic'] = User::getProfilePic($value['profile_pic']);
            $notifMsg[$key]['first_name'] = ucwords($value['first_name']);
            $notifMsg[$key]['last_name'] = ucwords($value['last_name']);
            $notifMsg[$key]['time'] = date("d M h:i A", $value['time']);
        }

        $data['data'] = $notifMsg;
        $data['count'] = Notif::getUnreadMsgCount();

        usort($notifMsg, function($b, $a) {
            return $a['time'] - $b['time'];
        });

        return $data;
    }
}