<?php 
$notif = Notif::getUnreadData();

usort($notif, function($b, $a) {
    return $a['time'] - $b['time'];
});

foreach($notif as $key => $value) {
    $notif[$key]['profile_pic'] = User::getProfilePic($value['profile_pic']);
}

$this->data['notif'] = $notif;
$this->data['notif_count'] = Notif::getUnreadCount();