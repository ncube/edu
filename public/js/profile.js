function follow () {
  var request = $.ajax({
    url: '/ajax/follow/',
    method: 'POST',
    data: {'username': username, 'token': token},
    dataType: 'json'
  })
  request.done(function (msg) {
    if (msg.success) {
      $('#follow-btn').html('<a class="btn btn-error m-t-20" id="unfollow"><i class="fa fa-times"></i> Unfollow</a>')
    }
    console.log(msg.errors)
  })
  request.fail(function (jqxhr, textStatus, error) {
    var err = textStatus + ', ' + error
    console.log('Request Failed: ' + err)
  })
}

function unFollow () {
  var request = $.ajax({
    url: '/ajax/unfollow/',
    method: 'POST',
    data: {'username': username, 'token': token},
    dataType: 'json'
  })
  request.done(function (msg) {
    if (msg.success) {
      $('#follow-btn').html('<a class="btn btn-success m-t-20" id="follow"><i class="fa fa-check"></i> Follow</a>')
    }
    console.log(msg.errors)
  })
  request.fail(function (jqxhr, textStatus, error) {
    var err = textStatus + ', ' + error
    console.log('Request Failed: ' + err)
  })
}
