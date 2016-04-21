<?php 
class Notifications extends Mvc {

    public function _index() {

        new Protect;

        $data = Notif::getUnreadData();
        echo '<pre>';

        echo 'Unread:';

        foreach($data as $key => $value) {
            echo '
                From: '.$value['user_id'].'
                Type: '.$value['type'].'
                Status: '.$value['status'].'
            ';
        }


    }
}