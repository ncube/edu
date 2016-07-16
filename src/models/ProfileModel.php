<?php 
class ProfileModel {
    public $data;
    public function __construct($username) {

        $user_id = Session::get('user_id');
        $user_data = User::getPublicUserData($user_id)[0];

        $this->data['title'] = ucwords($username);
        $this->data['username'] = $user_data['username'];
        $this->data['token'] = Token::generate();

        $this->data['side_active']['profile'] = ' side-menu-active';
        
        require_once 'include/header.php';


        $this->data['first_name'] = ucwords($user_data['first_name']);
        $this->data['last_name'] = ucwords($user_data['last_name']);
        $this->data['email'] = $user_data['email'];
        $this->data['profile_pic'] = User::getProfilePic($user_data['profile_pic']);

        $profile_id = User::getPublicUserId($username);
        $profile_data = User::getPublicUserData($profile_id)[0];

        $this->data['profile_data']['username'] = $username;
        $this->data['profile_data']['first_name'] = ucwords($profile_data['first_name']);
        $this->data['profile_data']['last_name'] = ucwords($profile_data['last_name']);
        $this->data['profile_data']['email'] = $profile_data['email'];
        $this->data['profile_data']['profile_pic'] = User::getProfilePic($profile_data['profile_pic']);

        $this->data['profile_data']['follow'] = User::checkFollow($username);

        $this->data['profile_data']['dob'] = $profile_data['dob'];

        //date in mm/dd/yyyy format; or it can be in other formats as well
        $birthDate = $profile_data['dob'];
        //explode the date to get month, day and year
        $birthDate = explode("-", $birthDate);
        //get age from date or birthdate
        $this->data['profile_data']['age'] = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md") ? ((date("Y") - $birthDate[0]) - 1) : (date("Y") - $birthDate[0]));



        $this->data['profile_data']['country'] = $profile_data['country'];

        switch ($profile_data['gender']) {
            case 'M':
                $this->data['profile_data']['gender'] = 'Male';
                break;

            case 'F':
                $this->data['profile_data']['gender'] = 'Female';
                break;

            case 'O':
                $this->data['profile_data']['gender'] = 'Others';
                break;

            default:
                break;
        }

        if ($profile_id === $user_id) {
            $posts = User::getPost();
            foreach($posts as $key => $value) {
                $profile_id = $value['user_id'];
                $temp = User::getPublicUserData($profile_id, ['username', 'profile_pic'])[0];

                foreach($temp as $key2 => $value2) {
                    $posts[$key][$key2] = $value2;
                }

                if ($posts[$key]['profile_pic'] === NULL) {
                    $posts[$key]['profile_pic'] = '/public/images/profile-pic.png';
                } else {
                    $posts[$key]['profile_pic'] = '/data/images/profile/'.$posts[$key]['profile_pic'].'.jpg';
                }

                $comments = PhpConvert::toArray(DB::fetch('comment', array('post_id' => $value['unique_id'])));
                foreach($comments as $key2 => $value2) {
                    $user_data = User::getPublicUserData($value2['user_id'])[0];
                    $comments[$key2]['profile_pic'] = User::getProfilePic($user_data['profile_pic']);
                    $comments[$key2]['username'] = $user_data['username'];
                }
                $posts[$key]['comments'] = $comments;
            }
        } else {
            $posts = User::getPublicPosts($profile_id);
            foreach($posts as $key => $value) {
                $profile_id = $value['user_id'];
                $temp = User::getPublicUserData($profile_id, ['username', 'profile_pic'])[0];

                foreach($temp as $key2 => $value2) {
                    $posts[$key][$key2] = $value2;
                }

                if ($posts[$key]['profile_pic'] === NULL) {
                    $posts[$key]['profile_pic'] = '/public/images/profile-pic.png';
                } else {
                    $posts[$key]['profile_pic'] = '/data/images/profile/'.$posts[$key]['profile_pic'].'.jpg';
                }

                $comments = PhpConvert::toArray(DB::fetch('comment', array('post_id' => $value['unique_id'])));
                foreach($comments as $key2 => $value2) {
                    $user_data = User::getPublicUserData($value2['user_id'])[0];
                    $comments[$key2]['profile_pic'] = User::getProfilePic($user_data['profile_pic']);
                    $comments[$key2]['username'] = $user_data['username'];
                }
                $posts[$key]['comments'] = $comments;
            }
        }
        $this->data['post'] = $posts;
    }
}