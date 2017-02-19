<?php 
class User {
    // TODO: check user_data, public_data arrays
    public $user_data;
    public $public_data;
    public $user_id;

    public function __construct($id = NULL) {
        $this->user_id = ($id === NULL) ? Session::get('user_id') : $id;
        $this->user_data = NULL;
    }

    public static function login($username, $password) {
        $db = DB::connect();
        $results = $db->fetch(array('user' => ['user_id', 'password']), array('username' => $username));
        $results = isset($results[0]) ? $results[0] : NULL;

        if (count($results) === 1) {
            if (Hash::verify($password, $results->password)) {
                Session::login($results->user_id);
                $db->updateIf('user', array('last_login' => time()), array('user_id' => Session::get('user_id')));
                Redirect::ref();
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public static function addUser($data) {
        $safe_data['user_id'] = md5(uniqid(mt_rand(), TRUE));
        $safe_data['password'] = Hash::generate($data['password']);
        $safe_data['username'] = $data['username'];
        $safe_data['first_name'] = $data['first_name'];
        $safe_data['last_name'] = $data['last_name'];
        $safe_data['email'] = $data['email'];

        $db = DB::connect();
        $db->insert('user', $safe_data);
    }

    public static function follow($username) {
        $user_id = self::getPublicUserId($username);

        if (empty($user_id)) {
            return FALSE;
        } else {
            if ($user_id === Session::get('user_id')) {
                return 'Sorry you cannot follow your own profile';
            } else {
                $db = DB::connect();
                $follow_id = $db->fetch(array('follow' => 'follow_id'), array('user_id' => Session::get('user_id'), 'following_id' => $user_id));

                if (empty($follow_id)) {
                    $db->insert('follow', array('user_id' => Session::get('user_id'), 'following_id' => $user_id, 'time' => time()));
                    // Notif::raiseNotif($user_id, 'F');
                    return TRUE;
                } else {
                    return 'following';
                }
            }
        }
    }

    public static function unFollow($username) {
        $user_id = self::getPublicUserId($username);
        $db = DB::connect();
        $db->deleteIf('follow', array('user_id' => Session::get('user_id'), 'following_id' => $user_id));
        return TRUE;
    }

    public static function checkFollow($username) {
        $user_id = self::getPublicUserId($username);

        $db = DB::connect();
        $follow_id = $db->fetch(array('follow' => 'follow_id'), array('user_id' => Session::get('user_id'), 'following_id' => $user_id));
        if (!empty($follow_id)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function getFollowingIds() {
        $db = DB::connect();
        $data = $db->fetch(array('follow' => ['following_id', 'time']), array('user_id' => Session::get('user_id')));
        return PhpConvert::toArray($data);
    }

    public function followingCount() {
        $id = $this->user_id;
        $db = DB::connect();
        return $db->fetchCount('follow', array('user_id' => $id));
    }

    public function followerCount() {
        $id = $this->user_id;
        $db = DB::connect();
        return $db->fetchCount('follow', array('following_id' => $id));
    }

    public function getUserData($fields = NULL) {

        if ($fields === NULL) {
            $table = 'user';
        } else {
            $table = array('user' => $fields);
        }

        $db = DB::connect();
        $this->user_data = $db->fetch($table, array('user_id' => $this->user_id));

        // // For Count
        // $count = new ArrayObject($this->user_data);
        // $count = $count->count();

        $this->user_data = PhpConvert::toArray($this->user_data)[0];
    }

    public function getPublicData($fields = NULL) {

        $id = $this->user_id;

        if (empty($id)) {
            $this->user_data = FALSE;
        } else {

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

            $db = DB::connect();
            $this->user_data = $db->fetch($table, array('user_id' => $id));

            // For Count
            $count = new ArrayObject($this->user_data);
            $count = $count->count();

            $this->user_data = PhpConvert::toArray($this->user_data)[0];

            // Profile Pic
            $this->user_data['profile_pic'] = self::getProfilePic();
        }
    }

    public static function getPublicUserId($username) {
        $db = DB::connect();
        $userData = $db->fetch(array('user' => 'user_id'), array('public' => '1', 'username' => $username));
        $userData = empty($userData) ? [] : $userData[0];
        if (!empty($userData)) {
            return $userData->user_id;
        }
        return FALSE;
    }

    public static function getPublicUsername($user_id) {
        $db = DB::connect();
        $userData = $db->fetch(array('user' => 'username'), array('public' => '1', 'user_id' => $user_id));
        $userData = empty($userData) ? [] : $userData[0];
        if (!empty($userData)) {
            return $userData->username;
        }
        return FALSE;
    }

    public function getProfilePic() {
        $name = $this->user_data['profile_pic'];
        if (empty($name)) {
            $gender = $this->user_data['gender'];
            if($gender == 'F') {
                $this->user_data['profile_pic'] = 'default_female';
            } else {
                $this->user_data['profile_pic'] = 'default_male';
            }
        } else {
            return $name;
        }
    }

    public static function comment($id, $content) {
        $user_id = Session::get('user_id');
        $db = DB::connect();
        $db->insert('comment', array('user_id' => $user_id, 'post_id' => $id, 'content' => $content, 'time' => time()));
        return TRUE;
    }
    
    public static function likePost($post_id) {
        $user = Session::get('user_id');
        if (!empty($user)) {
            $db = DB::connect();
            $db->insert('post_likes', array('user_id' => $user, 'post_id' => $post_id, 'time' => time()));
        }
    }

    public static function getLikesCount() {
        $db = DB::connect();
        return $db->fetchcount('post_likes', array('user_id' => Session::get('user_id')));
    }
}