<?php
$data['user_id'] = Session::get('user_id');
$user = new User;
$user->getPublicData();
$user->getProfilePic();
$data['user_data'] = $user->user_data;
$data['username'] = $data['user_data']['username'];
$data['token'] = Token::generate();
$base_url = $GLOBALS['url_array'];
$base_url = isset($base_url[0]) ? $base_url[0]: 'index';
$data['side_active'][$base_url] = ' active';

$data['first_name'] = ucwords($data['user_data']['first_name']);
$data['last_name'] = ucwords($data['user_data']['last_name']);
$data['email'] = $data['user_data']['email'];
$data['profile_pic'] = $data['user_data']['profile_pic'];