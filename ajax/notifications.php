<?php 
class Notifications {
    public function _index() {
        new Protect('ajax');

        $data['data'] = Notif::getUnread();
        $data['count'] = Notif::getUnreadCount();

        return $data;
    }
}