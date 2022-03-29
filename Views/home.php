<div class="container">
    <div class="row">
        <div class="col choice selected" id="createRoom">
            <h2>Give your name</h2>
            <form action="/create" method="POST" id="nameForm">
                <input type="text" name="name" id="nameInput" class="form-control">
            </form>
        </div>
        <div class="col choice" id="joinRoom">
            <h2>Give the name of an existing room</h2>
            <input type="text" name="roomId" id="roomIdInput" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col">
        <button type="button" class="btn btn-primary" id="submitButton">Go</button>
        </div>
    </div>
</div>