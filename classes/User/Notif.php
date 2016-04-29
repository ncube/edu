<?php 
class Notif {

    public function raiseNotif($to_id, $type) {
        $user_id = Session::get('user_id');
        DB::insert('notification', array('user_id' => $user_id, 'to_id' => $to_id, 'type' => $type, 'time' => time()));
    }

    public function getUnreadCount() {
        $user_id = Session::get('user_id');
        return DB::fetchcount('notification', array('to_id' => $user_id, 'status' => 0));
    }

    public function getUnread() {
        $user_id = Session::get('user_id');
        $data = PhpConvert::toArray(DB::fetch('notification', array('to_id' => $user_id, 'status' => 0)));
        foreach($data as $key => $value) {
            $temp = User::getPublicUserData($value['user_id'], ['username', 'first_name', 'last_name', 'profile_pic'])[0];
            $data[$key] = array_merge($data[$key], $temp);
        }
        return $data;
    }

    public function raiseMsgNotif($to_id) {
        if (!empty($to_id)) {#code...
        } else {
            return FALSE;
        }
        $user_id = Session::get('user_id');
        // Check if exists
        $count = DB::fetchCount('msg_notif', array('user_id' => $user_id, 'to_id' => $to_id));
        if ($count === 0) {
            DB::insert('msg_notif', array('user_id' => $user_id, 'to_id' => $to_id, 'time' => time()));
            return TRUE;
        } else {
            DB::updateIf('msg_notif', array('status' => 0, 'time' => time()), array('user_id' => $user_id, 'to_id' => $to_id));
            return TRUE;
        }
    }

    public function getUnreadMsgCount() {
        $user_id = Session::get('user_id');
        return DB::fetchcount('msg_notif', array('to_id' => $user_id, 'status' => 0));
    }

    public function getUnreadMsg() {
        $user_id = Session::get('user_id');
        $data = PhpConvert::toArray(DB::fetch('msg_notif', array('to_id' => $user_id, 'status' => 0)));

        foreach($data as $key => $value) {
            $temp = User::getPublicUserData($value['user_id'], ['username', 'first_name', 'last_name', 'profile_pic'])[0];
            $data[$key] = array_merge($data[$key], $temp);
        }
        return $data;
    }
}