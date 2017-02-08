<?php
$u = $GLOBALS['url_array'];
$u = isset($u[2]) ? $u[2]: 'posts';
$base_url = ($u === 'index.php') ? 'index' : $u;
$data['groups_nav_active'][$base_url] = ' active';


$id = $GLOBALS['url_array'][1];
$group = new Group($id);
$group->getPublicData();
$group->getMembersPublicData();
$data['group_members_data'] = empty($group->members_public_data) ? [] : $group->members_public_data;

$data['group_data'] = $group->public_data;

function nav_active($item, $data) {
    $active = isset($data['groups_nav_active'][$item]) ? $data['groups_nav_active'][$item] : NULL;
    return $active;
}

$member = $group->isMember();
$admin = $group->isAdmin();

$page = isset($GLOBALS['url_array'][2]) ? $GLOBALS['url_array'][2] : NULL;

if(!$member && $page !== 'profile') {
    Redirect::to('/groups'.'/'.$GLOBALS['url_array'][1].'/profile');
}

$data['showIfMember'] = NULL;
$data['showIfAdmin'] = NULL;
$data['hideIfMember'] = 'hidden';


if(!$member) {
    $data['showIfMember'] = 'hidden';
    $data['hideIfMember'] = NULL;
}

if(!$admin) {
    $data['showIfAdmin'] = 'hidden';
}

// Requests
$group->getRequests();
$data['requests'] = $group->requests;