<?php 
class User {
    public $userData = NULL;

    public function login($username, $password) {

        $results = DB::fetch(array('user' => ['user_id', 'password']), array('username' => $username));
        $results = $results[0];

        if (count($results) === 1) {
            if (Hash::verify($password, $results->password)) {
                Session::login($results->user_id);
                DB::updateIf('user', array('last_login' => time()), array('user_id' => Session::get('user_id')));
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
                    Notif::raiseNotif($user_id, 'F');
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
        DB::updateIf('request', array('status' => 1), array('user_id' => $user_id));
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
                Notif::raiseNotif($user_id, 'R'.$post['type']);
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

        if (empty($id)) {
            return FALSE;
        }

        $allowed = ['user_id', 'username', 'first_name', 'last_name', 'email', 'gender', 'dob', 'country', 'profile_pic'];

        // TODO: Replace with restrict function.

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

    public function getProfilePic($name) {
        if (empty($name)) {
            return '/public/images/profile-pic.png';
        } else {
            return '/data/images/profile/'.$name.'.jpg';
        }
    }

    public function comment($id, $content) {
        $user_id = Session::get('user_id');
        DB::insert('comment', array('user_id' => $user_id, 'post_id' => $id, 'content' => $content, 'time' => time()));
        return TRUE;
    }
    
    public function likePost($post_id) {
        $user = Session::get('user_id');
        if (!empty($user)) {
            DB::insert('post_likes', array('user_id' => $user, 'post_id' => $post_id, 'time' => time()));
        }
    }

    public function getLikesCount() {
        $data = DB::fetchcount('post_likes', array('user_id' => Session::get('user_id')));
        return $data;
    }
}