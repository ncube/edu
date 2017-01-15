<?php
$url = $GLOBALS['url_array'];
$data['active_username'] = $url[1];
// TODO: Replace with Following list
// $data['list_data'] = User::getAcceptedUsersData();

if (!empty($url[0])) {
    $msgs = Message::getMessages($url[1]);
    foreach($msgs as $key => $value) {
        $msgs[$key]['time'] = date("h:i A", $value['time']);
    }
    $data['msgs'] = $msgs;
}

$data['recipient'] = $url[1];