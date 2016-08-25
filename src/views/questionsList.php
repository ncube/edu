<!DOCTYPE html>
<html>

<head>
    <?php include 'include/head/common.php';?>
</head>

<body>
    
    

    <div class="init-flex">
    <?php include 'include/body/header.php'; ?>
    <div class="flex-container">
    <?php include 'include/body/side-menu.php'; ?>

    <div class="flex-column-fluid">
        <div class="container-hr-fluid">            
            <a href="/questions/create" class="btn">Ask Question</a>
            <?php
                if (!empty($data['questions'])) {
                    foreach ($data['questions'] as $value) {
                        echo '
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-block">                                        
                                        <a href="/questions/'.$value['q_id'].'" style="color: inherit; text-decoration: none;"><h5><strong>'.$value['title'].'</strong></h5></a>
                                        <p>
                                            '.$value['content'].'
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="pull-left" style="padding: 10px; font-size: 17px;">
                                                    <i class="fa fa-caret-up voteup '.$value['my_data']['vote_up_class'].'" id="'.$value['q_id'].'up'.'"></i> '.$value['up_count'].' &nbsp
                                                    <i class="fa fa-caret-down votedown '.$value['my_data']['vote_down_class'].'" id="'.$value['q_id'].'down'.'"></i> '.$value['down_count'].' &nbsp
                                                    <i class="fa fa-comments"></i> '.$value['answers'].' &nbsp
                                                    <i class="fa fa-eye"></i> '.$value['views'].' &nbsp
                                                    ';
                                                    
                                                    echo '
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <img src="'.$value['pic'].'" alt="@'.$value['username'].'" class="img-thumb-sm pull-right">
                                            </div>
                                            <div class="col-md-3">
                                                <div class="post-head">
                                                    <a href="/profile/'.$value['username'].'"><b>'.ucwords($value['user_data']['first_name']).' '.ucwords($value['user_data']['last_name']).'</b></a>
                                                    <br>
                                                    <span class="time">'.date('h:m:s d', $value['time']).'</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }
            ?>
        </div>
    </div>

</body>

<?php include 'include/js/common.php'; ?>

<script>
    var username = "<?=$data['profile_data']['username']?>";
</script>


</html>