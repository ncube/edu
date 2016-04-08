<html>

<head>
    <title><?=$data['title']?></title>
    <link rel="stylesheet" type="text/css" href="/public/css/ncube-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/custom.css">
    <style>
        .q-list {
            margin-top: 20px;
            padding: 15px;
            overflow: hidden;
            border-radius: 8px;
            background-color: whitesmoke;
        }

        .q-name {
            margin-top: 8px;
            margin-bottom: 20px;
            font-size: 20px;
            font-weight: bold;
        }

        .q-head {
            margin: -15px;
            margin-top: 5px;
            background-color: whitesmoke;
            height: 70px;
            padding: 10px;
            border-top: 1px solid lightgray;
            text-align: right;
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
                        <a href="/questions/create" class="btn">Ask Question</a>
                        <?php
                            if (!empty($data['questions'])) {
                                foreach ($data['questions'] as $value) {
                                    echo '
                                        <div class="q-list">
                                            <div class="q-name">
                                                <a href="#">'.$value['title'].'</a>
                                            </div>
                                            <div class="q-desp">
                                                '.$value['content'].'
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
    </div>
    <?php include 'include/body/footer.php'; ?>
</body>
<script type="text/javascript" src="/public/js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="/public/js/search.js"></script>

</html>