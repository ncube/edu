<html>

<head>
    <title><?=$data['title']?></title>
    <link rel="stylesheet" type="text/css" href="/public/css/ncube-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/custom.css">
    <style>
        
        .grp-header {
            background-color: whitesmoke;
            margin-left: -0.9375rem;
            margin-right: -0.9375rem;
            margin-top: -5px;
            height: 66px;
            padding: 9px;
        }
        
        .grp-img {
            background-color: white;
            border: 1px solid lightgray;
            width: 50px;
            height: 50px;
            border-radius: 5px;
            float: left;
            margin-left: 20px;
            margin-right: 20px;
        }

        .grp-img-icon {
            padding: 8px;
            padding-top: 10px;
            background-color: black;
            color: white;
        }
        
        .grp-menu {
            padding-top: 13px;
            padding-right: 10px;
            text-align: right;
        }
        
        .grp-title {
            margin-top: 15px;
        }
        
        .req-content {
            background-color: whitesmoke;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .req-content a {
            color: gray;
        }

        .req-pic {
            width: 50px;
            height: 50px;
            border-radius: 5px;
        }

        .req-btns {
            margin-top: 10px;
        }
    </style>
</head>

<body onclick="event_handler(event)">
    
    <?php include 'include/body/header.php'; ?>
    <?php include 'include/body/search.php'; ?>
    <?php include 'include/body/side-menu.php'; ?>
<div class="has-side-header">
    <div class="container-hr">
        <div class="grp-header">
            <div class="col-xs-5">
                <?php
                    if (!empty($data['grp_data']['group_pic'])) {
                        echo '<img src="/data/images/group/'.$data['grp_data']['group_pic'].'.jpg" class="grp-img" />';
                    } else {
                        echo '<i class="fa fa-group fa-2x grp-img grp-img-icon"></i>';
                    }
                ?>
                <h4 class="grp-title"><?=$data['grp_data']['group_name']?></h4>
            </div>
            <div class="col-xs-7 grp-menu">
                    <button type="submit" class="btn btn-secondary"><i class="fa fa-info-circle"></i> About</button>
                    <?php
                        if (Group::isMember($data['grp_id'])) {
                            echo '
                                <a class="btn btn-secondary" href="/groups/'.$data['grp_id'].'/members"><i class="fa fa-group"></i> Members</a>
                            ';
                            if (Group::isAdmin($data['grp_id'])) {
                                echo '
                                    <button type="submit" class="btn btn-secondary"><i class="fa fa-cog"></i> Settings</button>
                                    <a href="/groups/'.$data['grp_id'].'/requests" class="btn btn-secondary"><i class="fa fa-user-plus"></i> Requests</a>
                                ';
                            }
                        } else {
                            echo '
                                <a href="/groups/'.$data['grp_id'].'/join" class="btn btn-secondary"><i class="fa fa-user-plus"></i> Join</a>
                            ';
                        }
                    ?>
            </div>
        </div>                                
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <?php
                    switch ($data['grp_page']) {
                        case 'requests':
                            include 'include/body/group/requests.php';
                            break;
                            
                        case 'members':
                            include 'include/body/group/members.php';
                            break;
                        
                        default:
                            echo 'Description: '.$data['grp_data']['desp'];
                            break;
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
<script type="text/javascript" src="/public/js/notif.js"></script>
<script>
    var token = "<?=$data['token']?>";
</script>
<script type="text/javascript" src="/public/js/ajax/notif.js"></script>

</html>