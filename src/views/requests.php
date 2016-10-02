<!DOCTYPE html>
<html ng-app="index">

<head>
  <script src="/public/js/angular/angular.min.js"></script>
  <script src="/public/views/app.js"></script>
  <script src="/public/views/controllers/controllers.js"></script>
  <?php include 'include/head/common.php'; ?>
</head>

<body ng-keydown="keyController($event)" ng-controller="main">

  <div class="init-flex">
    <section ng-controller="header" ng-include="template.header"></section>
      <div class="flex-container">
        <?php include 'include/body/side-menu.php'; ?>

          <div class="flex-column-fluid">
            <div class="container-hr-fluid">
              <?php
                foreach($data['requests'] as $value) {
                    echo '
                    <div class="card card-block col-md-4">
                        <div class="col-md-8">
                            <div class="col-md-2">
                                <img class="img-thumb-sm" src="'.$value['user_data']['profile_pic'].'" />
                            </div>
                            <div class="col-md-10">
                                <a href="/profile/'.$value['user_data']['username'].'" style="color: black">'.ucwords($value['user_data']['first_name']).' '.ucwords($value['user_data']['last_name']).'</a>
                                <a>wants to add you as '.$value['type'].'</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-secondary">Accept</button>
                            <button type="submit" class="btn btn-secondary">Reject</button>
                        </div>
                    </div>
                    ';
                }
            ?>
            </div>

          </div>
      </div>
  </div>

</body>

<script>
  var token = '<?=$data['token']?>';
</script>

<?php include 'include/js/common.html'; ?>

</html>