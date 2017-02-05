<?php
class Group {
    
    public $group_created;
    
    public function __construct($id = NULL) {
        $this->group_created = FALSE;
        $this->id = $id;
    }

    public static function getPublicGroups() {
        $db = DB::connect();
        return $db->fetch(array('groups'), array('public' => '1'));
    }
    
    public function create($input) {
        $data['group_id'] = md5(uniqid(mt_rand(), TRUE));
        $data['name'] = $input['name'];
        $data['description'] = $input['description'];
        $data['parent'] = $input['parent'];
        $data['public'] = $input['public'];
        $data['time'] = time();
        
        $db = DB::connect();
        $db->insert('groups', $data);
        $this->group_created = TRUE;
    }
    
    public function isMember($id) {
        $db = DB::connect();
        return ($db->fetchCount('group_user', array('user_id' => Session::get('user_id'), 'group_id' => $id, 'status' => 1)) === 1) ? TRUE : FALSE;
    }
    
    public function isAdmin($id) {
        $db = DB::connect();
        return ($db->fetchCount('group_user', array('user_id' => Session::get('user_id'), 'group_id' => $id, 'type' => 'A', 'status' => 1)) === 1) ? TRUE : FALSE;
    }
    
    public function checkRequest($id) {
        $db = DB::connect();
        return ($db->fetchCount('group_user', array('user_id' => Session::get('user_id'), 'group_id' => $id)) === 1) ? TRUE : FALSE;
    }
    
    public function joinAsMember($id) {
        if (!self::checkRequest($id)) {
            $db = DB::connect();
            $db->insert('group_user', array('user_id' => Session::get('user_id'), 'group_id' => $id, 'type' => 'M', 'time' => time()));
            Notif::raiseNotif($id, 'GR');
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRequestsIds($id) {
        return PhpConvert::toArray($db->fetch(array('group_user' => ['user_id', 'time']), array('group_id' => $id, 'status' => 0)));
    }
    
    public function getRequests($id) {
        $reqs = self::getRequestsIds($id);
        $data = NULL;
        foreach($reqs as $value) {
            $data[] = User::getPublicUserData($value['user_id'])[0];
        }
        return $data;
    }
    
    public function getMembersIds() {
        $db = DB::connect();
        $this->members_ids = PhpConvert::toArray($db->fetch('groups_users', array('group_id' => $this->id, 'status' => 1)));
    }
    
    public function getMembersPublicData() {
        self::getMembersIds();
        $data = NULL;
        foreach($this->members_ids as $value) {
            $user = new User($value['user_id']);
            $user->getPublicData();
            $user->getProfilePic();
            $data[] = $user->user_data;
        }
        $this->members_public_data = $data;
    }
    
    public function getMembersCount($id) {
        return $db->fetchCount('group_user', array('group_id' => $id, 'status' => 1));
    }
    
    public function acceptUser($id) {
        $data['user_id'] = User::getPublicUserId(Input::post('username'));
        $data['group_id'] = $id;
        $db = DB::connect();
        $db->updateIf('group_user', array('status' => 1), $data);
        return TRUE;
    }
    
    public function rejectUser($id) {
        $data['user_id'] = User::getPublicUserId(Input::post('username'));
        $data['group_id'] = $id;
        $data['status'] = 0;
        $db = DB::connect();
        $db->deleteIf('group_user', $data);
        return TRUE;
    }
    
    public function publicGroupExists($id) {
        $count = $db->fetchCount('group', array('group_id' => $id, 'public' => 1), 'group_id');
        if ($count === 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function getGroupsIds() {
        return PhpConvert::toArray($db->fetch('group_user', array('user_id' => Session::get('user_id'), 'status' => 1)));
    }
    
    public function getGroupData($id) {
        return PhpConvert::toArray($db->fetch(array('group' => ['group_id', 'group_name', 'description', 'group_pic', 'time']), array('group_id' => $id)));
    }

    public function getPublicData() {
        $id = $this->id;
        $db = DB::connect();
        $this->public_data = PhpConvert::toArray($db->fetch(array('groups' => ['group_id', 'name', 'description', 'parent', 'time']), array('group_id' => $id, 'public' => 1)))[0];
    }
    
    public function getGroupsList() {
        $ids = self::getGroupsIds();
        
        $data = NULL;
        foreach($ids as $key => $value) {
            $data[] = self::getGroupData($value['group_id'])[0];
            $data[$key]['members'] = Group::getMembersCount($value['group_id']);
        }
        
        return $data;
    }
}