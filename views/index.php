<html>

<head>
    <title><?=$data['title']?></title>
    <link rel="stylesheet" type="text/css" href="/public/css/ncube-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/custom.css">
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
            </div>
        </div>

    <div class="container-hr has-side-header">                                
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    
                    
                    
                                        
                    
                    <h4>Requests</h4>
                    <table style="width: 30%">
                        <tr>
                            <td>From</td>
                            <td>Type</td>
                        </tr>
                        <?php
                        if(!empty($data['request'])) {
                            foreach ($data['request'] as $key => $value) {
                            ?>
                            <tr>
                                <td><?=$key?></td>
                                <td><?=$value?></td>
                                <td>
                                    <form method="post" action="/profile/<?=$key?>/accept">
                                    <input type="hidden" name="username" value="<?=$key?>">
                                    <input type="hidden" name="token" value="<?=$data['token']?>">
                                    <button type="submit" class="btn btn-primary">Accept</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                        }
                        ?>        
                    </table>
                    
                    
                    
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