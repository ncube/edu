<?php
function side_active($item, $data) {
    $active = isset($data['side_active'][$item]) ? $data['side_active'][$item] : NULL;
    return $active;
}
?>
<div class="flex-column-fixed hidden-sm-down" id="side-menu">
    <div class="navbar-v-fluid">
        <ul class="nav nav-pills nav-stacked">
            <li class="nav-item">
                <a href="/" class="nav-link<?=side_active('index', $data)?>"><i class="fa fa-home nav-icon"></i> Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?=side_active('profile', $data)?>" href="/profile"><i class="fa fa-user nav-icon"></i> <span> Profile</span> </a>
            </li>

            <li class="nav-item">
                <a class="nav-link<?=side_active('inbox', $data)?>" href="/inbox"><i class="fa fa-envelope nav-icon"></i> <span> Inbox</span> </a>
            </li>

            <li class="nav-item">
                <a class="nav-link<?=side_active('groups', $data)?>" href="/groups"><i class="fa fa-users nav-icon"></i> <span> Groups</span> </a>
            </li>

            <li class="nav-item">
                <a class="nav-link<?=side_active('questions', $data)?>" href="/questions"><i class="fa fa-question nav-icon"></i> <span> Questions</span> </a>
            </li>

            <li class="nav-item">
                <a class="nav-link<?=side_active('settings', $data)?>" href="/settings"><i class="fa fa-cogs nav-icon"></i> <span> Settings</span> </a>
            </li>
        </ul>
    </div>
</div>