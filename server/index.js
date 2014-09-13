
var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

app.get('/', function(req, res){
    res.sendfile('index.html');
});

io.on('connection', function(socket){
    socket.on('row_add', function(data){
    	//data : {id: 20}
    	console.log(data);
        io.emit('row_add', data);
    });
    socket.on('row_delete', function(data){
    	//data : {id: 20}
    	console.log(data);
        io.emit('row_delete', data);
    });
    socket.on('cell_update', function(data){
    	//data : {id: 20, propertyname: ""}
        console.log(data);
        io.emit('cell_update', data);
    });
});

http.listen(8888, function(){
    console.log('listening on *:8888');
});