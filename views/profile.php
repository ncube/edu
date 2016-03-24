<html>

<head>
    <title><?=$data['username']?> - Profile</title>
    <link rel="stylesheet" type="text/css" href="/public/css/ncube-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/custom.css">
</head>

<body onclick="event_handler(event)">
    
    <?php include 'include/body/header.php'; ?>
    <?php include 'include/body/search.php'; ?>           

    <div class="container-hr">
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-5 profile-div">
                        <img src="<?=$data['path']?>" alt="@<?=$data['username']?>" class="profile_pic">
                        <?php
                            if (User::getPublicUserId($data['username']) === Session::get('user_id')) {
                                echo '
                                    <form enctype="multipart/form-data" action="/profile/upload" method="post">
                                        <input type="hidden" name="token" value="'.$data['token'].'" />
                                        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                                        Choose a file to upload: <input name="uploaded_file" type="file" />
                                        <input type="submit" value="Upload" />
                                    </form>
                                ';
                            }
                        ?>
                    </div>
                    <div class="col-sm-7">
                        <div class="row">
                            <h3><?=$data['first_name']?> <?=$data['last_name']?></h3>
                            <h4 style="color: gray">@ <?=$data['username']?></h4>
                            <a style="color: black">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam varius tellus vulputate sapien pellentesque scelerisque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus sodales tortor in pharetra convallis.</a>
                        </div>
                        <br>
                        <?php
                            if (User::getPublicUserId($data['username']) !== Session::get('user_id')) {
                                echo '<div class="row">';
                                echo '<div class="col-md-4" id="follow-btn">';
                                if ($data['follow'] === TRUE) {
                                    echo '<a class="btn btn-error m-t-20" id="unfollow"><i class="fa fa-times"></i> Unfollow</a>';
                                } else {
                                    echo '<a class="btn btn-success m-t-20" id="follow"><i class="fa fa-check"></i> Follow</a>';
                                }
                                echo '
                                        </div>
                                        <div class="col-md-3">
                                        <form action="request" method="post">
                                        <input type="hidden" name="username" value="'.$data['username'].'">
                                        <input type="hidden" name="token" value="'.$data['token'].'">
                                            <button type="submit" class="btn btn-success m-t-20"> <i class="fa fa-plus"></i> Add</button>
                                        </div>
                                        <div class="col-md-3">
                                            <a class="btn btn-success m-t-20" href="/messages/'.$data['username'].'"> <i class="fa fa-envelope"></i> Message</a>
                                        </div>
                                    </div>
                                ';
                            }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="aboutme">
                            <br>
                            <h4>About</h4>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Gender</td>
                                        <td><?=$data['gender']?></td>
                                    </tr>
                                    <tr>
                                        <td>Age</td>
                                        <td><?=$data['age']?></td>
                                    </tr>
                                    <tr>
                                        <td>Date of birth</td>
                                        <td><?=$data['dob']?></td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td><?=$data['country']?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?=$data['email']?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                        foreach ($data['post'] as $value) {
                            echo '
                                <div class="col-xs-12">
                                    <div class="col-md-12 post">
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4 post-head">
                                                <img   class="profile_pic">
                                                <img class="post-thumb" src="'.$data['path'].'" alt="@'.$data['username'].'"/>
                                                <b>&nbsp @'.$data['username'].'</b>
                                            </div>
                                            <div class="col-md-3 post-time">
                                                '.date("d M h:i A", $value['time']).'
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 15px;">
                                            <hr>
                                            <div class="col-md-12">
                                                '.$value['post_data'].'
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php include 'include/body/footer.php'; ?>
</body>
<script type="text/javascript" src="/public/js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="/public/js/search.js"></script>
<script type="text/javascript">
    function follow() {
        var request = $.ajax({
            url: "/api/follow/",
            method: "POST",
            data: {"username" : "<?=$data['username']?>", "token": "<?=$data['token']?>"},
            dataType: "json"
        });
        request.done(function( msg ) {
            if (msg.success) {
                $("#follow-btn").html('<a class="btn btn-error m-t-20" id="unfollow"><i class="fa fa-times"></i> Unfollow</a>');
            }
            console.log(msg.errors);
        });
        request.fail(function( jqxhr, textStatus, error ) {
            var err = textStatus + ", " + error;
            console.log( "Request Failed: " + err );
        });
    }

    function unFollow() {
        var request = $.ajax({
            url: "/api/unfollow/",
            method: "POST",
            data: {"username" : "<?=$data['username']?>", "token": "<?=$data['token']?>"},
            dataType: "json"
        });
        request.done(function( msg ) {
            if (msg.success) {
            $("#follow-btn").html('<a class="btn btn-success m-t-20" id="follow"><i class="fa fa-check"></i> Follow</a>');
            }
            console.log(msg.errors);
        });
        request.fail(function( jqxhr, textStatus, error ) {
            var err = textStatus + ", " + error;
            console.log( "Request Failed: " + err );
        });
    }
</script>
<script type="text/javascript">
    function resetMe() {
        search.style.width = '';
        icon.style.marginRight = '';
        searchArea.style.display = '';
    }

    function event_handler(event) {
        var id = event.target.id;
        // var class_name = event.target.className;
        // var tag_name = event.target.tagName;

        search = document.getElementById('search');
        icon = document.getElementById('search-icon');
        searchArea = document.getElementById('search-area');

        document.onkeydown = function(evt) {
            evt = evt || window.event;
            if (evt.keyCode == 27) {
                resetMe();
            }
        };

        if (id == 'close') {
            resetMe();
        }
        
        // For Follow
        if (id === 'follow') {
            follow();
        }
        
        // For UnFollow
        if (id === 'unfollow') {
            unFollow();
        }

        if (id == 'search') {
            search.style.width = '100%';
            icon.style.marginRight = '0';
            searchArea.style.display = 'block';
        } else {
            resetMe();
        }
    }
</script>

</html>