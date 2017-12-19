function hiddenlogin(){
                document.getElementById("username").style.display='none';
                document.getElementById("loginlabel").style.display='none';
                document.getElementById("password").style.display='none';
                document.getElementById("login").style.display='none';
  }
  function hiddenregister(){
                document.getElementById("registerUsername").style.display='none';
                document.getElementById("registerPassword").style.display='none';
                document.getElementById("registerlabel").style.display='none';
                document.getElementById("register").style.display='none';
  }
  function showall(){
                document.getElementById("username").style.display='';
                document.getElementById("password").style.display='';
                document.getElementById("login").style.display='';
                document.getElementById("registerUsername").style.display='';
                document.getElementById("registerPassword").style.display='';
                document.getElementById("register").style.display='';
                document.getElementById("registerlabel").style.display='';
                document.getElementById("loginlabel").style.display='';
  }
  function userLogin(){
                var username = document.getElementById("username").value;
                var password = document.getElementById("password").value;
                document.getElementById("username").value = "";
                document.getElementById("password").value = "";
                var dataString = "username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password);
                var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
                xmlHttp.open("POST", "login5.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
                xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
                xmlHttp.addEventListener("load", function(event){
                    var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
                    if(jsonData.success){
                        alert("Welcome!");
                        document.getElementById("user").innerHTML = "<p id='showusername'>Welcome " + username + "</p>";
                        hiddenlogin();
                        hiddenregister();
                    }else{
                        alert("Login failed."+jsonData.message);
                    }
                }, false); // Bind the callback to the load event
                xmlHttp.send(dataString); // Send the data
            }

            function userRegister(){
                var username = document.getElementById("registerUsername").value; // Get the username from the form
                var password = document.getElementById("registerPassword").value; // Get the password from the form
                 document.getElementById("username").value = "";
                document.getElementById("password").value = "";
                // Make a URL-encoded string for passing POST data:
                var dataString = "username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password);
                var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
                xmlHttp.open("POST", "register5.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
                xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
                xmlHttp.addEventListener("load", function(event){
                    var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
                    if(jsonData.success){  // in PHP, this was the "success" key in the associative array; in JavaScript, it's the .success property of jsonData
                        alert("You've been Registered! Please Log in!");
                        hiddenregister();
                    }else{
                        alert("You were not Registered."+jsonData.message);
                    }
                }, false); // Bind the callback to the load event
                xmlHttp.send(dataString); // Send the data
            }

            function userLogout(){
                var xmlHttp = new XMLHttpRequest();
                xmlHttp.open("POST", "logout.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
                xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xmlHttp.addEventListener("load", function(event){
                    var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
                    if(jsonData.success){  // in PHP, this was the "success" key in the associative array; in JavaScript, it's the .success property of jsonData
                        alert("Successfully Logout!");
                        document.getElementById("showusername").innerHTML = "";
                        showall();
                    }else{
                        alert("Fail to logout."+jsonData.message);
                    }
                }, false); // Bind the callback to the load event
                xmlHttp.send(); // Send the data
                showall();
        }
        document.getElementById("logout").addEventListener("click",userLogout,false);
        document.getElementById("login").addEventListener("click",userLogin,false);
        document.getElementById("register").addEventListener("click",userRegister,false);