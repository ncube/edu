<html>

<head>
    <title><?=$data['title']?></title>
    <link rel="stylesheet" type="text/css" href="/public/css/ncube-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/custom.css">
    <link rel="stylesheet" type="text/css" href="/public/css/widgets/posts.css">
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
                        <form method="post" action="/profile/post/">
                            <textarea class="form-field post-field" placeholder="Type here to post" name="post_data"></textarea>
                            <input type="hidden" value="<?=$data['token']?>" name="token">
                            <input type="submit" value="Post" class="btn btn-primary" style="margin-top: 5px; float: right">
                        </form>
                    </div>
                    <div class="row">
                        <?php
                            if (!empty($data['feed'])) {
                                foreach ($data['feed'] as $value) {
                                    include 'include/body/widgets/post.php';
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
<script type="text/javascript" src="/public/js/notif.js"></script>
<script>
    var token = "<?=$data['token']?>";
</script>
<script type="text/javascript" src="/public/js/ajax/notif.js"></script>
<script>
    function toggleCmnt(id) {
        $("#"+id).toggle();
    }
    $(".comment").click(function (event) {
        var id = event.currentTarget.parentElement.parentElement.parentElement.parentElement.children[4].id;
        toggleCmnt(id);
    });
</script>
</html>