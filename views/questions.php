<html>

<head>
    <title><?=$data['title']?></title>
    <link rel="stylesheet" type="text/css" href="/public/css/ncube-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/custom.css">
    <style>
        .q-list {
            margin-top: 20px;
            border-radius: 0 8px 8px 0;
            background-color: whitesmoke;
            border-left: 5px solid green;
            padding-left: 10px;
        }

        .q-name {
            margin-top: 8px;
            margin-bottom: 20px;
            font-size: 20px;
            font-weight: bold;
            color: orange;
        }

        .q-desp {
           color: darkslategray;
        }

        .q-left {
            text-align: center;
            background-color: #EEEEEE;
            line-height: 1.8em;
            padding: 15px 0;
        }

        .q-img {
            width:  30px;
            height: 30px;
            background-color: white;
            border-radius: 5px;
        }

        .vote-up-active {
            color: #4CAF50;
        }

        .vote-down-active {
            color: #F44336;
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
                    <div class="col-xs-12">
                        <div class="q-name">
                            <?php
                                $t = Question::getPublicQuestion($data['question']['id'])[0];
                            ?>
                            <a><?=$t['title']?></a>
                        </div>
                        <div class="q-desp">
                            <?=$t['content']?>
                            <!--<br>
                            Views: <?=$t['views']?>
                            <br>
                            Difficulty: <?=$t['difficulty']?>
                            <br>
                            Time: <?=$t['time']?>
                            <br>
                            User Id: <?php print_r(User::getPublicUserData($t['user_id']))?>-->
                        </div>
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
<script type="text/javascript" src="/public/js/ajax/questions.js"></script>
</html>