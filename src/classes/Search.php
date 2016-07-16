<?php
class Search {
    public function publicUsername($username) {
        return DB::search(array('user' => ['username', 'first_name', 'last_name', 'profile_pic']), array('username' => $username, 'public' => '1'));
    }
}