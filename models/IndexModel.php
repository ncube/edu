<?php 
class IndexModel {
    public $data;

    public function __construct() {

        $userData = User::getUserData(['username', 'first_name', 'last_name', 'user_id', 'email']);

        $this->data['title'] = 'Home - NCube School';
        $this->data['first_name'] = ucwords($userData->first_name);
        $this->data['last_name'] = ucwords($userData->last_name);
        $this->data['token'] = Token::generate();
        
        $requestData = User::getRequests();
        
        if(isset($requestData->request_id)) {
            $username = User::getPublicData($requestData->user_id)->username;
            $requests[$username] = $requestData->type;
        } else {
            foreach(User::getRequests() as $value) {
             
                $username = User::getPublicData($value->user_id)->username;
                $requests[$username] = $value->type;
            }
        }
        $this->data['request'] = $requests;
    }
}