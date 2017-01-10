$(document).ready(function() {
    $('#search').on('input', function(data) {
        var value = data.target.value
        search(value)
    })

    function search(value) {
        var request = $.ajax({
            url: '/ajax/search/',
            method: 'POST',
            data: { 'username': value, 'token': token },
            dataType: 'json'
        })

        request.done(function(data) {
            $('#search-content').html('')
            if (!data.errors) {
                data.forEach(function(element) {
                    $('#search-content').append('<div class="search-results"><a href="/profile/' + element.username + '"><img class="img-thumb-sm" src="' + element.profile_pic + '"> &nbsp' + element.username + '</a></div>')
                })
            }
        })

        request.fail(function(jqxhr, textStatus, error) {
            var err = textStatus + ', ' + error
            console.log('Request Failed: ' + err)
        })
    }

    $("#search").click(function() {
        $('#search-area').show()
    })

    $("#search-close").click(function() {
        $('#search-area').hide()
    })
})