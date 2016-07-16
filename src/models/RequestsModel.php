<?php 
class RequestsModel {
    public $data;
    public function __construct($url) {
        $user_data = User::getUserData(['username', 'first_name', 'last_name', 'user_id', 'email', 'profile_pic'])[0];

        $this->data['title'] = 'Requests - NCube School';
        $this->data['first_name'] = ucwords($user_data['first_name']);
        $this->data['last_name'] = ucwords($user_data['last_name']);
        $this->data['email'] = $user_data['email'];
        $this->data['token'] = Token::generate();
        $this->data['username'] = $user_data['username'];

        $this->data['url'] = $url;

        require_once 'include/header.php';

        $this->data['side_active']['requests'] = ' side-menu-active';

        $this->data['profile_pic'] = User::getProfilePic($user_data['profile_pic']);



        $user_id = Session::get('user_id');
        $requests = User::getRequests();



        foreach($requests as $key => $value) {
            $requests[$key]['user_data'] = User::getPublicUserData($value['user_id'])[0];
            if (empty($value['user_data']['profile_pic'])) {
                $requests[$key]['user_data']['profile_pic'] = '/public/images/profile-pic.png';
            } else {
                $requests[$key]['user_data']['profile_pic'] = '/data/images/profile/'.$value['user_data']['profile_pic'].'.jpg';
            }
            switch ($value['type']) {

                case 'C':
                    $requests[$key]['type'] = 'Classmate';
                    break;

                case 'T':
                    $requests[$key]['type'] = 'Teacher';
                    break;

                case 'S':
                    $requests[$key]['type'] = 'Student';
                    break;

                case 'F':
                    $requests[$key]['type'] = 'Friend';
                    break;

                case 'P':
                    $requests[$key]['type'] = 'Parent or Guardian';
                    break;

                default:
                    $requests[$key]['type'] = '';
                    break;
            }
        }

        $this->data['requests'] = $requests;

    }
}