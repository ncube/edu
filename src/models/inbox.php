<?php
$url = $GLOBALS['url_array'];
$data['active_username'] = isset($url[1]) ? $url[1] : NULL;
$data['list_data'] = Inbox::getUsersList();

if (!empty($url[1])) {
    $msgs = Inbox::getMessages($url[1]);
    foreach($msgs as $key => $value) {
        $msgs[$key]['time'] = date("h:i A", $value['time']);
    }
    $data['msgs'] = $msgs;
    $data['recipient'] = $url[1];
}
