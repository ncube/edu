<!DOCTYPE html>
<html>

<head>
  <?php include 'include/head/common.php'; ?>
</head>

<body>

<div class="init-flex">
    <?php include 'include/body/header.php'; ?>
    <div class="flex-container">
        <?php include 'include/body/side-menu.php'; ?>
        <div class="flex-column-fluid" style="padding: 10px; overflow: hidden;">
            <div class="container-fluid" style="width: 100%;">
                <div class="card" style="height: 100%;">
                        <div class="col-xs-3 stngs-menu">
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
    </div>
</div>
</body>

<?php include 'include/js/common.php'; ?>

</html>