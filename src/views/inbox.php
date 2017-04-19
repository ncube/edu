<div class="card" style="height: 100%;">
  <div class="con" style="height: 100%;">
    <div class="col-xs-3 p-0" style="overflow-y: auto;">
      <?php
        // TODO: Move to Model 
        $listOutput = NULL;
        foreach ($data['list_data'] as $value) {
            if ($data['active_username'] === $value['username']) {
                echo '
                <a href="/inbox/'. $value['username'] .'">
                <div class="msg msg-active">
                <img src="/data/images/profile/35/'.$value['profile_pic'].'.jpg" class="img-thumb-sm">
                '. ucwords($value['first_name']) . ' ' . ucwords($value['last_name']) . '
                </div>
                </a>
                ';
                continue;
            }
            $listOutput .= '
            <a href="/inbox/'. $value['username'] .'">
            <div class="msg">
            <img src="/data/images/profile/35/'.$value['profile_pic'].'.jpg" class="img-thumb-sm">
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