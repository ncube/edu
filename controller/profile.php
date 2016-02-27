<?php 
class Profile extends Mvc {
    public function _index($url) {
        $post = Input::post();
        switch ($url[1]) {
            case 'follow':
                self::follow($post);
                break;
            case 'request':
                self::request($post);
                break;
            case 'accept':
                self::accept($post);
                break;

            default:
                self::display($url);
                break;
        }
    }

    public function display($url) {
        if (empty($url[0])) {
            $url[0] = User::getUserData('username');
        }
        $username = $url[0];
        $user_id = User::getPublicUserId($username);

        $data = User::getPublicData($user_id);

        if ($data) {
            if ($user_id === Session::get('user_id')) {
                // echo '<h3>My profile</h3>';
                // echo 'Following :';
                // echo User::followingCount();
                // echo '<br>';
                // echo 'Followers :';
                // echo User::followerCount();
                // echo '<br>';
                self::init('ProfileModel', 'profile', $username);
            } else {
                self::init('ProfileModel', 'profile', $username);
            }
        } else {
            echo 'Sorry User not found or Private User';
        }
    }

    public function follow($post) {
        new Protect;
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
    
    public function accept($post) {
        new Protect;
        $token = Token::check($post['token']);
        if (!empty($post['username'] && $token === TRUE)) {
            echo User::accept($post);
        } else {
            if (!$token) {
                echo 'Security Token Missing';
            } else {
                Redirect::to('/');
            }
        }
    }

    public function request($post) {
        new Protect;
        $token = Token::check($post['token']);

        if (isset($post['type']) && !empty($post['type'] && $token === TRUE)) {
            $request = User::request($post);
            if ($request !== TRUE) {
                echo $request;
            } else {
                echo 'Requested';
            }
        } else {
            if (!empty($post['username'] && $token === TRUE)) {
                echo '
                    <form action="/profile/'.$post['username'].'/request" method="post">
                        <input type="hidden" name="token" value="'.Token::generate().'">
                        <input type="hidden" name="username" value="'.$post['username'].'">
                        <select name="type">
                        <option value="C">Classmate</option>
                        <option value="T">Teacher</option>
                        <option value="S">Student</option>
                        <option value="F">Friend</option>
                        <option value="P">Parent or Guardian</option>
                        </select>
                        <input type="submit" value="Send Request">
                    </form>
                ';
            } else {
                if (!$token) {
                    echo 'Security Token Missing';
                } else {
                    Redirect::to('/profile');
                }
            }
        }
    }
}