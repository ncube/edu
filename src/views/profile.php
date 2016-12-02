<div class="card card-block col-lg-7">
    <div class="row">
        <div class="col-sm-5">
            <?php
                if (User::getPublicUserId($data['profile_data']['username']) === Session::get('user_id')) {
                    echo '
                    <a href="#">
                        <div class="img-upload"><img src="'.$data['profile_data']['profile_pic'].'" alt="'.$data['profile_data']['username'].'"/><span><i class="fa fa-upload fa-2x"></i><br>Change Picture</span></div>
                    </a>';
                } else {
                    echo '<img src="'.$data['profile_data']['profile_pic'].'" alt="@'.$data['profile_data']['username'].'" class="img-thumb-lg">';
                }
            ?>
        </div>
        <div class="col-sm-7">
            <div class="row">
                <h3><?=$data['profile_data']['first_name']?> <?=$data['profile_data']['last_name']?></h3>
                <h5 style="color: gray">@ <?=$data['profile_data']['username']?></h5>
                <i class="fa fa-briefcase"></i> Student
                <br>
                <i class="fa fa-graduation-cap"></i> NCube School
                <br>
                <i class="fa fa-map-marker"></i> HYD-IN.
                <br>
                <a style="color: black">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam varius tellus vulputate sapien pellentesque scelerisque. Interdum et malesuada fames ac ante ipsum primis in faucibus. .</a>
            </div>
            <?php
                if (User::getPublicUserId($data['profile_data']['username']) !== Session::get('user_id')) {
                    echo '<div class="row">';
                    echo '<div class="col-md-4" id="follow-btn">';
                    if ($data['profile_data']['follow'] === TRUE) {
                        echo '<a class="btn btn-error m-t-20" id="unfollow"><i class="fa fa-times"></i> Unfollow</a>';
                    } else {
                        echo '<a class="btn btn-success m-t-20" id="follow"><i class="fa fa-check"></i> Follow</a>';
                    }
                    echo '
                            </div>
                            <div class="col-md-3">
                            <form action="/'.$GLOBALS['url'].'/request" method="post">
                                <input type="hidden" name="username" value="'.$data['profile_data']['username'].'">
                                <input type="hidden" name="token" value="'.$data['token'].'">
                                    <button type="submit" class="btn btn-success m-t-20"> <i class="fa fa-plus"></i> Add</button>
                            </form>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-success m-t-20" href="/messages/'.$data['profile_data']['username'].'"> <i class="fa fa-envelope"></i> Message</a>
                            </div>
                        </div>
                    ';
                }
            ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4" style="text-align: center;"><b>Followers</b><br>NA</div>
        <div class="col-md-4" style="text-align: center;"><b>Questions</b><br>NA</div>
        <div class="col-md-4" style="text-align: center;"><b>Answers</b><br>NA</div>
    </div>
</div>