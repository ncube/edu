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

                case 'RC':
                    $msg = 'wants to add you as Classmate';
                    $link = '/requests/';
                    break;

                case 'RT':
                    $msg = 'wants to add you as Teacher';
                    $link = '/requests/';
                    break;

                case 'RS':
                    $msg = 'wants to add you as Student';
                    $link = '/requests/';
                    break;

                case 'RF':
                    $msg = 'wants to add you as Friend';
                    $link = '/requests/';
                    break;

                case 'RP':
                    $msg = 'wants to add you as Parent or Guardian';
                    $link = '/requests/';
                    break;

                case 'GR':
                    $msg = 'wants to add to one of your Group';
                    $link = '/groups/';
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