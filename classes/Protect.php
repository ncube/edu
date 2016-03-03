<?php 
class Protect {
    public function __construct($type = NULL) {
        switch ($type) {
            case NULL:
                if (!Session::exists('user_id')) {
                    Mvc::init('LoginModel', 'login', $args);
                    die();
                }
                break;
            case 'api':
                if (!Session::exists('user_id')) {
                    $data['error'] = 'Please Login to Continue';
                    header('Content-Type: application/json');
                    echo json_encode($data);
                    die();
                }
                break;

            default:
                break;
        }
    }
}