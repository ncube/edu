<?php
if($GLOBALS['url'] === 'questions/create') {
    echo 'Under Construction';
} else {
?>
<div class="container-hr-fluid">
    <div class="col-lg-6 col-md-12">
        <a href="/questions/<?=$data['question']['q_id']?>/answer">Answer</a>
        <div class="card">
            <div style="padding-top: 20px; padding-left: 25px; padding-bottom: 10px; border-bottom: 1px solid lightgray;">
                <div class="row">
                    <div class="col-md-1 p-0">
                        <img ng-src="<?=$data['q_user']['profile_pic']?>" alt="@" class="img-thumb-sm pull-right">
                    </div>
                    <div class="col-md-11">
                        <div class="post-head">
                            <a href="/profile/"><b class="ng-binding"><?=$data['q_user']['first_name']?> <?=$data['q_user']['last_name']?></b></a>
                            <br>
                            <span class="time ng-binding"><?=$data['question']['time']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-block">
                <div class="q-name">
                    <a><?=$data['question']['title']?></a>
                </div>
                <div class="q-desp">
                    <?=$data['question']['content']?>                            
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left" style="padding: 10px; font-size: 17px;" id="{{item.q_id}}">
                            <i class="fa fa-caret-up voteup {{item.my_data.vote_up_class}}"></i> <?=$data['question']['up_count']?> &nbsp
                            <i class="fa fa-comments"></i> <?=$data['question']['answers_count']?> &nbsp
                            <i class="fa fa-eye"></i> <?=$data['question']['views']?> &nbsp
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <h5 style="color: gray; text-align: center;">Answers</h5>
    </div>
    <div class="col-lg-6 col-md-12">
        <?php
            foreach($data['answers'] as $value) {
        ?>
        <div class="card">
            <div style="padding-top: 20px; padding-left: 25px; padding-bottom: 10px; border-bottom: 1px solid lightgray;">
                <div class="row">
                    <div class="col-md-1 p-0">
                        <img ng-src="<?=$value['user']['profile_pic']?>" alt="@" class="img-thumb-sm pull-right">
                    </div>
                    <div class="col-md-11">
                        <div class="post-head">
                            <a href="/profile/<?=$value['user']['username']?>"><b class="ng-binding"><?=$value['user']['first_name']?> <?=$value['user']['last_name']?></b></a>
                            <br>
                            <span class="time ng-binding"><?=$value['time']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-block">
                <div class="q-desp">
                    <?=$value['content']?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<?php
}