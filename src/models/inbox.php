<?php
$url = $GLOBALS['url_array'];
$data['active_username'] = isset($url[1]) ? $url[1] : NULL;
// TODO: Replace with Following list
// $data['list_data'] = User::getAcceptedUsersData();
$data['list_data'] = [];

if (!empty($url[1])) {
    $msgs = Message::getMessages($url[1]);
    foreach($msgs as $key => $value) {
        $msgs[$key]['time'] = date("h:i A", $value['time']);
    }
    $data['msgs'] = $msgs;
    $data['recipient'] = $url[1];
}
