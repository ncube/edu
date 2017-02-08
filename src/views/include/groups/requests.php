<?php
foreach ($data['requests'] as $value) {
    echo '
        <div class="col-lg-5 col-md-12">
                <div class="card">
                    <div class="card-block">
                        <img alt="user-img" class="img-thumb-sm" src="/data/images/profile/35/'.$value['profile_pic'].'.jpg">
                        <span style="color: inherit; text-decoration: none; font-size: 20px;">
                            <a href="/profile/'.$value['username'].'">
                                &nbsp <strong>'.$value['first_name'].' '.$value['last_name'].'</strong>
                            </a>
                        </span>
                        <button ng-click="accept(\''.$value['user_id'].'\')" class="btn btn-success">Accept</button>
                        <button ng-click="reject(\''.$value['user_id'].'\')" class="btn btn-danger">Reject</button>
                    </div>
                </div>
        </div>
    ';
}