function voteUp(id) {
    var send = $.ajax({
        url: "/ajax/voteup",
        method: "POST",
        data: { "q_id": id, "token": token },
        dataType: "json"
    });

    send.done(function (msg) {
        $('#' + id + 'up').addClass('vote-up-active');
        $('#' + id + 'down').removeClass('vote-down-active');
    });
    send.fail(function (jqxhr, textStatus, error) {
        var err = textStatus + ", " + error;
        console.log("Request Failed: " + err);
    });
}

function voteDown(id) {
    var send = $.ajax({
        url: "/ajax/votedown",
        method: "POST",
        data: { "q_id": id, "token": token },
        dataType: "json"
    });

    send.done(function (msg) {
        $('#' + id + 'down').addClass('vote-down-active');
        $('#' + id + 'up').removeClass('vote-up-active');
    });
    send.fail(function (jqxhr, textStatus, error) {
        var err = textStatus + ", " + error;
        console.log("Request Failed: " + err);
    });
}

function unVote(id) {
    var send = $.ajax({
        url: "/ajax/unvote",
        method: "POST",
        data: { "q_id": id, "token": token },
        dataType: "json"
    });

    send.done(function (msg) {
        $('#' + id + 'up').removeClass('vote-up-active');
        $('#' + id + 'down').removeClass('vote-down-active');
    });
    send.fail(function (jqxhr, textStatus, error) {
        var err = textStatus + ", " + error;
        console.log("Request Failed: " + err);
    });
}

$(".voteup").click(function (event) {
    var id = event.currentTarget.parentElement.parentElement.attributes.id.value;
    var status = $.inArray('vote-up-active', $('#' + id + 'up')[0].classList);

    if (status === -1) {
        voteUp(id);
    } else {
        unVote(id);
    }
});

$(".votedown").click(function (event) {
    var id = event.currentTarget.parentElement.parentElement.attributes.id.value;
    var status = $.inArray('vote-down-active', $('#' + id + 'down')[0].classList);

    if (status === -1) {
        voteDown(id);
    } else {
        unVote(id);
    }
});