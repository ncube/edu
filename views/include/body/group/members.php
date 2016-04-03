<?php 
$reqs = Group::getMembers($data['grp_id']);

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
                        <h4>'.ucwords($value['first_name']).' '.ucwords($value['last_name']).'</h4>
                        <a>@'.$value['username'].', '.$value['country'].'</a>
                    </div>
                </div>
            </div>
        </div>
    ';
}