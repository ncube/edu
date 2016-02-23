<?php 
class Profile {
    public function _index($url) {
        if ($url[1] === 'follow') {
            self::follow(Input::post());
        } else {
            self::display($url);
        }
    }

    public function display($url) {
        if (empty($url[0])) {
            $url[0] = User::getUserData('username');
        }
        $username = $url[0];
        $user_id = User::getPublicUserId($username);

        $data = User::getPublicData($user_id);

        echo '<pre>';
        if ($data) {
            if ($user_id === Session::get('user_id')) {
                echo '<h3>My profile</h3>';
                echo 'Following :';
                echo User::followingCount();
                echo '<br>';
                echo 'Followers :';
                echo User::followerCount();
                echo '<br>';
            } else {
                echo '<form action="/profile/'.$url[0].'/follow" method="post">';
                echo '<input type="hidden" name="token" value="'.Token::generate().'">';
                echo '<input type="hidden" name="username" value="'.$url[0].'">';
                echo '<input type="submit" value="follow">';
                echo '<form><br>';
            }
            print_r($data);
        } else {
            echo 'Sorry User not found or Private User';
        }
        echo '</pre>';
    }

    public function follow($post) {
        $token = Token::check($post['token']);
        if (!empty($post['username'] && $token === TRUE)) {
            echo User::follow($post);
        } else {
            if (!$token) {
                echo 'Security Token Missing';
            } else {
                Redirect::to('/profile');
            }
        }
    }
}