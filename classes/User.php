<?php 
class User {
    public $userData = NULL;

    public function login($username, $password) {

        $results = DB::fetch(array('users' => ['user_id', 'password']), array('username' => $username));

        if (count($results) === 1) {
            if (Hash::verify($password, $results->password)) {
                Session::login($results->user_id);
                header('Location: /');
                exit();
            } else {
                echo 'Username or Password is Incorrect';
            }
        } else {
            echo 'Username or Password is Incorrect';
        }
    }

    public function addUser($data) {
        $data['user_id'] = md5(uniqid(mt_rand, true));
        $data['password'] = Hash::generate($data['password']);
        unset($data['password_again']);

        DB::insert('users', $data);
    }

    public function follow($post) {
        $user_id = User::getPublicUserId($post['username']);

        if ($user_id === Session::get('user_id')) {
            echo 'Sorry you cannot follow your profile';
        } else {
            //TOD0: check if following already

            $primary_id = DB::fetch(array('follow' => 'primary_id'), array('user_id' => Session::get('user_id'), 'following_id' => $user_id));

            if (empty($primary_id)) {
                DB::insert('follow', array('user_id' => Session::get('user_id'), 'following_id' => $user_id));
                return TRUE;
            } else {
                return 'You are already following';
            }
        }
    }

    public function followingCount() {
        return DB::fetchCount('follow', array('user_id' => Session::get('user_id')));
    }

    public function followerCount() {
        return DB::fetchCount('follow', array('following_id' => Session::get('user_id')));
    }

    public function getUserData($fields = NULL) {

        if ($fields === NULL) {
            $table = 'users';
        } else {
            $table = array('users' => $fields);
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

    public function getPublicData($id, $fields = NULL) {

        $allowed = ['user_id', 'username', 'first_name', 'last_name', 'email'];

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
            $table = array('users' => $allowed);
        } else {
            $table = array('users' => $fields);
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
        $this->userData = DB::fetch(array('users' => 'user_id'), array('public' => '1', 'username' => $username));
        if (!empty($this->userData)) {
            return $this->userData->user_id;
        }
        return FALSE;
    }
}