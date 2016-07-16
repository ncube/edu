if (token) {

    setInterval(function () {
        var request = $.ajax({
            url: '/ajax/notifications/',
            method: 'POST',
            data: { 'token': token },
            dataType: 'json'
        })
        request.done(function (notif) {
            displayNotif(notif);
        })
        request.fail(function (jqxhr, textStatus, error) {
            var err = textStatus + ', ' + error
            console.log('Request Failed: ' + err)
        })
    }, 5000)

    setInterval(function () {
        var request = $.ajax({
            url: '/ajax/msgnotifications/',
            method: 'POST',
            data: { 'token': token },
            dataType: 'json'
        })
        request.done(function (notif) {
            displayMsgNotif(notif);
        })
        request.fail(function (jqxhr, textStatus, error) {
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
            var output = '<a href="' + value.link + '"><div class="row notif-content"><div class="col-xs-2"><img class="notif-thumb" src="' + value.profile_pic + '"></div><div class="col-xs-10" style="font-size: 14px;"><b>' + value.first_name + ' ' + value.last_name + '</b> ' + value.msg + '<div class="notif-time"><span>' + value.time + '</span></div></div></div></a>';
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
            var output = '<a href="/messages/' + value.username + '"><div class="row notif-content"><div class="col-xs-2"><img class="notif-thumb" src="' + value.profile_pic + '"></div><div class="col-xs-10" style="font-size: 14px;"><b>' + value.first_name + ' ' + value.last_name + '</b> sent you a message<div class="notif-time"><span>' + value.time + '</span></div></div></div></a>';
            $("#notif-msg-container").append(output);
        }
    }
}