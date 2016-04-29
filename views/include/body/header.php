<div class="header">
    <a href="index.php"><img src="/public/images/logo.svg" id="logo" alt="Logo"></a>
    <a href="/"><h1 class="title">NCube</h1></a>
    <div class="col-xs-7" style="margin-left: 50px;">
        <input type="search" autocomplete="off" id="search" class="search-field form form-field hidden-xs-down" placeholder="Search here..!"><i class="fa fa-search search-icon" id="search-icon"></i>
    </div>
    <?php
        if (Session::loggedIn()) {?>
            <div class="header-icon">
                <form method="post" action="/logout">
                    <input type="hidden" value="<?=$data['token']?>" name="token">
                    <button type="submit" class="btn-reset"><i class="fa fa-sign-out"></i></button>
                </form>
            </div>
            <div class="header-icon">
                <a href="/settings"><button type="submit" class="btn-reset"><i class="fa fa-cogs"></i></button></a>
            </div>
            
            
            
            
            
            
            <div class="header-icon">
                <button type="submit" class="btn-reset" id="notif-msg">
                    <i class="fa fa-envelope"></i>
                    <span class="badge"><?=$data['notif_msg_count']?></span>
                </button>
                <div id="notif-msg-div">
                    <div class="arrow-b"></div>
                    <div class="arrow-t"></div>
                    <div class="notif notif-msg">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    Messages <a style="float:right; margin-right: 20px"><?=$data['notif_msg_count']?></a>
                                    <hr>
                                </div>
                            </div>
                            <?php
                            
                           
                            
                            if (!empty($data['notif_msg'])) {
                                
                                foreach ($data['notif_msg'] as $value) {
                                
                                    echo '
                                        <a href="/messages/'.$value['username'].'">
                                            <div class="row notif-content">
                                                <div class="col-xs-2" style="">
                                                    <img class="notif-thumb" src="'.$value['profile_pic'].'">
                                                </div>
                                                <div class="col-xs-10" style="font-size: 14px;">
                                                    <b>'.ucwords($value['first_name']).' '.ucwords($value['last_name']).'</b> '.$value['msg'].' sent you a message
                                                    <div class="notif-time">
                                                        <span>'.date("d M h:i A", $value['time']).'</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    ';
                                }
                            }
                            ?>
                            <div class="row notif-footer">
                                <a href="/messages">See All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
            
            
            
            
            
            <div class="header-icon">
                <button type="submit" class="btn-reset" id="notif">
                    <i class="fa fa-bell" id="bell"></i>
                    <span class="badge"><?=$data['notif_count']?></span>
                </button>
                <div id="notif-div">
                    <div class="arrow-b"></div>
                    <div class="arrow-t"></div>
                    <div class="notif">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    Notifications <a style="float:right; margin-right: 20px"><?=$data['notif_count']?></a>
                                    <hr>
                                </div>
                            </div>
                            <?php
                                foreach ($data['notif'] as $value) {
                                
                                    echo '
                                        <a href="'.$value['link'].'">
                                            <div class="row notif-content">
                                                <div class="col-xs-2" style="">
                                                    <img class="notif-thumb" src="'.$value['profile_pic'].'">
                                                </div>
                                                <div class="col-xs-10" style="font-size: 14px;">
                                                    <b>'.ucwords($value['first_name']).' '.ucwords($value['last_name']).'</b> '.$value['msg'].'
                                                    <div class="notif-time">
                                                        <span>'.date("d M h:i A", $value['time']).'</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    ';
                                }
                            ?>
                            <div class="row notif-footer">
                                <a href="/notifications">See All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><?php
        } else {?>
            <div class="header-icon">
                <a href="/"><button class="btn btn-primary" style="margin-top: -8px;">Login</button></a>
            </div><?php
        } ?>
</div>