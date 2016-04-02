<?php 
class User {
    public $userData = NULL;

    public function login($username, $password) {

        $results = DB::fetch(array('user' => ['user_id', 'password']), array('username' => $username));
        $results = $results[0];

        if (count($results) === 1) {
            if (Hash::verify($password, $results->password)) {
                Session::login($results->user_id);
                DB::updateIf('user', array('last_login' => time()), 'user_id', Session::get('user_id'));
                Redirect::ref();
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function addUser($data) {
        $safe_data['user_id'] = md5(uniqid(mt_rand, TRUE));
        $safe_data['password'] = Hash::generate($data['password']);
        $safe_data['username'] = $data['username'];
        $safe_data['first_name'] = $data['first_name'];
        $safe_data['last_name'] = $data['last_name'];
        $safe_data['email'] = $data['email'];
        $safe_data['gender'] = $data['gender'];
        $safe_data['dob'] = $data['year'].'-'.$data['month'].'-'.$data['day'];
        $safe_data['country'] = $data['country'];

        DB::insert('user', $safe_data);
    }

    public function follow($username) {
        $user_id = self::getPublicUserId($username);

        if (empty($user_id)) {
            return FALSE;
        } else {
            if ($user_id === Session::get('user_id')) {
                return 'Sorry you cannot follow your own profile';
            } else {

                $follow_id = DB::fetch(array('follow' => 'follow_id'), array('user_id' => Session::get('user_id'), 'following_id' => $user_id));

                if (empty($follow_id)) {
                    DB::insert('follow', array('user_id' => Session::get('user_id'), 'following_id' => $user_id, 'time' => time()));
                    self::raiseNtf($user_id,'F');
                    return TRUE;
                } else {
                    return 'following';
                }
            }
        }
    }

    public function unFollow($username) {
        $user_id = self::getPublicUserId($username);
        DB::deleteIf('follow', array('user_id' => Session::get('user_id'), 'following_id' => $user_id));
        return TRUE;
    }

    public function checkFollow($username) {
        $user_id = self::getPublicUserId($username);

        $follow_id = DB::fetch(array('follow' => 'follow_id'), array('user_id' => Session::get('user_id'), 'following_id' => $user_id));
        if (!empty($follow_id)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function accept($post) {
        $user_id = User::getPublicUserId($post['username']);
        DB::updateIf('request', array('status' => 1), 'user_id', $user_id);
        return 'Accepted';
    }

    public function request($post) {
        $user_id = User::getPublicUserId($post['username']);

        if ($user_id === Session::get('user_id')) {
            return 'Sorry you cannot Request to your own profile';
        } else {

            $follow_id = DB::fetch(array('request' => 'request_id'), array('user_id' => Session::get('user_id'), 'other_user_id' => $user_id));

            if (empty($follow_id)) {
                DB::insert('request', array('user_id' => Session::get('user_id'), 'other_user_id' => $user_id, 'type' => $post['type'], 'time' => time()));
                self::raiseNtf($user_id,'R');
                return TRUE;
            } else {
                return 'Request already sent';
            }
        }
    }

    public function getRequests($status = false) {
        if ($status === TRUE) {
            $data = DB::fetch(array('request' => ['user_id', 'type', 'time']), array('other_user_id' => Session::get('user_id'), 'status' => 1));
            return PhpConvert::toArray($data);
        } elseif($status === FALSE) {
            $data = DB::fetch(array('request' => ['user_id', 'type', 'time']), array('other_user_id' => Session::get('user_id'), 'status' => 0));
            return PhpConvert::toArray($data);
        } else {
            return FALSE;
        }
    }

    public function getRequested($status = true) {
        if ($status === TRUE) {
            $data = DB::fetch(array('request' => ['other_user_id', 'type', 'time']), array('user_id' => Session::get('user_id'), 'status' => 1));
            return PhpConvert::toArray($data);
        } elseif($status === FALSE) {
            $data = DB::fetch(array('request' => ['other_user_id', 'type', 'time']), array('user_id' => Session::get('user_id'), 'status' => 0));
            return PhpConvert::toArray($data);
        } else {
            return FALSE;
        }
    }

    public function getFollowingIds() {
        $data = DB::fetch(array('follow' => ['following_id', 'time']), array('user_id' => Session::get('user_id')));
        return PhpConvert::toArray($data);
    }

    public function followingCount() {
        return DB::fetchCount('follow', array('user_id' => Session::get('user_id')));
    }

    public function followerCount() {
        return DB::fetchCount('follow', array('following_id' => Session::get('user_id')));
    }

    public function getUserData($fields = NULL) {

        if ($fields === NULL) {
            $table = 'user';
        } else {
            $table = array('user' => $fields);
        }

        $this->userData = DB::fetch($table, array('user_id' => Session::get('user_id')));

        // For Count
        $count = new ArrayObject($this->userData);
        $count = $count->count();

        $this->userData = PhpConvert::toArray($this->userData);
        return $this->userData;
    }

    public function getPublicUserData($id, $fields = NULL) {

        $allowed = ['user_id', 'username', 'first_name', 'last_name', 'email', 'gender', 'dob', 'country', 'profile_pic'];

        if ($fields !== NULL) {
            foreach($fields as $key => $field) {
                foreach($allowed as $value) {
                    if ($field === $value) {
                        $safe[] = $field;
                    }
                }
            }
            if (empty($safe)) {
                return FALSE;
            } else {
                $fields = $safe;
            }
        }

        if ($fields === NULL) {
            $table = array('user' => $allowed);
        } else {
            $table = array('user' => $fields);
        }

        $this->userData = DB::fetch($table, array('user_id' => $id));

        // For Count
        $count = new ArrayObject($this->userData);
        $count = $count->count();

        return PhpConvert::toArray($this->userData);;
    }

    public function getPublicUserId($username) {
        $this->userData = DB::fetch(array('user' => 'user_id'), array('public' => '1', 'username' => $username));
        $this->userData = $this->userData[0];
        if (!empty($this->userData)) {
            return $this->userData->user_id;
        }
        return FALSE;
    }

    public function sendMessage($recipient, $msg) {
        $recipient_id = self::getPublicUserId($recipient);
        $user_id = Session::get('user_id');

        // TODO: Check if recipient is private or blocked and check if username is empty
        DB::insert('msg', array('from_id' => $user_id, 'to_id' => $recipient_id, 'msg' => $msg, 'time' => time()));
        return TRUE;
    }

    public function getMessages($username) {
        $id = self::getPublicUserId($username);
        $user_id = Session::get('user_id');

        $data1 = (array) DB::fetch(array('msg' => ['msg', 'time']), array('from_id' => $id, 'to_id' => $user_id));
        $data2 = (array) DB::fetch(array('msg' => ['msg', 'time']), array('from_id' => $user_id, 'to_id' => $id));

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

    public function getAcceptedUsersData() {
        $id = Session::get('user_id');
        $sent = DB::fetch(array('request' => 'other_user_id'), array('user_id' => $id, 'status' => 1));
        $received = DB::fetch(array('request' => 'user_id'), array('other_user_id' => $id, 'status' => 1));

        $ids = array_merge($sent, $received);
        foreach($ids as $value) {
            $value = (array) $value;
            $id = array_values($value)[0];
            $data[] = self::getPublicUserData($id, ['username', 'first_name', 'last_name'])[0];
        }
        return PhpConvert::toArray($data);
    }

    public function post($post) {
        DB::insert('post', array('unique_id' => md5(uniqid()), 'user_id' => Session::get('user_id'), 'post_data' => $post, 'time' => time()));
        return TRUE;
    }

    public function getPost() {
        $data = DB::fetch('post', array('user_id' => Session::get('user_id')));
        return PhpConvert::toArray($data);
    }

    public function getPublicPosts($id) {
        // TODO: Restrict to only public posts
        if (sizeof($id) !== 1) {
            $data = DB::fetch('post', array('user_id' => $id), 'OR');
        } else {
            if (gettype($id) === 'array') {
                $id = $id[0];
            }
            $data = DB::fetch('post', array('user_id' => $id));
        }
        return PhpConvert::toArray($data);
    }

    public function getFeedIds() {
        $fields = ['user_id', 'other_user_id', 'following_id'];

        // TODO: Remove Duplicate Ids
        $requests = self::getRequests(TRUE);
        foreach($requests as $key => $value) {
            foreach($value as $key2 => $value2) {
                if (in_array($key2, $fields)) {
                    $requests[$key] = $value2;
                }
            }
        }

        $requested = self::getRequested(TRUE);
        foreach($requested as $key => $value) {
            foreach($value as $key2 => $value2) {
                if (in_array($key2, $fields)) {
                    $requested[$key] = $value2;
                }
            }
        }

        $following = self::getFollowingIds(TRUE);
        foreach($following as $key => $value) {
            foreach($value as $key2 => $value2) {
                if (in_array($key2, $fields)) {
                    $following[$key] = $value2;
                }
            }
        }

        $merged = array_merge($requests, $requested, $following);
        return PhpConvert::toArray($merged);
    }

    public function getFeed() {
        $ids = self::getFeedIds();
        if (empty($ids)) {
            return FALSE;
        }
        return self::getPublicPosts($ids);
    }

    public function getGroupsIds() {
        return PhpConvert::toArray(DB::fetch('group_user', array('user_id' => Session::get('user_id'), 'status' => 1)));
    }

    public function getGroupData($id) {
        return PhpConvert::toArray(DB::fetch(array('group' => ['group_id', 'group_name', 'desp', 'group_pic', 'time']), array('group_id' => $id)));
    }

    public function getGroupsList() {
        $ids = self::getGroupsIds();

        $data = NULL;
        foreach($ids as $key => $value) {
            $data[] = self::getGroupData($value['group_id'])[0];
        }

        return $data;
    }

    public function raiseNtf($to_id,$type) {
        $user_id=Session::get('user_id');
        DB::insert('notification',array('user_id'=>$user_id,'to_id'=>$to_id,'type'=>$type,'time'=>time()));
        }
}