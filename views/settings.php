<html>

<head>
    <title><?=$data['title']?></title>
    <link rel="stylesheet" type="text/css" href="/public/css/ncube-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/custom.css">
    <style>
        .stngs-menu {
            height: 100%;
            padding: 0px;
            border-right: 1px solid lightgray;
        }
        
        .stngs-menu-item {
            padding: 15px;
            padding-left: 20px;
            border-bottom: 1px solid lightgray;
        }
        
        .stngs-menu-item:hover {
            background-color: whitesmoke;
        }
        
        .stngs-menu-item-active {
            background-color: whitesmoke;
        }
        
        .stngs-content {
            padding: 10px;
        }
        
        .stngs-content-items {
            padding: 10px;
            padding-left: 30px;
            font-size: 15px;
            color: gray;
        }
        
        .stngs-content hr {
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
            
            <div class="row">
                <div class="col-xs-2 stngs-menu">
                    <a href="/settings/general">
                        <div class="stngs-menu-item<?=$data['active']['general']?>">
                            <i class="fa fa-cogs" style="color: darkslategray">&nbsp</i> General
                        </div>
                    </a>
                    <a href="/settings/privacy">
                        <div class="stngs-menu-item<?=$data['active']['privacy']?>">
                            <i class="fa fa-lock" style="color: darkslategray">&nbsp</i> Privacy
                        </div>
                    </a>
                    <a href="/settings/security">
                        <div class="stngs-menu-item<?=$data['active']['security']?>">
                            <i class="fa fa-shield" style="color: darkslategray">&nbsp</i> Security
                        </div>
                    </a>
                    <a href="/settings/notifications">
                        <div class="stngs-menu-item<?=$data['active']['notifications']?>">
                            <i class="fa fa-bell" style="color: darkslategray">&nbsp</i> Notifications
                        </div>
                    </a>
                </div>
                <?php
                    switch ($data['url'][0]) {
                        case 'general':
                            include 'include/body/settings/general.php';
                            break;
                            
                        case 'privacy':
                            include 'include/body/settings/privacy.php';
                            break;
                            
                        case 'security':
                            include 'include/body/settings/security.php';
                            break;
                            
                        case 'notifications':
                            include 'include/body/settings/notifications.php';
                            break;
                        
                        default:
                            echo 'Quick Settings goes here.';
                            break;
                    }
                
                ?>
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