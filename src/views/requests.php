<html>

<head>
    <title><?=$data['title']?></title>
    <link rel="stylesheet" type="text/css" href="/public/css/ncube-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/custom.css">
    <style>
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
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <?php
                            foreach($data['requests'] as $value) {
                                echo '
                                    <div class="req-content">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="col-md-2">
                                                    <img class="req-pic" src="'.$value['user_data']['profile_pic'].'" />
                                                </div>
                                                <div class="col-md-10">
                                                    <h4><a href="/profile/'.$value['user_data']['username'].'" style="color: black">'.ucwords($value['user_data']['first_name']).' '.ucwords($value['user_data']['last_name']).'</a></h4>
                                                    <a>wants to add you as '.$value['type'].'</a>
                                                </div>
                                            </div>
                                            <div class="col-md-4 req-btns">
                                                <button type="submit" class="btn btn-secondary">Accept</button>
                                                <button type="submit" class="btn btn-secondary">Reject</button>
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