var setUsernameModal = new bootstrap.Modal(document.getElementById("setUsernameModal"), {
    keyboard: false
});

if(getCookie("username") == "") {
    setUsernameModal.show();
}

document.getElementById("confirmUsernameButton").addEventListener("click", function() {
    var username = document.getElementById("usernameInput").value;
    if(username != "") {
        setCookie("username", username, 90);
        setUsernameModal.hide();
    }
});

var addToDoModal = new bootstrap.Modal(document.getElementById("addToDoModal"));

document.getElementById("addButton").addEventListener("click", function() {
    var newToDoDescInput = document.getElementById("newToDoDescInput");
    var newToDoNameInput = document.getElementById("newToDoNameInput");
    if(newToDoNameInput.value != "") {
        newToDoNameInput.value = "";
        newToDoDescInput.value = "";

        // send data to server
    }
});