<div class="card" style="height: 100%;" ng-controller="group">
    <div class="init-flex">
    <section>
        <nav class="groups-menu">
            <a class="navbar-brand" href="/groups/<?=$GLOBALS['url_array']['1']?>"><?=$data['group_data']['name']?></a>
            <ul class="nav nav-tabs" ng-init="requested='<?=$data['requested']?>'">
                <button class="btn btn-success" ng-click="joinGroup()" ng-hide="requested" <?=$data['hideIfMember']?>>Join</button>
                <button class="btn btn-primary" ng-click="revokeRequest()" ng-hide="!requested">Requested</button>
                <li class="nav-item" <?=$data['showIfAdmin']?>>
                    <a class="nav-link<?=nav_active('settings', $data)?>" href="/groups/<?=$GLOBALS['url_array']['1']?>/settings">Settings</a>
                </li>
                <li class="nav-item" <?=$data['showIfAdmin']?>>
                    <a class="nav-link<?=nav_active('requests', $data)?>" href="/groups/<?=$GLOBALS['url_array']['1']?>/requests">Requests</a>
                </li>
                <li class="nav-item" <?=$data['showIfMember']?>>
                    <a class="nav-link<?=nav_active('members', $data)?>" href="/groups/<?=$GLOBALS['url_array']['1']?>/members">Members</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?=nav_active('profile', $data)?>" href="/groups/<?=$GLOBALS['url_array']['1']?>/profile">Profile</a>
                </li>
                 <li class="nav-item" <?=$data['showIfMember']?>>
                    <a class="nav-link<?=nav_active('posts', $data)?>" href="/groups/<?=$GLOBALS['url_array']['1']?>">Posts</a>
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