<?php
$id = $GLOBALS['url_array'][1];
$group = new Group($id);
$group->getMembersPublicData();
$group_data = empty($group->members_public_data) ? [] : $group->members_public_data;

foreach ($group_data as $key => $value) {
    echo '
        <div class="col-lg-4 col-md-12">
            <a href="/profile/'.$value['username'].'">
                <div class="card">
                    <div class="card-block">
                        <img alt="user-img" class="img-thumb-sm" src="/data/images/profile/35/'.$value['profile_pic'].'.jpg">
                        <span style="color: inherit; text-decoration: none; font-size: 20px;">
                        &nbsp <strong>'.$value['first_name'].' '.$value['last_name'].'</strong>
                        </span>
                    </div>
                </div>
            </a>
        </div>
    ';
}