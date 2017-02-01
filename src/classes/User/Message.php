<?php 
class Message {
    public static function read($from_id) {
        $db = DB::connect();
        $db->updateIf('msg', array('status' => 1), array('from_id' => $from_id, 'to_id' => Session::get('user_id')));
        return TRUE;
    }

    public static function sendMessage($recipient, $msg) {
        $recipient_id = User::getPublicUserId($recipient);
        $user_id = Session::get('user_id');

        // TODO: Check if recipient is private or blocked and check if username is empty
        $db = DB::connect();
        $db->insert('msg', array('from_id' => $user_id, 'to_id' => $recipient_id, 'msg' => $msg, 'time' => time()));
        return TRUE;
    }

    public static function getMessages($username) {
        $id = User::getPublicUserId($username);
        $user_id = Session::get('user_id');

        $db = DB::connect();
        $data1 = (array) $db->fetch(array('msg' => ['msg', 'time']), array('from_id' => $id, 'to_id' => $user_id));
        $data2 = (array) $db->fetch(array('msg' => ['msg', 'time']), array('from_id' => $user_id, 'to_id' => $id));

        foreach($data1 as $key => $value) {
            $data1[$key] = (array) $value;
            $data1[$key]['type'] = 'sent';
        }
        foreach($data2 as $key => $value) {
            $data2[$key] = (array) $value;
            $data2[$key]['type'] = 'received';
        }

        $data = array_merge($data1, $data2);
        usort($data, function($a, $b) {
            return $a['time'] - $b['time'];
        });

        return PhpConvert::toArray($data);
    }
}