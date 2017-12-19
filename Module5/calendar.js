var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var monthnumber=["01","02","03","04","05","06","07","08","09","10","11","12"];
var daynumber=["00","01","02","03","04","05","06","07","08","09"];
var currentMonth = new Month(2017,1);
var monthnum="global";
var y="global";
var eventdate="global";
var eventid="global";
var eventtitle="global";
updatecalendar();
document.getElementById("logout").addEventListener("click", function(){
        updatecalendar();
}, false);
document.getElementById("login").addEventListener("click", function(){
        updatecalendar();
}, false);


document.getElementById("next_month_btn").addEventListener("click", function(event){
        currentMonth = currentMonth.nextMonth(); // Previous month would be currentMonth.prevMonth()
        updatecalendar(); // Whenever the month is updated, we'll need to re-render the calendar in HTML
        //alert("The new month is "+currentMonth.month+" "+currentMonth.year);
}, false);
document.getElementById("prev_month_btn").addEventListener("click", function(event){
        currentMonth = currentMonth.prevMonth(); // Previous month would be currentMonth.prevMonth()
        updatecalendar(); // Whenever the month is updated, we'll need to re-render the calendar in HTML
        //alert("The new month is "+currentMonth.month+" "+currentMonth.year);
}, false);

// This updateCalendar() function only alerts the dates in the currently specified month.  You need to write
// it to modify the DOM (optionally using jQuery) to display the days and weeks in the current month.
function updatecalendar(){
        document.getElementById("days").innerHTML="";
        var month = currentMonth.month;
        var m = monthNames[month];
        y = currentMonth.year;
        var weeks = currentMonth.getWeeks();
	monthnum = monthnumber[month];
    document.getElementById("current-month").innerHTML=m+' '+y;
        var count = 0;
        for(var w in weeks){
                var days = weeks[w].getDates();
                // days contains normal JavaScript Date objects.
                for(var d in days){
                        // You can see console.log() output in your JavaScript debugging tool, like Firebug,
                        // WebWit Inspector, or Dragonfly.

                        var myRe = /[\d]{2}/;
                        var myArray = myRe.exec(days[d]);
                        if(count<6){
                                if((myArray[0])>20){
                                        document.getElementById("days").innerHTML+="<li><p><span class='low'>"+myArray[0]+"</span></p></li>";
                                }
                                else{
                                        document.getElementById("days").innerHTML+="<li><p id='"+y+"-"+monthnum+"-"+myArray[0]+"'>"+myArray[0]+"</p></li>";
                                }
                        }else
                        if(count>28){
                                if((myArray[0])<10){
                                        document.getElementById("days").innerHTML+="<li><p><span class='low'>"+myArray[0]+"</span></p></li>";
                                }
                                else{
                                document.getElementById("days").innerHTML+="<li><p id='"+y+"-"+monthnum+"-"+myArray[0]+"'>"+myArray[0]+"</p></li>";
                                }
                        }
                        else{
                        document.getElementById("days").innerHTML+="<li><p id='"+y+"-"+monthnum+"-"+myArray[0]+"'>"+myArray[0]+"</p></li>";
                        }
                        //document.getElementById("days").innerHTML+="<li>" + d + "</li>";
                        //console.log(days[d].toISOString());
                        count++;
                }
        }
        //add event to the calendar                
                var dataString = "displayevent=1";
                var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
                xmlHttp.open("POST", "displayevent.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
                xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
                xmlHttp.addEventListener("load", function(event){
                    var jsonData = JSON.parse(event.target.responseText);
                    var count=jsonData.count;
                    jsonData=jsonData.eventdata;
                    for(var i=0;i<count;i++){
                    eventtitle = jsonData[i].title;
                    eventid = jsonData[i].id;
                    eventdate = jsonData[i].date;
                    
                    //eventdate = jsonData.date;
                    console.log(eventdate);
                    document.getElementById(eventdate).innerHTML+="<p id=event"+eventid+">"+eventtitle+"</p>";
                    document.getElementById("event"+eventid).addEventListener("click", editdialog, false);
                    document.getElementById("event"+eventid).addEventListener("click", editevent, false);
                 //   document.getElementById("event"+eventid).addEventListener("click",editdialog,false);
                    //alert(eventdate);
                    }
                }, false); // Bind the callback to the load event
                xmlHttp.send(dataString); // Send the data
                //alert(eventtitle);
                //document.getElementById(eventdate).innerHTML+="<p>"+eventtitle+"</p>";
          var a=[];      
        for(var i =0; i<40; i++){if(i<10){i=daynumber[i];}
        if(document.getElementById(y+"-"+monthnum+"-"+i)!==null){
        a[i]=y+"-"+monthnum+"-"+i;
        document.getElementById(y+"-"+monthnum+"-"+i).addEventListener("click",function eventdialog()
    {
      $("#mydialog").dialog();
      //document.getElementsByClassName("date")[0].innerHTML=y+"-"+monthnum+"-"+i;
      var eventID = event.target.id;
      document.getElementsByClassName("date")[0].innerHTML=eventID;
    },false);}
                        
                  }
                
}
        
        
///////////////edit event///////////////////////////////////////////////////////////////////////////
    
        function editdialog()
    {
      $("#editdialog").dialog();
      
    }

    
    
    
