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
        addToDoModal.hide();
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

function showTodos() 
{
    var todoDiv = document.querySelector("#toDo .content");
    var inProgressDiv = document.querySelector("#inProgress .content");
    var doneDiv = document.querySelector("#done .content");

    todoDiv.innerHTML = "";
    inProgressDiv.innerHTML = "";
    doneDiv.innerHTML = "";

    todos.forEach(function(todo) {

        var statusDiv = todoDiv;

        var cardDiv = document.createElement("div");
        cardDiv.className = "card";
        
        var cardBodyDiv = document.createElement("div");
        cardBodyDiv.className = "card-body";
        
        var cardTitle = document.createElement("h5");
        cardTitle.className = "card-title";
        cardTitle.innerHTML = todo.name;

        var deleteButton = document.createElement("button");
        deleteButton.setAttribute("type", "button");
        deleteButton.className = "btn btn-danger";
        deleteButton.innerHTML = "x";
        
        var cardSubitle = document.createElement("h6");
        cardSubitle.className = "card-subtitle";
        cardSubitle.innerHTML = "Owner: " + todo.owner;
        
        var cardText = document.createElement("p");
        cardText.className = "card-text";
        cardText.innerHTML = todo.description;

        cardBodyDiv.appendChild(cardTitle);
        cardBodyDiv.appendChild(cardSubitle);
        cardBodyDiv.appendChild(cardText);

        var nextStatusButton = document.createElement("button");
        nextStatusButton.setAttribute("type", "button");
        nextStatusButton.className = "btn btn-primary";
        nextStatusButton.innerHTML = ">";

        var previousStatusButton = document.createElement("button");
        previousStatusButton.setAttribute("type", "button");
        previousStatusButton.className = "btn btn-primary";
        previousStatusButton.innerHTML = "<";

        switch(todo.status) {
            case 'TODO':
                cardBodyDiv.appendChild(deleteButton);
                cardBodyDiv.appendChild(nextStatusButton);
                break;
            case 'INPROGRESS':
                cardBodyDiv.appendChild(nextStatusButton);
                cardBodyDiv.appendChild(deleteButton);
                cardBodyDiv.appendChild(previousStatusButton);
                statusDiv = inProgressDiv;
                break;
            case 'DONE':
                cardBodyDiv.appendChild(previousStatusButton);
                cardBodyDiv.appendChild(deleteButton);
                statusDiv = doneDiv;
                break;
        }

        cardDiv.appendChild(cardBodyDiv);
        statusDiv.appendChild(cardDiv);

    })

}