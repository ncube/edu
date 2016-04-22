<html>
<head>
    <title><?=$data['title']?></title>
    <link rel="stylesheet" type="text/css" href="/public/css/ncube-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/custom.css">
    <style>	
	.right {
		height: 100%;
        padding-bottom: 45px;
	}
	
	.left {
		height: 100%;
		overflow-y: auto;
        border-right: 1px solid lightgray;
	}
	
	.msg {
		background-color: white;
		height: 70px;
		font-size: 16px;
		padding: 15px;
		padding-left: 25px;
		border-bottom: 1px solid whitesmoke;
	}
	
	.msg:hover {
		background-color: lightgray;
	}
    
    .right-middle {
		background-color: palegoldenrod;
		height: 100%;
		font-size: 16px;
		padding: 15px;
        overflow-y: auto;
        padding-bottom: 100px;
	}
	
	.right-bottom {
		background-color: white;
        height: 45px;
		font-size: 16px;
		padding-top: 5px;
	}
    		
	.msg-sent {
		background-color: white;
		float: left ;
		padding: 10px;
		padding-left: 20px;
		border-radius: 10px;
        margin-bottom: 5px;
	}
    
	.msg-received {
		float: right;
		background-color: lightgreen;
        padding: 10px;
		padding-left: 20px;
		border-radius: 10px;
        margin-bottom: 5px;
	}
	.msg-field {
		font-size: 16px;
		padding: 3px 10px;
	}
    
    .msg-container {
        padding-right: 9px;
    }
    
    .send-icon {
        cursor: pointer;
        height: 45px;
        padding-top: 3px;
    }
    
    .msg-profile {
         width: 45px;
         height: 45px;
         border-radius: 5px;
         margin-right: 10px;
    }
    
    .msg-time {
        margin-top: 5px;
        margin-left: 10px;
        color: gray;
        font-size: 10px;
        float: right;
    }
    
    .msg-active {
        background-color: whitesmoke;
    }
</style>
</head>
<body onclick="event_handler(event)">
    <?php include 'include/body/header.php'; ?>
    <?php include 'include/body/search.php'; ?>
    <?php include 'include/body/side-menu.php'; ?>

    <div class="has-side-header">
        <div class="container-hr" style="padding: 0;">
            <div class="msg-container">
                <div class="row">
                    <div class="col-md-3 left">
                        <?php
                            $listOutput = NULL;
                            foreach ($data['list_data'] as $value) {
                                if ($data['active_username'] === $value['username']) {
                                    echo '
                                    <a href="/messages/'. $value['username'] .'">
                                        <div class="row msg msg-active">
                                            <img src="/public/images/profile-pic.png" class="msg-profile">
                                            '. ucwords($value['first_name']) . ' ' . ucwords($value['last_name']) . '
                                        </div>
                                    </a>
                                    ';
                                    continue;
                                }
                                $listOutput .= '
                                    <a href="/messages/'. $value['username'] .'">
                                        <div class="row msg">
                                            <img src="/public/images/profile-pic.png" class="msg-profile">
                                            '. ucwords($value['first_name']) . ' ' . ucwords($value['last_name']) . '
                                        </div>
                                    </a>
                                ';
                            }
                            echo $listOutput;
                        ?>
                    </div>
                    <div class="col-md-9">
                        <div class="row right">
                        <div class="right-middle" id="msgs">
                        </div>
                        <div class="right-bottom">
                                <div class="col-md-11">
                                    <input type="text" id="msg" name="msg" class="form-field msg-field" placeholder="Type a message...">
                                </div>
                                <div class="col-md-1 send-icon">
                                    <button class="btn btn-primary" id="send-btn"><i class="fa fa-send"></i></button>
                                </div>
                            </div>
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
<script type="text/javascript">
    <?php
        if (!empty($data['recipient'])) {
            echo '
                request = true;
                recipient = "'.$data['recipient'].'";
                token = "'.$data['token'].'";
            ';
        } else {
            echo 'request = false;';
        }
    ?>
</script>
<script type="text/javascript" src="/public/js/ajax/messages.js"></script>

</html>