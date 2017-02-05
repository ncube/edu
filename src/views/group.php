<?php
$id = $GLOBALS['url_array'][1];
$group = new Group($id);
$group->getPublicData();
$data['group_data'] = $group->public_data;

function nav_active($item, $data) {
    $active = isset($data['groups_nav_active'][$item]) ? $data['groups_nav_active'][$item] : NULL;
    return $active;
}
?>

<div class="card" style="height: 100%;">
    <div class="init-flex">
    <section ng-controller="header">
        <nav class="groups-menu">
            <a class="navbar-brand" href="/groups/<?=$GLOBALS['url_array']['1']?>" style="margin-left: 20px;"><?=$data['group_data']['name']?></a>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link<?=nav_active('posts', $data)?>" href="/groups/<?=$GLOBALS['url_array']['1']?>">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?=nav_active('profile', $data)?>" href="/groups/<?=$GLOBALS['url_array']['1']?>/profile">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?=nav_active('members', $data)?>" href="/groups/<?=$GLOBALS['url_array']['1']?>/members">Members</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?=nav_active('settings', $data)?>" href="/groups/<?=$GLOBALS['url_array']['1']?>/settings">Settings</a>
                </li>
            </ul>
        </nav>
    </section>
    <div class="flex-container" style="overflow-x: auto;">
          <div class="flex-column-fluid">
            <div class="container-hr-fluid">
                <?=Core::loadView('-2-', $data)?>
            </div>

          </div>
      </div>
    
    </div>

</div>