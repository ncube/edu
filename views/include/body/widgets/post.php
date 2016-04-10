<div class="col-xs-12">
    <div class="col-md-12 post">
        <br>
        <div class="row">
            <div class="col-md-4 post-head">
                <img class="profile_pic">
                <img class="post-thumb" src="<?=$value['profile_pic']?>" alt="@<?=$value['username']?>"/>
                <b>&nbsp @<?=$value['username']?></b>
            </div>
            <div class="col-md-3 post-time">
                <?=date("d M h:i A", $value['time'])?>
            </div>
        </div>
        <div class="row" style="padding: 15px;">
            <hr>
            <div class="col-md-12">
                <?=$value['post_data']?>
            </div>
        </div>
        <div class="row post-foot">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-4">
                    <i class="fa fa-heart"></i> Like
                </div>
                <div class="col-md-4">
                    <a href="#" id="comment"><i class="fa fa-comment"></i> Comment</a>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-share"></i> Share
                </div>
            </div>
        </div>
            <div class="row cmnts">
                <form method="post" action="/post/<?=$value['unique_id']?>/comment">
                    <div class="col-xs-2">
                        Comments
                    </div>
                    <div class="col-xs-9">
                        <input type="text" class="form-field form-field-sm" name="comment" placeholder="comment">
                        <input type="hidden" name="token" value="<?=$data['token']?>">
                    </div>
                    <div class="col-xs-1">
                        <button type="submit" class="btn"><i class="fa fa-send"></i></button>
                    </div>
                </form>
            </div>
            <div class="row">
                <hr>
                <?php
                    foreach ($value['comments'] as $value2) {
                        echo '
                            <div class="row cmnts">
                                <div class="col-xs-3">
                                    <img src="'.$value2['profile_pic'].'" class="cmnts-content-img">
                                    <a>'.$value2['username'].'</a>
                                </div>
                                <div class="col-xs-9">
                                    <p style="margin-top: 10px;">'.$value2['content'].'</p>
                                    <p class="cmnts-content-time">'.date("d M h:i A", $value2['time']).'</p>
                                </div>
                            </div>
                        ';
                    }
                ?>
        </div>
    </div>
</div>