<?php
$routes_ajax = array(
    '404' => array(
        'file' => '404'
    ),
    'ajax/search' => array(
        'protect' => TRUE,
        'file' => 'search'
    ),
    'ajax/data' => array(
        'protect' => TRUE,
        'file' => 'data'
    ),
    'ajax/user/notifications/get' => array(
        'protect' => TRUE,
        'file' => 'notifications'
    ),
    'ajax/user/inbox/get' => array(
        'protect' => TRUE,
        'file' => 'inbox'
    ),
    'ajax/user/inbox/send' => array(
        'protect' => TRUE,
        'file' => 'inbox'
    ),
);