<div class="side-container">
    <div class="side-body">
        <div class="row">
            <div class="side-title">
                <img src="<?=$data['profile_pic']?>" class="side-profile-pic" />
                <strong><?=$data['first_name']?> <?=$data['last_name']?></strong>
            </div>
        </div>
        <a href="/">
            <div class="side-items<?=$data['side_active']['home']?>">
                <i class="fa fa-home" style="color: darkslategray">&nbsp</i> Home
            </div>
        </a>
        <a href="/profile">
            <div class="side-items<?=$data['side_active']['profile']?>">
                <i class="fa fa-user" style="color: darkslategray">&nbsp</i> Profile
            </div>
        </a>
        <a href="/messages">
            <div class="side-items<?=$data['side_active']['messages']?>">
                <i class="fa fa-envelope" style="color: darkslategray">&nbsp</i> Messages
            </div>
        </a>
        <a href="/groups">
            <div class="side-items<?=$data['side_active']['groups']?>">
                <i class="fa fa-group" style="color: darkslategray">&nbsp</i> Groups
            </div>
        </a>
        <a href="/questions">
            <div class="side-items<?=$data['side_active']['questions']?>">
                <i class="fa fa-question" style="color: darkslategray">&nbsp</i> Questions
            </div>
        </a>
        <a href="/settings">
            <div class="side-items<?=$data['side_active']['settings']?>">
                <i class="fa fa-cogs" style="color: darkslategray">&nbsp</i> Settings
            </div>
        </a>
    </div>
</div>