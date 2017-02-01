<?php
$data['user_id'] = Session::get('user_id');
$user = new User;
$user->getPublicData();
$data['user_data'] = $user->public_data;
$data['username'] = $data['user_data']['username'];
$data['token'] = Token::generate();
$data['side_active'][explode('/',$url['path'])[0]] = ' active';

$data['first_name'] = ucwords($data['user_data']['first_name']);
$data['last_name'] = ucwords($data['user_data']['last_name']);
$data['email'] = $data['user_data']['email'];
$data['profile_pic'] = $data['user_data']['profile_pic'];