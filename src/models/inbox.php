<?php
$data['active_username'] = $url[0];
$data['list_data'] = User::getAcceptedUsersData();

if (!empty($url[0])) {
    $data = Message::getMessages($url[0]);
    foreach($data as $key => $value) {
        $data[$key]['time'] = date("h:i A", $value['time']);
    }
    $data['msgs'] = $data;
}

$data['recipient'] = $url['args'][0];