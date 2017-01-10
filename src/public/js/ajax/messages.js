if (request) {
    setInterval(function() {
        var request = $.ajax({
            url: '/ajax/user/inbox/get',
            method: 'POST',
            data: { 'username': recipient, 'token': token },
            dataType: 'json'
        })
        request.done(function(msg) {
            var msgs = msg.msgs
            display(msgs)

            // Scroll to Bottom
            $('#msgs').scrollTop($('#msgs')[0].scrollHeight)
        })
        request.fail(function(jqxhr, textStatus, error) {
            var err = textStatus + ', ' + error
            console.log('Request Failed: ' + err)
        })
    }, 3000)
}

function display(msgs) {
    $('#msgs').html('')
    if (msgs) {
        for (var value of msgs) {
            if (value.type === 'sent') {
                var output1 = '<div class="row"><div class="col-md-12"><div class="msg-sent">' + value.msg + '<div class="msg-time">' + value.time + '</div></div></div>'
                $('#msgs').append(output1)
            } else if (value.type === 'received') {
                var output2 = '<div class="row"><div class="col-md-12"><div class="msg-received">' + value.msg + '<div class="msg-time">' + value.time + '</div></div></div>'
                $('#msgs').append(output2)
            }
        }
    }
}

$('#send-btn').click(function() {
    msg = $('#msg').val()
    $('#msg').val('')
    var send = $.ajax({
        url: '/ajax/user/inbox/send',
        method: 'POST',
        data: { 'username': recipient, 'token': token, 'msg': msg },
        dataType: 'json'
    })

    send.done(function(msg) {
        // Scroll to Bottom
        $('#msgs').scrollTop($('#msgs')[0].scrollHeight)
    })
    send.fail(function(jqxhr, textStatus, error) {
        var err = textStatus + ', ' + error
        console.log('Request Failed: ' + err)
    })

})