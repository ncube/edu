<?php 
class User {

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
}