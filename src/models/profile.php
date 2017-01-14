<?php
if (empty($url['args'])) {
    $username = $data['username'];
} else {
    $username = $url['args'][0];
}

$profile_id = User::getPublicUserId($username);
$profile_data = User::getPublicUserData($profile_id)[0];

$data['profile_data']['username'] = $username;
$data['profile_data']['first_name'] = ucwords($profile_data['first_name']);
$data['profile_data']['last_name'] = ucwords($profile_data['last_name']);
$data['profile_data']['email'] = $profile_data['email'];
$data['profile_data']['profile_pic'] = User::getProfilePic($profile_data['profile_pic']);

$data['profile_data']['follow'] = User::checkFollow($username);