<script type="text/javascript" src="/public/js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="/public/js/search.js"></script>

<script type="text/javascript" src="/public/js/notif.js"></script>
<script>
    var token = "<?=$data['token']?>";
</script>
<script type="text/javascript" src="/public/js/ajax/notif.js"></script>

<script>
      $("#side-menu-toggle").click(function(event) {
          $("#side-menu").toggle();
          $("#side-menu").toggleClass('hidden-sm-down display-flex');
      });

      $(document).ready(function() {
          function reset() {
              $("#search-area").hide();
              $("#notif-div").hide();
              $("#notif-msg-div").hide();
              $( "#search-input" ).blur();
          }

          $(document).keyup(function(e) {
              if (e.keyCode == 27) reset()
          });
      });
</script>