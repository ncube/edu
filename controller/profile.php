<?php 
class Profile extends Mvc {
    public function _index($url) {
        switch ($url[1]) {
            case 'follow':
                self::follow();
                break;
            case 'request':
                self::request();
                break;
            case 'accept':
                self::accept();
                break;

            default:
                self::display($url);
                break;
        }
    }

    public function display($url) {
        if (empty($url[0])) {
            $url[0] = User::getUserData('username')[0]['username'];
        }
        $username = $url[0];
        $user_id = User::getPublicUserId($username);
        $data = User::getPublicUserData($user_id);

        if ($data) {
            if ($user_id === Session::get('user_id')) {
                self::init('ProfileModel', 'profile', $username);
            } else {
                self::init('ProfileModel', 'profile', $username);
            }
        } else {
            echo 'Sorry User not found or Private User';
        }
    }

    public function follow() {
        new Protect;

        $post = Input::post();
        $token = Token::check($post['token']);
        if (!empty($post['username'] && $token === TRUE)) {
            echo User::follow($post['username']);
        } else {
            if (!$token) {
                echo 'Security Token Missing';
            } else {
                Redirect::to('/profile');
            }
        }
    }

    public function accept() {
        new Protect;

        $post = Input::post();
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

    public function request() {
        new Protect;

        $post = Input::post();
        $token = Token::check($post['token']);

        if (isset($post['type']) && !empty($post['type'] && $token === TRUE)) {
            $request = User::request($post);
            if ($request !== TRUE) {
                return $request;
            } else {
                return TRUE;
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
                    return 'Security Token Missing';
                } else {
                    Redirect::to('/profile');
                }
            }
        }
    }

    public function upload() {
        $token = Token::check(Input::post('token'));
        if ($token === TRUE) {
            Upload::profilePic(Input::files());
        } else {
            echo 'Security Token Missing';
        }
    }

    public function post() {
        $post = Input::post();
        $token = Token::check($post['token']);
        $data = $post['post_data'];

        if (!empty($data) && $token === TRUE) {
            if (User::post($data) === TRUE) {
                echo 'Posted';
            } else {
                echo 'Unable to Post';
            }
        } else {
            echo 'Security token is missing or post is empty';
        }
    }
}