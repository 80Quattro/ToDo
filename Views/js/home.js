// Create room option
/* document.getElementById("submitButton").addEventListener("click", function() {
    var name = document.getElementById("nameInput").value;
    if(name != "") {
        document.getElementById("nameForm").submit();
    }
}); */

// Join room option
/* document.getElementById("submitButton").addEventListener("click", function() {
    var roomId = document.getElementById("roomIdInput").value;
    if(roomId != "") {
        document.location.href = "/room?id=" + roomId;
    }
});
 */

var createRoomDiv = document.getElementById("createRoom");
var joinRoomDiv = document.getElementById("joinRoom");

createRoomDiv.addEventListener("click", function(e) {
    createRoomDiv.classList.add("selected");
    joinRoomDiv.classList.remove("selected");
});

joinRoomDiv.addEventListener("click", function(e) {
    joinRoomDiv.classList.add("selected");
    createRoomDiv.classList.remove("selected");
});

document.getElementById("submitButton").addEventListener("click", function() {
    
    if(createRoomDiv.classList.contains("selected")) {
        var name = document.getElementById("nameInput").value;
        if(name != "") {
            document.getElementById("nameForm").submit();
        }
    }
    else if(joinRoomDiv.classList.contains("selected")) {
        var roomId = document.getElementById("roomIdInput").value;
        if(roomId != "") {
            document.location.href = "/room?id=" + roomId;
        }
    }

})