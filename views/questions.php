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
                    <a href="/questions/create" class="btn">Ask Question</a>
                    <?php
                        if (!empty($data['questions'])) {
                            foreach ($data['questions'] as $value) {
                                echo '
                                    <div class="q-list">
                                        <div class="row" id="'.$value['q_id'].'">
                                            <div class="col-xs-3 q-left">
                                                <i class="fa fa-thumbs-up fa-2x voteup '.$value['my_data']['vote_up_class'].'" id="'.$value['q_id'].'up'.'"></i> '.$value['up_count'].' &nbsp
                                                <i class="fa fa-thumbs-down fa-2x votedown '.$value['my_data']['vote_down_class'].'" id="'.$value['q_id'].'down'.'"></i> '.$value['down_count'].'
                                                <h5>'.$value['answers'].' Answers</h5>
                                                '.$value['views'].' Views
                                                <br>
                                                <br>';
                                                for ($i=0; $i < 5; $i++) {
                                                    $a = (int) $value['level'];
                                                    if ($i === $a && gettype($value['level']) === 'double') {
                                                        echo '<i class="fa fa-star-half-full"></i> ';
                                                    } elseif ($i < $value['level']) {
                                                        echo '<i class="fa fa-star"></i> ';
                                                    } else {
                                                        echo '<i class="fa fa-star-o"></i> ';
                                                    }
                                                }
                                            echo '&nbsp '.$value['level'].'
                                                <br>
                                                <img src="'.$value['pic'].'" class="q-img">
                                                '.ucwords($value['user_data']['first_name']).' '.ucwords($value['user_data']['last_name']).'
                                            </div>
                                            <div class="col-xs-9">
                                                <div class="q-name">
                                                    <a href="#">'.$value['title'].'</a>
                                                </div>
                                                <div class="q-desp">
                                                    '.$value['content'].'
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php include 'include/body/footer.php'; ?>
</body>
<script type="text/javascript" src="/public/js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="/public/js/ajax/search.js"></script>
<script>
    var token = "<?=$data['token']?>";
</script>
<script type="text/javascript" src="/public/js/ajax/questions.js"></script>
</html>