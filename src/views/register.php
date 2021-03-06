<!DOCTYPE html>
<html>

<head>
    <title>
        <?=$data['title']?>
    </title>
    <link rel="stylesheet" type="text/css" href="/public/css/ncube-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/public/bower_components/font-awesome/css/font-awesome.min.css">
</head>
</head>
<style>
    body {
        background-color: currentcolor;
    }
    
    .panel {
        background-color: white;
        border-radius: 7px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
        margin-top: 70px;
        overflow: hidden;
        height: 500px;
    }

    .panel-left {
        background-color: #75ea00;
        height: 100%;
        text-align: center;
        color: white;
    }

    @media(max-width: 720px) {
        .panel-left {
            height: 100px;
        }
    }

    @media(max-width: 720px) {
        .panel {
            height: auto;
        }
    }

    .errors {
        color: red;
    }

    .cogs {
        position: absolute;
        width: 150px;
        top: 80px;
        left: 30px;
    }

    .dna {
        position: absolute;
        width: 150px;
        top: 80px;
        right: 30px;
    }

    .atom {
        position: absolute;
        width: 150px;
        top: 250px;
        left: 30px;
    }

    .flask {
        position: absolute;
        width: 150px;
        top: 250px;
        right: 30px;
    }

    .ic {
        position: absolute;
        width: 150px;
        top: 450px;
        left: 30px;
    }

    .code {
        position: absolute;
        width: 150px;
        top: 450px;
        right: 30px;
    }

    .form-control {
        border-radius:0px;
    }

    .card-link {
        font-size: 15px;
        color: darkslategray;
    }
</style>

<body>
    <section class="hidden-sm-down">
        <img class="flask" src="/public/images/bg/flask.svg">
        <img class="dna" src="/public/images/bg/dna.svg">
        <img class="atom" src="/public/images/bg/atom.svg">
        <img class="ic" src="/public/images/bg/ic.svg">
        <img class="cogs" src="/public/images/bg/cogs.svg">
        <img class="code" src="/public/images/bg/code.svg">
    </section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-xs-10 col-md-offset-2 col-xs-offset-1">
                <div class="row panel">
                    <div class="col-md-4 col-sm-12 panel-left">
                        <img src="/public/images/logo-white.png" class="hidden-sm-down" style="width: 170px; margin-top: 30px;">
                        <h2 style="margin-top: 10px;">NCube</h2>
                        <br>
                        <p class="hidden-sm-down"><i class="fa fa-circle"></i> Ask Questions</p>
                    </div>
                    <div class="col-md-8 col-xs-12" style="padding: 50px; padding-top: 30px;">
                        <h3 style="color: dimgrey; margin-top: 60px;"><strong>Register</strong></h3>
                        <?php
                            if (!empty($data['errors'])) {
                                foreach ($data['errors'] as $value) {
                                    echo '<a class="errors">';
                                    echo $value;
                                    echo '<br>';
                                    echo '</a>';
                                }
                            }
                        ?>
                        <br>
                        <form action="/register" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="First Name" name="first_name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="username" class="form-control" placeholder="Username" name="username" required>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="password" class="form-control" placeholder="Re-Enter Password" name="password_again" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email" name="email" required>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="token" value="<?=$data['token']?>">
                                <button type="submit" class="btn btn-warning pull-md-right">Register</button>
                            </div>
                        </form>
                        <br>
                        <a href="/login" class="card-link">Already a member? Login</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3" style="margin-top: 15px; text-align: center; color: white;">
                &#169; ncubeschool.org | About Us | Open Source | Developers | Privacy
            </div>
        </div>
    </div>
</body>

</html>