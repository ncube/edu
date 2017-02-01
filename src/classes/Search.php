<?php
class Search {
    public static function publicUsername($username) {
        $db = DB::connect();
        return $db->search(array('user' => ['username', 'user_id', 'first_name', 'last_name', 'profile_pic']), array('username' => $username, 'public' => '1'));
    }
}