<?php 
$reqs = Group::getRequests($data['grp_id']);

foreach($reqs as $key => $value) {
    if (empty($value['profile_pic'])) {
        $reqs[$key]['profile_pic'] = '/public/images/profile-pic.png';
    } else {
        $reqs[$key]['profile_pic'] = '/data/images/profile/'.$value['profile_pic'].'.jpg';
    }
}
foreach($reqs as $value) {
    echo '
        <div class="req-content">
            <div class="row">
                <div class="col-md-8">
                    <div class="col-md-2">
                        <img class="req-pic" src="'.$value['profile_pic'].'" />
                    </div>
                    <div class="col-md-10">
                        <h4><a href="/profile/'.$value['username'].'" style="color: black">'.ucwords($value['first_name']).' '.ucwords($value['last_name']).'</a></h4>
                        <a>@'.$value['username'].', '.$value['country'].'</a>
                    </div>
                </div>
                <div class="col-md-4 req-btns">
                    <form action="/groups/'.$data['grp_id'].'/accept" method="post">
                        <input type="hidden" value="'.$data['token'].'" name="token">
                        <input type="hidden" name="username" value="'.$value['username'].'">
                        <button type="submit" class="btn btn-secondary">Accept</button>
                    </form>
                    <form action="/groups/'.$data['grp_id'].'/reject" method="post">
                        <input type="hidden" value="'.$data['token'].'" name="token">
                        <input type="hidden" name="username" value="'.$value['username'].'">
                        <button type="submit" class="btn btn-secondary">Reject</button>
                    </form>
                </div>
            </div>
        </div>
    ';
}