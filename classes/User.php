<?php 
class User {
    public $userData = NULL;

    public function login($username, $password) {

        $results = DB::fetch(array('user' => ['user_id', 'password']), array('username' => $username));

        if (count($results) === 1) {
            if (Hash::verify($password, $results->password)) {
                Session::login($results->user_id);
                DB::updateIf('user', array('last_login' => time()), 'user_id', Session::get('user_id'));
                header('Location: /');
                exit();
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
                return TRUE;
            } else {
                return 'Request already sent';
            }
        }
    }

    public function getRequests() {
        return DB::fetch(array('request' => ['user_id', 'type', 'time']), array('other_user_id' => Session::get('user_id'), 'status' => 0));
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

        if ($count === 1) {
            if (gettype($fields) === 'array') {
                $fields = $fields[0];
            }
            return $this->userData->$fields;
        } else {
            return $this->userData;
        }
    }

    public function getPublicUserData($id, $fields = NULL) {

        $allowed = ['user_id', 'username', 'first_name', 'last_name', 'email', 'gender', 'dob', 'country'];

        if (gettype($fields) === 'string') {
            $fields = [$fields];
        }
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

        if ($count === 1) {
            if (gettype($fields) === 'array') {
                $fields = $fields[0];
            }
            return $this->userData->$fields;
        } else {
            return $this->userData;
        }
    }

    public function getPublicUserId($username) {
        $this->userData = DB::fetch(array('user' => 'user_id'), array('public' => '1', 'username' => $username));
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

        if (!empty($data1)) {
            if (!isset($data1[0])) {
                $data1 = [$data1];
            }
        }
        if (!empty($data2)) {
            if (!isset($data2[0])) {
                $data2 = [$data2];
            }
        }

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

        return $data;
    }

    public function getAcceptedUsersData() {
        $id = Session::get('user_id');
        $sent = DB::fetch(array('request' => 'other_user_id'), array('user_id' => $id, 'status' => 1));
        $received = DB::fetch(array('request' => 'user_id'), array('other_user_id' => $id, 'status' => 1));

        if (count($sent) === 1) {
            $sent = [$sent];
        }
        if (count($received) === 1) {
            $received = array($received);
        }

        $ids = array_merge($sent, $received);
        foreach($ids as $value) {
            $value = (array) $value;
            $id = array_values($value)[0];
            $data[] = (array) User::getPublicUserData($id, ['username', 'first_name', 'last_name']);
        }
        return $data;
    }
    
    public function post($post) {
        DB::insert('post', array('user_id' => Session::get('user_id'), 'post_data' => $post, 'time' => time()));
        return TRUE;
    }
}