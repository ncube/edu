<html>

<head>
    <title><?=$data['title']?></title>
    <link rel="stylesheet" type="text/css" href="/public/css/ncube-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/custom.css">
    <style>
        .post-field {
            min-width: 100%;
            max-width: 100%;
            height: 70px;
        }
    </style>
</head>

<body onclick="event_handler(event)">
    
    <?php include 'include/body/header.php'; ?>
    <?php include 'include/body/search.php'; ?>           
    
    <div class="side-container">
            <div class="side-header">
                <div class="row">
                <div class="side-title"><strong><?=$data['first_name']?> <?=$data['last_name']?></strong></div>
                </div>
                    <br>
                    <a href="/profile">
                        <div class="side-items">
                            Profile
                        </div>
                    </a>
                    <a href="/messages">
                        <div class="side-items">
                            Messages
                        </div>
                    </a>
                    <a href="/settings">
                        <div class="side-items">
                            Settings
                        </div>
                    </a>
            </div>
    </div>

    <div class="container-hr has-side-header">                                
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    
                    <!--<div class="post-div">-->
                        <form method="post" action="/profile/post/">
                            <textarea class="form-field post-field" placeholder="Type here to post" name="post_data"></textarea>
                            <input type="hidden" value="<?=$data['token']?>" name="token">
                            <input type="submit" value="Post" class="btn btn-primary" style="margin-top: 5px; float: right">
                        </form>
                    <!--</div>-->
                    
                                        
                    
                    
                    
                    
                    <!--<h4>Requests</h4>
                    <table style="width: 30%">
                        <tr>
                            <td>From</td>
                            <td>Type</td>
                        </tr>-->
                        <?php
                        if(!empty($data['request'])) {
                            foreach ($data['request'] as $key => $value) {
                            ?>
                            <!--<tr>
                                <td><?=$key?></td>
                                <td><?=$value?></td>
                                <td>
                                    <form method="post" action="/profile/<?=$key?>/accept">
                                    <input type="hidden" name="username" value="<?=$key?>">
                                    <input type="hidden" name="token" value="<?=$data['token']?>">
                                    <button type="submit" class="btn btn-primary">Accept</button>
                                    </form>
                                </td>
                            </tr>-->
                        <?php
                        }
                        }
                        ?>        
                    <!--</table>-->
                    
                    
                    
                    
                    
                    
                </div>
                <div class="row">
                    <?php
                        foreach ($data['feed'] as $value) {
                            echo '
                                <div class="col-xs-12">
                                    <div class="col-md-12 post">
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4 post-head">
                                                <img   class="profile_pic">
                                                <img class="post-thumb" src="'.$value['profile_pic'].'" alt="@'.$value['username'].'"/>
                                                <b>&nbsp @'.$value['username'].'</b>
                                            </div>
                                            <div class="col-md-3 post-time">
                                                '.date("d M h:i A", $value['time']).'
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 15px;">
                                            <hr>
                                            <div class="col-md-12">
                                                '.$value['post_data'].'
                                            </div>
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
    <?php include 'include/body/footer.php'; ?>
</body>
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
</script>

</html>