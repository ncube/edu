var notif_toggle = 0;
var notif_msg_toggle = 0;
$("#notif").click(function () {
    notif_msg_toggle = 1;
    $("#notif-div").toggle();
    if (notif_toggle) {
        $("#notif-msg-div").hide();
    }
});

$("#notif-msg").click(function () {
    notif_toggle = 1;
    $("#notif-msg-div").toggle();
    if (notif_msg_toggle) {
        $("#notif-div").hide();
    }
});