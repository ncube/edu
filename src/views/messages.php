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

          <div class="flex-column-fluid" style="padding: 10px; overflow: hidden;">
            <div class="container-fluid" style="width: 100%;">
              <div class="card" style="height: 100%;">
                <div class="con" style="height: 100%;">
                  <div class="col-xs-3 p-0">
                    <?php
                      // TODO: Move to Model 
                      $listOutput = NULL;
                      foreach ($data['list_data'] as $value) {
                          if ($data['active_username'] === $value['username']) {
                              echo '
                              <a href="/messages/'. $value['username'] .'">
                              <div class="msg msg-active">
                              <img src="/public/images/profile-pic.png" class="img-thumb-sm">
                              '. ucwords($value['first_name']) . ' ' . ucwords($value['last_name']) . '
                              </div>
                              </a>
                              ';
                              continue;
                          }
                          $listOutput .= '
                          <a href="/messages/'. $value['username'] .'">
                          <div class="msg">
                          <img src="/public/images/profile-pic.png" class="img-thumb-sm">
                          '. ucwords($value['first_name']) . ' ' . ucwords($value['last_name']) . '
                          </div>
                          </a>
                          ';
                      }
                      echo $listOutput;
                    ?>
                  </div>
                  <div class="col-xs-12 s-con bor p-0">
                    <div class="stretch">
                      <div class="msg-container" id="msgs">
                      </div>
                    </div>
                    <div style="padding: 10px;">
                      <div class="col-xs-10" style="padding: 0;">
                        <input type="text" id="msg" name="msg" class="form-control form-control-sm" placeholder="Type your message here...">
                      </div>
                      <div class="col-xs-2">
                        <button type="submit" id="send-btn" class="btn btn-success btn-sm"><i class="fa fa-send"></i> Send</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
  </div>
</body>

<?php include 'include/js/common.html'; ?>
<script type="text/javascript">
  token = "<?=$data['token']?>";
</script>
<script type="text/javascript">
  <?php
    if (!empty($data['recipient'])) {
        echo '
        request = true;
        recipient = "'.$data['recipient'].'";
        ';
    } else {
        echo 'request = false;';
    }
  ?>
</script>
<script type="text/javascript" src="/public/js/ajax/messages.js"></script>

</html>