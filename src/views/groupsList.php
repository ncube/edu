<html>

<head>
    <title><?=$data['title']?></title>
    <link rel="stylesheet" type="text/css" href="/public/css/ncube-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/custom.css">
    <style>
        .grp-list {
            margin-top: 20px;
            padding: 15px;
            width: 400px;
            height: 150px;
            border-radius: 8px;
            background-color: whitesmoke;
        }

        .grp-img {
            background-color: white;
            border: 1px solid lightgray;
            width: 50px;
            height: 50px;
            border-radius: 5px;
            float: left;
            margin-right: 20px;
        }

        .grp-name {
            margin-top: 8px;
            margin-left: 20px;
            font-size: 20px;
        }

        .grp-head {
            height: 60px;
        }

        .grp-cap {
            float: right;
        }
        
        .grp-img-icon {
            padding: 8px;
            padding-top: 10px;
            background-color: black;
            color: white;
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
                        
                        <form method="post" action="<?=$data['grp_action']?>" class="form-inline">
                            <div class="form-group col-xs-4">
                                <input type="name" class="form-field" style="width: 100%" placeholder="Group Name" name="name">
                            </div>
                            <div class="form-group col-xs-6">
                                <input type="text" class="form-field" style="width: 100%" placeholder="Description" name="desp">
                            </div>
                            <div class="form-group col-xs-2">
                                <input type="hidden" name="token" value="<?=$data['token']?>">
                                <button type="submit" class="btn btn-secondary" style="margin-top: 10px;">Create</button>
                            </div>
                        </form>
                    </div>
                    
                    <?php
                    if (!empty($data['grp_list'])) {
                        foreach ($data['grp_list'] as $value) {
                            if (!empty($value['group_pic'])) {
                                $img = '<img src="/data/images/group/'.$value['group_pic'].'.jpg" class="grp-img" />';
                            } else {
                                $img = '<i class="fa fa-group fa-2x grp-img grp-img-icon"></i>';
                            }

                            echo '
                                <div class="grp-list">
                                    <div class="grp-head">
                                        '.$img.'
                                        <div class="grp-name">
                                            <a href="/groups/'.$value['group_id'].'">'.$value['group_name'].'</a>
                                        </div>
                                        <div class="grp-cap">
                                            Members: '.$value['members'].'
                                        </div>
                                    </div>
                                    <div class="grp-desp">
                                        '.$value['desp'].'
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
<script type="text/javascript" src="/public/js/search.js"></script>
<script type="text/javascript" src="/public/js/notif.js"></script>
<script>
    var token = "<?=$data['token']?>";
</script>
<script type="text/javascript" src="/public/js/ajax/notif.js"></script>

</html>