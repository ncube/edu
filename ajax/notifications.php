<?php 
class Notifications {
    public function _index() {
        new Protect('ajax');

        $data['data'] = Notif::getUnreadData();
        $data['count'] = Notif::getUnreadCount();

        return $data;
    }
}