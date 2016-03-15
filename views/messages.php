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
        padding-right: 219px;
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
    <div class="side-container">
        <div class="side-header">
            <div class="side-title"><strong><?=$data['first_name']?> <?=$data['last_name']?></strong></div>
            <a href="/profile"><div class="side-items">Profile</div></a>
            <a href="/messages"><div class="side-items">Messages</div></a>
        </div>
    </div>
    <div class="container-hr has-side-header" style="padding: 0;">
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
    <?php include 'include/body/footer.php'; ?>
</body>
<script type="text/javascript" src="/public/js/jquery-2.2.1.min.js"></script>
<script type="text/javascript">

    function resetMe() {
        search.style.width = '';
        icon.style.marginRight = '';
        searchArea.style.display = '';
    }

    function event_handler(event) {
        var id = event.target.id;
        // var class_name = event.target.className;
        // var tag_name = event.target.tagName;

        search = document.getElementById('search');
        icon = document.getElementById('search-icon');
        searchArea = document.getElementById('search-area');

        document.onkeydown = function(evt) {
            evt = evt || window.event;
            if (evt.keyCode == 27) {
                resetMe();
            }
        };

        if (id == 'close') {
            resetMe();
        }

        if (id == 'search') {
            search.style.width = '100%';
            icon.style.marginRight = '0';
            searchArea.style.display = 'block';
        } else {
            resetMe();
        }
    }
    
    <?php if (!empty($data['recipient'])) {?>
        setInterval(function () {
            
            var request = $.ajax({
                url: "http://ncube/api/messages/",
                method: "POST",
                data: {"username" : "<?=$data['recipient']?>", "token": "<?=$data['token']?>"},
                dataType: "json"
            });
            request.done(function( msg ) {
                var msgs = msg.msgs;
                display(msgs);
                
                // Scroll to Bottom
                $('#msgs').scrollTop($('#msgs')[0].scrollHeight);
            });
            request.fail(function( jqxhr, textStatus, error ) {
                var err = textStatus + ", " + error;
                console.log( "Request Failed: " + err );
            });
        },3000);
    <?php } ?>
        
    function display(msgs) {
        $("#msgs").html('');
        if (msgs) {
            for (var value of msgs) {
                if (value.type === 'sent') {
                    var output1 = '<div class="row"><div class="col-md-12"><div class="msg-sent">' + value.msg + '<div class="msg-time">' + value.time + '</div></div></div>';
                    $("#msgs").append(output1);
                } else if (value.type === 'received') {
                    var output2 = '<div class="row"><div class="col-md-12"><div class="msg-received">' + value.msg + '<div class="msg-time">' + value.time + '</div></div></div>';
                    $("#msgs").append(output2);
                }
            }
        }
    }
    
    $("#send-btn").click(function () {
        msg = $("#msg").val();
        $("#msg").val("");
        var send = $.ajax({
                url: "http://ncube/api/messages/send/",
                method: "POST",
                data: {"username" : "<?=$data['recipient']?>", "token": "<?=$data['token']?>", "msg" : msg},
                dataType: "json"
            });
            
            send.done(function( msg ) {
                
                // Scroll to Bottom
                $('#msgs').scrollTop($('#msgs')[0].scrollHeight);
            });
            send.fail(function( jqxhr, textStatus, error ) {
                var err = textStatus + ", " + error;
                console.log( "Request Failed: " + err );
            });
        
    });
</script>

</html>