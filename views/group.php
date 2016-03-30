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
            float: right;
        }
        
        .grp-title {
            margin-top: 15px;
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
            <?php
                if (!empty($data['grp_data']['group_pic'])) {
                    echo '<img src="/data/images/group/'.$data['grp_data']['group_pic'].'.jpg" class="grp-img" />';
                } else {
                    echo '<i class="fa fa-group fa-2x grp-img grp-img-icon"></i>';
                }
            ?>
                <h4 class="grp-title"><?=$data['grp_data']['group_name']?></h4>
            <div class="grp-menu">
                <button type="submit" class="btn btn-secondary" style="margin-top: -45px;"><i class="fa fa-info-circle"></i> About</button>
                <button type="submit" class="btn btn-secondary" style="margin-top: -45px;"><i class="fa fa-group"></i> Members</button>
                <button type="submit" class="btn btn-secondary" style="margin-top: -45px;"><i class="fa fa-cog"></i> Settings</button>
            </div>
        </div>                                
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    Description: <?=$data['grp_data']['desp']?>
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