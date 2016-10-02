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
            <div ng-controller="questionsList" class="container-hr-fluid">            
                <a href="/questions/create" class="btn">Ask Question</a>

                   <div class="col-lg-6 col-md-12" ng-repeat="item in questions" ng-include="template.questions">
                    </div>
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