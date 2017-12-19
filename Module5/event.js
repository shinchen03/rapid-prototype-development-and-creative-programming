function newevent(){
                var username = document.getElementById("username").value;
                var location = document.getElementsByClassName("location")[0].value;
                var title = document.getElementsByClassName("title")[0].value;
                var date = document.getElementsByClassName("date")[0].innerHTML;
                var time = document.getElementsByClassName("time")[0].value;
                var description = document.getElementsByClassName("description")[0].value;
                var group = document.getElementsByClassName("group")[0].value;
                var dataString = "username=" + encodeURIComponent(username) + "&group=" + encodeURIComponent(group) + "&title=" + encodeURIComponent(title) + "&date=" + encodeURIComponent(date) + "&time=" + encodeURIComponent(time) + "&location=" + encodeURIComponent(location) + "&description=" + encodeURIComponent(description);
                var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
                xmlHttp.open("POST", "event.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
                xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
                xmlHttp.addEventListener("load", function(event){
                    var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
                    if(jsonData.success){
                        alert("event saved!");
                    }else{
                        alert("save event failed."+jsonData.message);
                    }
                }, false); // Bind the callback to the load event
                xmlHttp.send(dataString); // Send the data
            }

            function deleteevent(){
                var eventid = document.getElementsByClassName("editid")[0].innerHTML;
                // Make a URL-encoded string for passing POST data:
                var dataString = "eventid=" + encodeURIComponent(eventid) + "&deleteflag=1";
                var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
                xmlHttp.open("POST", "delete5.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
                xmlHttp.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
                xmlHttp.addEventListener("load", function(event){
                    var jsonData = JSON.parse(event.target.responseText);
                    if(jsonData.success){
                        alert("event deleted!");
                    }else{
                        alert("delete event failed."+jsonData.message);
                    }
                }, false);
                xmlHttp.send(dataString); // Send the data
            }
        document.getElementById("mydialog").getElementsByClassName("create")[0].addEventListener("click",newevent,false);
        document.getElementById("editdialog").getElementsByClassName("delete")[0].addEventListener("click",deleteevent,false);
        document.getElementById("editdialog").getElementsByClassName("edit")[0].addEventListener("click",rewriteevent,false);

        
        function editevent(){
                var eventid = event.target.id; // Get the username from the form
                var myRe = /[\d]/;
                eventid = myRe.exec(eventid);
                
                // Make a URL-encoded string for passing POST data:
                var dataString = "eventid=" + encodeURIComponent(eventid);
                var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
                xmlHttp.open("POST", "editevent.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
                xmlHttp.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
                xmlHttp.addEventListener("load", function(event){
                    var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
                    var count=jsonData.count;
                    jsonData=jsonData.editdata;
                    edittitle = jsonData[0].title;
                    editid = jsonData[0].id;
                    editdate = jsonData[0].date;
                    editlocation = jsonData[0].location;
                    edittime = jsonData[0].time;
                    editdescription = jsonData[0].description;
                    document.getElementsByClassName("editdate")[0].innerHTML=editdate;
                    document.getElementsByClassName("editlocation")[0].innerHTML=editlocation;
                    document.getElementsByClassName("editid")[0].innerHTML=editid;
                    document.getElementsByClassName("edittime")[0].innerHTML=edittime;
                    document.getElementsByClassName("editdescription")[0].innerHTML=editdescription;
                    document.getElementsByClassName("edittitle")[0].innerHTML=edittitle;
                    
                }, false); // Bind the callback to the load event
                xmlHttp.send(dataString); // Send the data
            }
            
            
            function rewriteevent(){
                var username = document.getElementById("username").value;
                var location = document.getElementsByClassName("editlocation")[0].value;
                var title = document.getElementsByClassName("edittitle")[0].value;
                var date = document.getElementsByClassName("editdate")[0].innerHTML;
                var time = document.getElementsByClassName("edittime")[0].value;
                var description = document.getElementsByClassName("editdescription")[0].value;
                var id = document.getElementsByClassName("editid")[0].innerHTML;
                var dataString = "username=" + encodeURIComponent(username) + "&id=" + encodeURIComponent(id) + "&title=" + encodeURIComponent(title) + "&date=" + encodeURIComponent(date) + "&time=" + encodeURIComponent(time) + "&location=" + encodeURIComponent(location) + "&description=" + encodeURIComponent(description);
                var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
                xmlHttp.open("POST", "rewriteevent.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
                xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
                xmlHttp.addEventListener("load", function(event){
                    var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
                    if(jsonData.success){
                        alert("event saved!");
                    }else{
                        alert("save event failed."+jsonData.message);
                    }
                }, false); // Bind the callback to the load event
                xmlHttp.send(dataString); // Send the data
            }
            
        
        
        