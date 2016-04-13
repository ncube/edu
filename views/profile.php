<html>

<head>
    <title><?=$data['username']?> - Profile</title>
    <link rel="stylesheet" type="text/css" href="/public/css/ncube-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/custom.css">
    <link rel="stylesheet" type="text/css" href="/public/css/widgets/posts.css">
</head>

<body onclick="event_handler(event)">
    
    <?php include 'include/body/header.php'; ?>
    <?php include 'include/body/search.php'; ?>
    <?php include 'include/body/side-menu.php'; ?>

    <div class="has-side-header">
        <div class="container-hr">
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-5 profile-div">
                            <img src="<?=$data['profile_data']['profile_pic']?>" alt="@<?=$data['profile_data']['username']?>" class="profile_pic">
                            <?php
                                if (User::getPublicUserId($data['profile_data']['username']) === Session::get('user_id')) {
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
                                <h3><?=$data['profile_data']['first_name']?> <?=$data['profile_data']['last_name']?></h3>
                                <h4 style="color: gray">@ <?=$data['profile_data']['username']?></h4>
                                <a style="color: black">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam varius tellus vulputate sapien pellentesque scelerisque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus sodales tortor in pharetra convallis.</a>
                            </div>
                            <br>
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
                                            <form action="request" method="post">
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
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="aboutme">
                                <h4>About</h4>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Gender</td>
                                            <td><?=$data['profile_data']['gender']?></td>
                                        </tr>
                                        <tr>
                                            <td>Age</td>
                                            <td><?=$data['profile_data']['age']?></td>
                                        </tr>
                                        <tr>
                                            <td>Date of birth</td>
                                            <td><?=$data['profile_data']['dob']?></td>
                                        </tr>
                                        <tr>
                                            <td>Country</td>
                                            <td><?=$data['profile_data']['country']?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?=$data['profile_data']['email']?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                            if (!empty($data['post'])) {
                                foreach ($data['post'] as $value) {
                                    include 'include/body/widgets/post.php';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'include/body/footer.php'; ?>
</body>
<script type="text/javascript" src="/public/js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="/public/js/search.js"></script>
<script>
    var token = "<?=$data['token']?>";
    var username = "<?=$data['profile_data']['username']?>";
</script>
<script type="text/javascript" src="/public/js/profile.js"></script>
</html>