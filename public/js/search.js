$(document).ready(function () {
  $('#search').on('input', function (data) {
    var value = data.target.value;
    search(value);
  });
  function search (value) {
    var request = $.ajax({
      url: '/api/ajaxsearch/',
      method: 'POST',
      data: {'username': value},
      dataType: 'json'
    });

    request.done(function (data) {
        $("#search-area").html('');
        if (!data.errors) {
            data.forEach(function(element) {
                $("#search-area").append('<div class="results"><a href="/profile/'+element.username+'">'+element.username+'</a></div>');
            });
        }
    });

    request.fail(function (jqxhr, textStatus, error) {
      var err = textStatus + ', ' + error;
      console.log('Request Failed: ' + err);
    });
  }
});
