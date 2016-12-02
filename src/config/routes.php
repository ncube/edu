<?php
$routes = array(
    'index' => 'home',
    'profile' => 'profile/*/accept,request',
    'settings' => 'settings/general,privacy,security,notifications',
    'questions' => 'questions/*/answer',
    'inbox' => 'inbox/*'
);  