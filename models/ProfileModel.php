<?php 
class ProfileModel {
    public $data;
    public function __construct($username) {

        $user_id = Session::get('user_id');

        $this->data['title'] = ucwords($username);
        $this->data['username'] = $username;
        $this->data['token'] = Token::generate();

        $id = User::getPublicUserId($username);
        $userData = User::getPublicUserData($id);


        $this->data['first_name'] = ucwords($userData->first_name);
        $this->data['last_name'] = ucwords($userData->last_name);
        $this->data['email'] = $userData->email;

        $this->data['follow'] = User::checkFollow($username);

        $this->data['dob'] = $userData->dob;

        //date in mm/dd/yyyy format; or it can be in other formats as well
        $birthDate = $userData->dob;
        //explode the date to get month, day and year
        $birthDate = explode("-", $birthDate);
        //get age from date or birthdate
        $this->data['age'] = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md") ? ((date("Y") - $birthDate[0]) - 1) : (date("Y") - $birthDate[0]));

        $profile_pic = DB::fetch(array('user' => 'profile_pic'), array('user_id' => $id))->profile_pic;
        if ($profile_pic === NULL) {
            $this->data['path'] = '/public/images/profile-pic.png';
        } else {
            $this->data['path'] = '/data/images/profile/'.$profile_pic.'.jpg';
        }



        $this->data['country'] = $userData->country;

        switch ($userData->gender) {
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
    }
}