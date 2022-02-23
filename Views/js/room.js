var url = new URL(window.location.href);
var roomId = url.searchParams.get("id");

var todos = new Array();

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

getTodos();

document.getElementById("addButton").addEventListener("click", function() {
    var newToDoDescInput = document.getElementById("newToDoDescInput");
    var newToDoNameInput = document.getElementById("newToDoNameInput");
    if(newToDoNameInput.value != "") {
        name = newToDoNameInput.value;
        description = newToDoDescInput.value;
        newToDoNameInput.value = "";
        newToDoDescInput.value = "";

        // send data to server
        addToDo(name, description);
    }
});

function addToDo(ToDoName, ToDodescription) 
{
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "/room/addToDo", true); 
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            todos.push({
                'name': ToDoName,
                'description': ToDodescription,
                'owner': getCookie("username"),
                'status': 'TODO'
            });
            showTodos();
        }
    };
    var data = {
        roomId: roomId,
        name: ToDoName,
        description: ToDodescription,
        owner: getCookie("username")
    };
    xhttp.send(JSON.stringify(data));
}

function getTodos()
{
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "/room/getToDos", true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            Array.prototype.push.apply(todos, response.todos);
            showTodos();
        }
    };
    var data = {
        roomId: roomId,
    };
    xhttp.send(JSON.stringify(data));
}

function showTodos() {
    console.log(todos);
}