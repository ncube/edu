<!DOCTYPE html>
<html ng-app="index">

<head>
  <title><?=$title?></title>
  <script src="/public/bower_components/angular/angular.min.js"></script>
  <script src="/public/views/app.js"></script>
  <script src="/public/views/controllers/controllers.js"></script>
  <?=Core::loadCss(['common'])?>
</head>

<body ng-keydown="keyController($event)" ng-controller="main">

  <div class="init-flex">
    <section ng-controller="header" ng-include="template.header"></section>
      <div class="flex-container">
        <?php include 'include/side-menu.php'; ?>

          <div class="flex-column-fluid" style="padding: 10px; overflow: hidden;">
            <div class="container-fluid" style="width: 100%;">
              <?=Core::loadContent('-main-', $data, $url)?>
            </div>

          </div>
      </div>
  </div>

</body>
<script>
  var token = '<?=$data['token']?>';
</script>
<?=Core::loadJsBottom(['common'])?>

</html>