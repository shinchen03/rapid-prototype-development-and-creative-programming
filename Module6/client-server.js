
// Require the packages we will use:
var http = require("http"),
	socketio = require("socket.io"),
	fs = require("fs");
 
// Listen for HTTP connections.  This is essentially a miniature static file server that only serves our one file, client.html:
var app = http.createServer(function(req, resp){
	// This callback runs when a new connection is made to our HTTP server.
 
	fs.readFile("client.html", function(err, data){
		// This callback runs when the client.html file has been read from the filesystem.
 
		if(err) return resp.writeHead(500);
		resp.writeHead(200);
		resp.end(data);
	});
});
app.listen(3456);
var Room = function (name, password, owner) {
	this.name = name;
	this.password = password;
	this.owner = owner;
	this.members = [];
	this.blacklist = [];
}
var User = function(name, socketId) {
	this.name = name;
	this.socketId = socketId;
	this.room;
	this.ownRoom = [];
}

// Global parameters for users and rooms.
// socket id -> User
var users = {};
// room name -> Room
var rooms = {};



// Do the Socket.IO magic:
var io = socketio.listen(app);
io.sockets.on("connection", function(socket){
	// This callback runs when a new Socket.IO connection is established.
 
	socket.on('userLogin', function(data) {
		var userName = data['userName'];
		users[socket.id] = new User(userName, socket.id);
                io.sockets.socket(socket.id).emit("roomList", {roomList: rooms});  // send message to new user
		io.sockets.emit("userList", {userList: users});  // broadcast the message to other users
	});

	socket.on('newRoom', function(data) {
		var roomName = data['roomName'];
		var newRoom = new Room(roomName, undefined, socket.id);
		rooms[roomName] = newRoom;
		users[socket.id].ownRoom.push(newRoom.name);
		io.sockets.emit("roomList", {roomList: rooms});  // broadcast the message to other users
	});
	socket.on('newPrivateRoom', function(data) {
		var roomName = data['roomName'];
		var password = data['password'];
		var newRoom = new Room(roomName, password, socket.id);
		rooms[roomName] = newRoom;
		users[socket.id].ownRoom.push(newRoom.name);
		io.sockets.emit("roomList", {roomList: rooms}); // broadcast the message to other users
	});

	socket.on('enterRoom', function(data) {
		var roomName = data['roomName'];
		if (!(roomName in rooms)) {
			io.sockets.socket(socket.id).emit("Error", {info:"room not exist"});
			return;
		}
		if (rooms[roomName].password == undefined || rooms[roomName].password == data["password"]) {
			var user = users[socket.id];
			var newRoom = rooms[roomName];
			for (var ban in newRoom.blacklist) {
				if (newRoom.blacklist[ban].socketId == socket.id) {
					io.sockets.socket(socket.id).emit("Error", {info:"you are banned from that group"});
					return;
				}
			}
			if (user.room != undefined && user.room != null) {
				// leave current room.
				var room = rooms[user.room];
				var index = room.members.indexOf(user);
				room.members.splice(index, 1);
				socket.leave(room.name);
				io.sockets.to(room.name).emit("roomUserList", {roomUserList:room.members, name:room.name, owner:users[room.owner].name}); // broadcast to the room
			}
			// join new room.
			newRoom.members.push(user);
			user.room = newRoom.name;
			socket.join(newRoom.name);
			io.sockets.socket(socket.id).emit("userEnterRoom", {room:newRoom.name});
			io.sockets.to(newRoom.name).emit("roomUserList", {roomUserList:newRoom.members, name:newRoom.name, owner:users[newRoom.owner].name}); // broadcast to the room
		} else {
			io.sockets.socket(socket.id).emit("Error", {info:"room password incorrect"});
			return;
		}
	});

	socket.on('leaveRoom', function(data) {
		var roomName = data['roomName']
		socket.leave(roomName);
	});

	socket.on('selfOut', function(data) {
		var roomName = data['roomName']
		var room = rooms[roomName];
		var index = room.members.indexOf(users[socket.id]);
		room.members.splice(index, 1);
		users[socket.id].room = undefined;
		io.sockets.to(roomName).emit("roomUserList", {roomUserList:room.members, name:room.name, owner:users[room.owner].name}); // broadcast to the room
		io.sockets.socket(socket.id).emit("gotOut", {roomName: roomName});
		io.sockets.socket(socket.id).emit("userList", {userList:users});
	});

	socket.on('kickUser', function(data) {
		var roomName = data['roomName']
		var userSocketId = data['userSocketId']
		var room = rooms[roomName];
		var index = room.members.indexOf(users[userSocketId]);
		room.members.splice(index, 1);
		users[userSocketId].room = undefined;
		io.sockets.to(roomName).emit("roomUserList", {roomUserList:room.members, name:room.name, owner:users[room.owner].name}); // broadcast to the room
		io.sockets.socket(userSocketId).emit("gotKick", {roomName: roomName});
		io.sockets.socket(userSocketId).emit("userList", {userList:users});
	});

	socket.on('banUser', function(data) {
		var roomName = data['roomName']
		var userSocketId = data['userSocketId']
		var room = rooms[roomName];
		var index = room.members.indexOf(users[userSocketId]);
		room.members.splice(index, 1);
		room.blacklist.push(users[userSocketId]);
		users[userSocketId].room = undefined;
		io.sockets.to(roomName).emit("roomUserList", {roomUserList:room.members, name:room.name, owner:users[room.owner].name});  // broadcast to the room
		io.sockets.socket(userSocketId).emit("gotKick", {roomName:roomName});
		io.sockets.socket(userSocketId).emit("userList", {userList:users});
	});

	socket.on('chatRoom', function(data) {
		io.sockets.to(data["roomName"]).emit("roomMessage",
						     {message:data["message"], user:users[socket.id].name}); // broadcast the message to the room
	});

	socket.on('chatRoomPic', function(data) {
		console.log("chatRoomPicaaaaa");
		console.log(data["roomName"]);
		console.log(data["pictureLink"]);
		console.log(users[socket.id].name);
		io.sockets.to(data["roomName"]).emit("roomPicture",
						     {message:data["pictureLink"], user:users[socket.id].name}); // broadcast the message to the room
	});

	socket.on('chatUser', function(data) {
		console.log("in chat user");
		var userName = data['userName'];
		console.log(userName);
		var userSocketId = ""
		for (var i in users) {
			if (users[i].name == userName) {
		console.log("user found");
				userSocketId = users[i].socketId;
				break;
			}
		}
		if (userSocketId == "") {
		console.log("user not exist");
			io.sockets.socket(socket.id).emit("Error", {info:"user not exist"});
			return;
		}
		console.log("corret");
		io.sockets.socket(userSocketId).emit("receiveMessage", {message:data["message"], from:users[socket.id].name, to:users[userSocketId].name});
		io.sockets.socket(socket.id).emit("sendMessage", {message:data["message"], from:users[socket.id].name, to:users[userSocketId].name});
	});

	socket.on('disconnect', function() {
		if (!(socket.id in users)) {
			return;
		}
		if (users[socket.id].room != undefined) {
			var roomName = users[socket.id].room;
			socket.leave(roomName);
			if (roomName in rooms) {
				var room = rooms[roomName];
				var index = room.members.indexOf(users[socket.id]);
				room.members.splice(index, 1);
				io.sockets.to(roomName).emit("roomUserList", {roomUserList:room.members, name:room.name, owner:users[room.owner].name});
			}
		}
		console.log(socket.id);
		console.log(users[socket.id].name);
		console.log(users[socket.id].ownRoom.length);
		if (users[socket.id].ownRoom.length != 0) {
			for (var i in users[socket.id].ownRoom) {
				console.log(i);
                                var roomName = users[socket.id].ownRoom[i];
				var room = rooms[roomName];
				console.log(roomName);
				if (room.members.length == 0 || (room.members.length == 1 && room.members[0].socketId == socket.id)) {
					delete rooms[room.name];
					io.sockets.emit("roomList", {rooms:rooms});
				} else {
					room.owner = room.members[0].socketId;
					users[room.owner].ownRoom.push(room.name);
				}
			}
		}
		console.log("aaaa");
		delete users[socket.id];
		io.sockets.emit("userList", {userList: users});  // broadcast the message to other users
	});
});