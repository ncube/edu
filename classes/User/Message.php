<?php 
class Message {
    public function read($from_id) {
        DB::updateIf('msg', array('status' => 1), array('from_id' => $from_id, 'to_id' => Session::get('user_id')));
        return TRUE;
    }
}