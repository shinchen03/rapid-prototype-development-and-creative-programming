 function newevent(){
    var title = $("#title").val() + "";
    var date = $("#date").text() + "";
    var time = $("#time").val() + ':00';
    var tag = $("#tag").val() + "";
    var group = $("#group").val() + "";
    $.post(
        "createEvent.php",
        {token:token, title:title, date:date, time:time, tag:tag},
	 function(msg){
            if (msg.success) {
                $("#create_event_view" ).dialog("close");
                generateCalendar();
            }else{
                alert("Sorry: " + msg.message);
            }
        },"json");
    //Create new event to a group of users
    if (group !== "") {
        var users = $("#group").val().split(',');
        for (var i = 0; i < users.length; i++) {
            $.post("createEvent.php",
                {token:token, username:users[i], title:title, date:date, time:time, tag:tag},
                function(msg){
                    if (msg.success) {
                        alert("insert succeed");
                    }else{
                        alert("Sorry:" + msg.message);
                    }
                },"json");
        }
    }
}