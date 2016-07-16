<div class="col-xs-10 stngs-content">
    <h4>General Settings</h4>
    <hr>
    <div class="row stngs-content-items">
        <div class="col-md-2 bold">
            Username:
        </div>
        <div class="col-md-8 green">
            http://www.ncubeschool.org/profile/<b><?=$data['username']?></b>
        </div>
    </div>

    <div class="row stngs-content-items">
        <div class="col-md-2 bold">
            Name:
        </div>
        <div class="col-md-8 green">
            <?=$data['first_name']?>
                <?=$data['last_name']?>
        </div>
    </div>

    <div class="row stngs-content-items">
        <div class="col-md-2 bold">
            Email:
        </div>
        <div class="col-md-8 green">
            <?=$data['email']?>
        </div>
    </div>

    <div class="row stngs-content-items">
        <div class="col-md-2 bold">
            Password:
        </div>
        <div class="col-md-8 green">
            last password changed over a year ago
        </div>
    </div>
    <p>Download my data / Delete Account</p>
</div>