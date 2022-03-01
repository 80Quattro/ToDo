<div class="container">
    <div class="row">
        <div class="col choice selected" id="createRoom">
            <h2>Podaj nazwę użytkownika</h2>
            <form action="/create" method="POST" id="nameForm">
                <input type="text" name="name" id="nameInput" class="form-control">
            </form>
        </div>
        <div class="col choice" id="joinRoom">
            <h2>Podaj nazwę pokoju</h2>
            <input type="text" name="roomId" id="roomIdInput" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col">
        <button type="button" class="btn btn-primary" id="submitButton">Idź</button>
        </div>
    </div>
</div>