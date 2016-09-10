<!DOCTYPE html>
<html>

<head>
  <title>
    <?=$data['title']?>
  </title>
  <link rel="stylesheet" type="text/css" href="/public/css/ncube-ui.min.css">
</head>

<style>
  .errors {
    color: red;
  }
</style>

<body>

  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <h3 class="login-head" style="margin-top:100px ;color:darkslategray"><img src="http://www.ncubeschool.org/beta/images/logo.svg" alt="ncubelogo">Ncube School Of Knowledge</h3></div>
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <?php
              if (!empty($data['errors'])) {
                  foreach ($data['errors'] as $value) {
                      echo '<p class="errors">';
                      echo $value;
                      echo '</p>';
                      
                  }
              }
            ?>
            <div class="card card-inverse" style="background-color: #f7f7f7">
              <h5 class="card-header" style="background-color: #D1CDCD ">Login</h5>
              <div class="card-block">
                <form method="post" action="<?=$data['loginAction']?>">
                  <div class="form-group">
                    <input type="username" class="form-control form-control-md" placeholder="Username" name="username">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-red form-control-md " placeholder="Password" name="password">
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="token" value="<?=$data['token']?>">
                    <button type="submit" class="btn btn-secondary btn-success pull-xs-right">Log In</button>
                  </div>
                </form>
                <a href="/register" class="card-link" style="color:blue">Not a member? SignUp</a>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>