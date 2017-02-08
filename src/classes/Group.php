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

    public function getType() {
        $db = DB::connect();
        $data = $db->fetch(array('groups_users' => 'type'), array('user_id' => Session::get('user_id'), 'group_id' => $this->id, 'status' => 1));
        $this->user_type = isset($data[0]->type) ? $data[0]->type : NULL;
        return $this->user_type;
    }
    
    public function isMember() {
        $type = isset($this->user_type) ? $this->user_type : self::getType();
        return in_array($type, array('A','M'), true );
    }
    
    public function isAdmin() {
        $type = isset($this->user_type) ? $this->user_type : self::getType();
        return ($type === 'A') ? TRUE : FALSE;
    }
    
    public function checkRequest() {
        $id = $this->id;
        $db = DB::connect();
        return ($db->fetchCount('groups_users', array('user_id' => Session::get('user_id'), 'group_id' => $id)) === 1) ? TRUE : FALSE;
    }
    
    public function joinAsMember() {
        $id = $this->id;
        if (!self::checkRequest()) {
            $db = DB::connect();
            $db->insert('groups_users', array('user_id' => Session::get('user_id'), 'group_id' => $id, 'type' => 'M', 'time' => time()));
            // Notif::raiseNotif($id, 'GR');
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRequestsIds() {
        $id = $this->id;
        $db = DB::connect();
        return PhpConvert::toArray($db->fetch(array('groups_users' => ['user_id', 'time']), array('group_id' => $id, 'status' => 0)));
    }
    
    public function getRequests() {
        $id = $this->id;
        $reqs = self::getRequestsIds();
        foreach($reqs as $value) {
            $user = new User($value['user_id']);
            $user->getPublicData();
            $user->getProfilePic();
            $t = $user->user_data;
            $t['time'] = $value['time'];
            $data[] = $t;
        }
        $this->requests = empty($data) ? [] : $data;
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
        return $db->fetchCount('groups_users', array('group_id' => $id, 'status' => 1));
    }
    
    public function acceptUser($user_id) {
        $data['user_id'] = $user_id;
        $data['group_id'] = $this->id;
        $db = DB::connect();
        $db->updateIf('groups_users', array('status' => 1), $data);
        return TRUE;
    }
    
    public function rejectUser($user_id) {
        $data['user_id'] = $user_id;
        $data['group_id'] = $this->id;
        $data['status'] = 0;
        $db = DB::connect();
        $db->deleteIf('groups_users', $data);
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
        return PhpConvert::toArray($db->fetch('groups_users', array('user_id' => Session::get('user_id'), 'status' => 1)));
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