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
              Home
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