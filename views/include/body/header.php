<div class="header">
    <a href="index.php"><img src="/public/images/logo.svg" id="logo" alt="Logo"></a>
    <a href="index.php"><h1 class="title" href="index.php">NCube</h1></a>
    <div class="col-xs-7" style="margin-left: 50px;">
        <input type="search" id="search" class=" search-field form form-field hidden-xs-down" placeholder="Search here..!"><i class="fa fa-search search-icon" id="search-icon"></i>
    </div>
    <?php
        if (Session::exists('user_id')) {?>
            <div class="header-icon">
                <form method="post" action="/logout">
                    <input type="hidden" value="<?=$data['token']?>" name="token">
                    <button type="submit" class="btn-reset"><i class="fa fa-sign-out"></i></button>
                </form>
            </div>
            <div class="header-icon">
                <button type="submit" class="btn-reset"><i class="fa fa-cog"></i></button>
            </div>
            <div class="header-icon">
                <button type="submit" class="btn-reset"><i class="fa fa-envelope"></i></button>
            </div>
            <div class="header-icon">
                <button type="submit" class="btn-reset"><i class="fa fa-bell" id="bell"></i></button>
            </div><?php
        } else {?>
            <div class="header-icon">
                <a href="/"><button class="btn btn-primary" style="margin-top: -8px;">Login</button></a>
            </div><?php
        } ?>
</div>