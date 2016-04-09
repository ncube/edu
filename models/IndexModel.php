<?php 
class IndexModel {
    public $data;

    public function __construct() {

        $user_data = User::getUserData(['username', 'first_name', 'last_name', 'user_id', 'email', 'profile_pic'])[0];

        $this->data['title'] = 'Home - NCube School';
        $this->data['first_name'] = ucwords($user_data['first_name']);
        $this->data['last_name'] = ucwords($user_data['last_name']);
        $this->data['token'] = Token::generate();
        $this->data['username'] = $user_data['username'];
        
        $this->data['side_active']['home'] = ' side-menu-active';

        $this->data['profile_pic'] = User::getProfilePic($user_data['profile_pic']);

        $feed = User::getFeed();
        if (!empty($feed)) {
            foreach($feed as $key => $value) {
                $id = $value['user_id'];
                $temp = User::getPublicUserData($id, ['username', 'profile_pic'])[0];

                foreach($temp as $key2 => $value2) {
                    $feed[$key][$key2] = $value2;
                }

                if ($feed[$key]['profile_pic'] === NULL) {
                    $feed[$key]['profile_pic'] = '/public/images/profile-pic.png';
                } else {
                    $feed[$key]['profile_pic'] = '/data/images/profile/'.$feed[$key]['profile_pic'].'.jpg';
                }
            }
        }

        $this->data['feed'] = $feed;

        // $requestData = User::getRequests();

        // if(isset($requestData->user_id)) {
        //     $username = User::getPublicUserData($requestData->user_id)->username;
        //     $requests[$username] = $requestData->type;
        // } else {
        //     foreach(User::getRequests() as $value) {

        //         $username = User::getPublicUserData($value->user_id)->username;
        //         $requests[$username] = $value->type;
        //     }
        // }
        // $this->data['request'] = $requests;
    }
}