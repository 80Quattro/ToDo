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
            var response = JSON.parse(this.responseText);
            todos.push({
                'id': response.insertedId,
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

        var idHiddenInput = document.createElement("input");
        idHiddenInput.setAttribute("type", "hidden");
        idHiddenInput.setAttribute("value", todo.id);
        idHiddenInput.className = "todoId";
        
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

        cardBodyDiv.appendChild(idHiddenInput);
        cardBodyDiv.appendChild(cardTitle);
        cardBodyDiv.appendChild(cardSubitle);
        cardBodyDiv.appendChild(cardText);

        var nextStatusButton = document.createElement("button");
        nextStatusButton.setAttribute("type", "button");
        nextStatusButton.className = "btn btn-primary next";
        nextStatusButton.innerHTML = ">";
        nextStatusButton.addEventListener("click", changeToDo);

        var previousStatusButton = document.createElement("button");
        previousStatusButton.setAttribute("type", "button");
        previousStatusButton.className = "btn btn-primary prev";
        previousStatusButton.innerHTML = "<";
        previousStatusButton.addEventListener("click", changeToDo);

        switch(todo.status) {
            case 'TODO':
                cardBodyDiv.appendChild(deleteButton);
                cardBodyDiv.appendChild(nextStatusButton);
                break;
            case 'INPROGRESS':
                cardBodyDiv.appendChild(previousStatusButton);
                cardBodyDiv.appendChild(deleteButton);
                cardBodyDiv.appendChild(nextStatusButton);
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

function changeToDo(e) {
    var id = e.target.parentNode.children[0].value;

    var status = null;
    var currStatus = e.target.parentNode.parentNode.parentNode.parentNode.id;

    console.log(e.target.classList);

    if(e.target.classList.contains('next')) {
        switch(currStatus) {
            case "toDo":
                status = "INPROGRESS";
                break;
            case "inProgress":
                status = "DONE";
                break;
        }
    }

    if(e.target.classList.contains('prev')) {
        switch(currStatus) {
            case "inProgress":
                status = "TODO";
                break;
            case "done":
                status = "INPROGRESS";
                break;
        }
    }
    

    var xhttp = new XMLHttpRequest();
    xhttp.open("PUT", "/room/changeToDo", true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            for(var i = 0; i < todos.length; i++) {
                if(todos[i].id == id) {
                    todos[i].status = status;
                }
            }

            showTodos();
        }
    };
    var data = {
        todoId: id,
        toChange: {
            'status': status
        }
    };
    xhttp.send(JSON.stringify(data));
}