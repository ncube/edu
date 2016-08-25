if (token) {

    setInterval(function() {
        var request = $.ajax({
            url: '/ajax/notifications/',
            method: 'POST',
            data: { 'token': token },
            dataType: 'json'
        })
        request.done(function(notif) {
            displayNotif(notif);
        })
        request.fail(function(jqxhr, textStatus, error) {
            var err = textStatus + ', ' + error
            console.log('Request Failed: ' + err)
        })
    }, 5000)

    setInterval(function() {
        var request = $.ajax({
            url: '/ajax/msgnotifications/',
            method: 'POST',
            data: { 'token': token },
            dataType: 'json'
        })
        request.done(function(notif) {
            displayMsgNotif(notif);
        })
        request.fail(function(jqxhr, textStatus, error) {
            var err = textStatus + ', ' + error
            console.log('Request Failed: ' + err)
        })
    }, 5000)

}

function displayNotif(notif) {

    if (notif.count == 0) {
        $("#notif-count").hide();
    } else {
        $("#notif-count").css("display", "inline-block");
    }

    $("#notif-count").html(notif.count);
    $("#notif-count-inner").html(notif.count);

    $("#notif-container").html('');

    if (notif.data) {
        for (var value of notif.data) {
            var output = '<a href="' + value.link + '"><div class="not"><div class="row"><div class="col-xs-2"><img class="img-thumb-sm" src="' + value.profile_pic + '"></div><div class="col-xs-10 text-xs-left" style="font-size: 13px;"><b>' + value.first_name + ' ' + value.last_name + '</b><br> ' + value.msg + '<span style="margin-left: 5px; float: right; font-size: 11px">' + value.time + '</span></div></div></div></a>';
            $("#notif-container").append(output);
        }
    }
}

function displayMsgNotif(notif) {

    if (notif.count == 0) {
        $("#notif-msg-count").hide();
    } else {
        $("#notif-msg-count").css("display", "inline-block");
    }

    $("#notif-msg-count").html(notif.count);
    $("#notif-msg-count-inner").html(notif.count);

    $("#notif-msg-container").html('');

    if (notif.data) {
        for (var value of notif.data) {
            var output = '<a href="/messages/' + value.username + '"><div class="not"><div class="row"><div class="col-xs-2"><img class="img-thumb-sm" src="' + value.profile_pic + '"></div><div class="col-xs-10 text-xs-left" style="font-size: 13px;"><b>' + value.first_name + ' ' + value.last_name + '</b> sent you a message<span style="margin-left: 5px; float: right; font-size: 11px">' + value.time + '</span></div></div></div></a>';
            $("#notif-msg-container").append(output);
        }
    }
}