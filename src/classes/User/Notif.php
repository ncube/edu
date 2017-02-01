<?php 
class Notif {
    public $user_id;
    public $unread;
    public $unread_count;
    public $unread_msgs;
    public $unread_msgs_count;

    public function __construct() {
        $this->user_id = Session::get('user_id');
        $this->unread = NULL;
        $this->unread_msgs = NULL;
    }

    public function raiseNotif($to_id, $type) {
        $user_id = $this->user_id;
        $db = DB::connect();
        $db->insert('notification', array('user_id' => $user_id, 'to_id' => $to_id, 'type' => $type, 'time' => time()));
    }

    public function getUnread() {
        $user_id = $this->user_id;
        $db = DB::connect();
        $data = PhpConvert::toArray($db->fetch('notification', array('to_id' => $user_id, 'status' => 0)));
        foreach($data as $key => $value) {
            $temp = User::getPublicUserData($value['user_id'], ['username', 'first_name', 'last_name', 'profile_pic'])[0];
            $data[$key] = array_merge($data[$key], $temp);
        }
        $this->unread_count = $db->fetchcount('notification', array('to_id' => $user_id, 'status' => 0));
        $this->unread = $data;
    }

    public function raiseMsgNotif($to_id) {
        if (!empty($to_id)) {#code...
        } else {
            return FALSE;
        }
        $user_id = Session::get('user_id');
        // Check if exists
        $db = DB::connect();
        $count = $db->fetchCount('msg_notif', array('user_id' => $user_id, 'to_id' => $to_id));
        if ($count === 0) {
            $db->insert('msg_notif', array('user_id' => $user_id, 'to_id' => $to_id, 'time' => time()));
            return TRUE;
        } else {
            $db->updateIf('msg_notif', array('status' => 0, 'time' => time()), array('user_id' => $user_id, 'to_id' => $to_id));
            return TRUE;
        }
    }

    public function getUnreadMsgs() {
        $user_id = $this->user_id;
        $db = DB::connect();
        $data = PhpConvert::toArray($db->fetch('msg_notif', array('to_id' => $user_id, 'status' => 0)));

        foreach($data as $key => $value) {
            $temp = User::getPublicUserData($value['user_id'], ['username', 'first_name', 'last_name', 'profile_pic'])[0];
            $data[$key] = array_merge($data[$key], $temp);
        }

        $this->unread_msgs_count = $db->fetchcount('msg_notif', array('to_id' => $user_id, 'status' => 0));
        $this->unread_msgs = $data;
    }
}