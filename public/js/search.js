$(document).ready(function () {
  $('#search').on('input', function (data) {
    var value = data.target.value
    search(value)
  })
  function search (value) {
    var request = $.ajax({
      url: '/ajax/ajaxsearch/',
      method: 'POST',
      data: {'username': value},
      dataType: 'json'
    })

    request.done(function (data) {
      $('#search-area').html('<div class="col-sm-2 col-sm-offset-10"><i class="fa fa-close" id="close"> Close</i></div>')
      if (!data.errors) {
        data.forEach(function (element) {
          $('#search-area').append('<div class="results"><a href="/profile/' + element.username + '">' + element.username + '</a></div>')
        })
      }
    })

    request.fail(function (jqxhr, textStatus, error) {
      var err = textStatus + ', ' + error
      console.log('Request Failed: ' + err)
    })
  }
})


// TODO: Use Jquery for event handler.

function resetMe () {
  search.style.width = ''
  icon.style.marginRight = ''
  searchArea.style.display = ''
}

function event_handler (event) {
  var id = event.target.id
  // var class_name = event.target.className
  // var tag_name = event.target.tagName

  search = document.getElementById('search')
  icon = document.getElementById('search-icon')
  searchArea = document.getElementById('search-area')

  document.onkeydown = function (evt) {
    evt = evt || window.event
    if (evt.keyCode == 27) {
      resetMe()
    }
  }

  if (id == 'close') {
    resetMe()
  }

  if (id == 'search') {
    search.style.width = '100%'
    icon.style.marginRight = '0'
    searchArea.style.display = 'block'
  } else {
    resetMe()
  }
}
