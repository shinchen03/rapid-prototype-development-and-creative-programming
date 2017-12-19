//Require the packages we will use:
var http = require("http"),
socketio = require("socket.io"),
fs = require("fs");
 
var app = http.createServer(function(req, resp){ 
fs.readFile("client.html", function(err, data){
 
if(err) return resp.writeHead(500);
resp.writeHead(200);
resp.end(data);
});
});
app.listen(3456);

var Room = function (name,owner,password) {
this.name = name;
this.owner = owner;
this.password = password;
this.blacklist = [];
this.currentuser = [];
}

var User = function(name){
this.name = name;
}

var users = [];
var rooms = [];

var io = socketio.listen(app);
io.sockets.on("connection", function(socket){

socket.on('message_to_server', function(data) {
console.log("message: "+ data.message); // log it to the Node.JS output
io.sockets.emit("message_to_client",{message:data["message"],currentroom:data["currentroom"]});// broadcast the message to other users
});

socket.on('private_message_to_server', function(data) {
console.log("message: "+ data.message); // log it to the Node.JS output
io.sockets.emit("private_message_to_client",{message:data["message"],currentroom:data["currentroom"],username:data['username'],touser:data['touser']});// broadcast the message to other users
});
socket.on('img_to_server', function(data) {
console.log("message: "+ data.message); // log it to the Node.JS output
io.sockets.emit("img_to_client",{message:data["message"],currentroom:data["currentroom"]});// broadcast the message to other users
});

socket.on('userLogin',function(data){
var username = data["message"];
user = new User(username)
users.unshift(user);
io.sockets.emit("roomList", {roomList:rooms});  // send message to new user
//io.sockets.emit("userList", {userList:users});  
});
socket.on('enterPrivateRoom',function(data){
    var roomname = data.roomname;
    var username = data.roomname;
    var password = data.password;
    var i=0;
    var errflag=0;
    while(rooms[i]!==undefined){
        if(rooms[i].name===roomname && rooms[i].password===password){
            io.sockets.emit("enterprivateroom", {roomname:rooms[i].name});
            errflag=1;
            break;
        }
        i++;
    }if(errflag===0){
    io.sockets.emit("error", {message:"invalid password"}); }
    });
        
socket.on('newRoom',function(data){
    var roomname = data.message;
    var owner = data.username;
    var password = data.password;
    var i=0;
    var flagroom=0;
    while(rooms[i]!==undefined){
        
        if(rooms[i].name===roomname){
            io.sockets.emit("error", {message:"exist roomname"});
            flagroom=1;
            break;
        }
        i++;
    }
    if(flagroom===0){
        
    room = new Room(roomname,owner,password);
    rooms.unshift(room);
    io.sockets.socket(socket.id).emit("roomList", {roomList:rooms});} 
});
socket.on('blacklist',function(data){
    var roomname = data.roomname;
    var username = data.username;
    var i=0;
    
    while(rooms[i]!==undefined){
        if(rooms[i].name === roomname){
            rooms[i].blacklist.unshift(username);
            break;
        }
        i++;
    }
});
socket.on('exitroom',function(data){
    var roomname = data.roomname;
    var username = data.username;
    var i=0;
    while(rooms[i]!==undefined){
        if(rooms[i].name === roomname){
            var j=0;
        
            while(rooms[i].currentuser[j]!==undefined){
            if(rooms[i].currentuser[j]===username){
                rooms[i].currentuser.splice(j, 1);
                    //io.sockets.emit("error", {message:rooms[i].currentuser}); 

                break;
                }
                j++;
            }
        }
        i++;
    }
});

socket.on('updateuserlist',function(data){
    var username = data["username"];
    var roomname = data["roomname"];
    var i=0;
    var roomnumber;
    while(rooms[i]!==undefined){
        if(rooms[i].name === roomname)
        {
            //rooms[i].currentuser.unshift(username);
            roomnumber = i;
            break;
        }
        i++;
    }
    //io.sockets.emit("error",{message:roomname});
    //io.sockets.emit("error",{message:i});
    io.sockets.emit("userList", {userList:rooms[roomnumber].currentuser,currentroom:roomname,owner:rooms[roomnumber].owner});  
 });
socket.on('enterRoom',function(data){
    var username = data["username"];
    var roomname = data["roomname"];
    var i=0;
    var roomnumber;
    while(rooms[i]!==undefined){
        if(rooms[i].name === roomname)
        {
            rooms[i].currentuser.unshift(username);
            roomnumber = i;
            break;
        }
        i++;
    }
    while(rooms[i]!==undefined){
        if(rooms[i].name === roomname)
        {
            var j=0;
            while(rooms[i].blacklist[j]!==undefined){
            if(rooms[i].blacklist[j]===username){
                io.sockets.emit("blacked",{username:username,roomname:roomname});
                break;
            }
            j++;
            }
        }
        i++;
    }
    
    
    io.sockets.emit("userList", {userList:rooms[roomnumber].currentuser,currentroom:roomname,owner:rooms[roomnumber].owner});  
 });

});