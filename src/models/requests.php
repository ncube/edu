<?php
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

$data['requests'] = $requests;