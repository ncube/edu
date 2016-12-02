<?php
$data['user_id'] = Session::get('user_id');
$data['user_data'] = User::getPublicUserData($data['user_id'])[0];
$data['username'] = $data['user_data']['username'];
$data['token'] = Token::generate();
$data['side_active'][explode('/',$url['path'])[0]] = ' active';

$data['first_name'] = ucwords($data['user_data']['first_name']);
$data['last_name'] = ucwords($data['user_data']['last_name']);
$data['email'] = $data['user_data']['email'];
$data['profile_pic'] = User::getProfilePic($data['user_data']['profile_pic']);