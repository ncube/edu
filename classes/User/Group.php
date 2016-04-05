<?php 
class Group {
    public function isMember($id) {
        return (DB::fetchCount('group_user', array('user_id' => Session::get('user_id'), 'group_id' => $id, 'status' => 1)) === 1) ? TRUE : FALSE;
    }

    public function isAdmin($id) {
        return (DB::fetchCount('group_user', array('user_id' => Session::get('user_id'), 'group_id' => $id, 'type' => 'A', 'status' => 1)) === 1) ? TRUE : FALSE;
    }

    public function checkRequest($id) {
        return (DB::fetchCount('group_user', array('user_id' => Session::get('user_id'), 'group_id' => $id)) === 1) ? TRUE : FALSE;
    }

    public function joinAsMember($id) {
        if (!self::checkRequest($id)) {
            DB::insert('group_user', array('user_id' => Session::get('user_id'), 'group_id' => $id, 'type' => 'M', 'time' => time()));
            User::raiseNotif($id, 'GR');
            return TRUE;
        }
        return FALSE;
    }

    public function getRequestsIds($id) {
        return PhpConvert::toArray(DB::fetch(array('group_user' => ['user_id', 'time']), array('group_id' => $id, 'status' => 0)));
    }

    public function getRequests($id) {
        $reqs = self::getRequestsIds($id);
        $data = NULL;
        foreach($reqs as $value) {
            $data[] = User::getPublicUserData($value['user_id'])[0];
        }
        return $data;
    }

    public function getMembersIds($id) {
        return PhpConvert::toArray(DB::fetch('group_user', array('group_id' => $id, 'status' => 1)));
    }

    public function getMembers($id) {
        $reqs = self::getMembersIds($id);
        $data = NULL;
        foreach($reqs as $value) {
            $data[] = User::getPublicUserData($value['user_id'])[0];
        }
        return $data;
    }
}