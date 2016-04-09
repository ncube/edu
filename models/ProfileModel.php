<?php 
class ProfileModel {
    public $data;
    public function __construct($username) {

        $user_id = Session::get('user_id');

        $this->data['title'] = ucwords($username);
        $this->data['username'] = $username;
        $this->data['token'] = Token::generate();
        
        $this->data['side_active']['profile'] = ' side-menu-active';

        $id = User::getPublicUserId($username);
        $user_data = User::getPublicUserData($id)[0];


        $this->data['first_name'] = ucwords($user_data['first_name']);
        $this->data['last_name'] = ucwords($user_data['last_name']);
        $this->data['email'] = $user_data['email'];

        $this->data['follow'] = User::checkFollow($username);

        $this->data['dob'] = $user_data['dob'];

        //date in mm/dd/yyyy format; or it can be in other formats as well
        $birthDate = $user_data['dob'];
        //explode the date to get month, day and year
        $birthDate = explode("-", $birthDate);
        //get age from date or birthdate
        $this->data['age'] = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md") ? ((date("Y") - $birthDate[0]) - 1) : (date("Y") - $birthDate[0]));

        $profile_pic = $user_data['profile_pic'];
        $this->data['profile_pic'] = User::getProfilePic($user_data['profile_pic']);



        $this->data['country'] = $user_data['country'];

        switch ($user_data['gender']) {
            case 'M':
                $this->data['gender'] = 'Male';
                break;

            case 'F':
                $this->data['gender'] = 'Female';
                break;

            case 'O':
                $this->data['gender'] = 'Others';
                break;

            default:
                break;
        }

        if ($id === $user_id) {
            $this->data['post'] = User::getPost();
        } else {
            $this->data['post'] = User::getPublicPosts($id);
        }
    }
}