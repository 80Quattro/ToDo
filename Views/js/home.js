// Create room option
/* document.getElementById("submitButton").addEventListener("click", function() {
    var name = document.getElementById("nameInput").value;
    if(name != "") {
        document.getElementById("nameForm").submit();
    }
}); */

// Join room option
document.getElementById("submitButton").addEventListener("click", function() {
    var roomId = document.getElementById("roomIdInput").value;
    if(roomId != "") {
        document.location.href = "/room?id=" + roomId;
    }
})