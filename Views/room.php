<?php if($params['message'] == 'RoomNotFound') : ?>
  
  <div class="container">
    <div class="row">
      <h2>Nie znaleziono pokoju o podanej nazwie</h2>
    </div>
  </div>

<?php else : ?>

  <div class="container">
      <div class="row">
          <div class="col" id="toDo">
              <h3>
                  ToDo
                  <button type="button" class="btn btn-primary" id="addToDoButton" data-bs-toggle="modal" data-bs-target="#addToDoModal">+</button>
              </h3>
              <div class="content"></div>
          </div>
          <div class="col" id="inProgress">
              <h3>In progress</h3>
              <div class="content"></div>
          </div>
          <div class="col" id="done">
              <h3>Done</h3>
              <div class="content"></div>
          </div>
      </div>
  </div>

  <!-- Set Username Modal -->
  <div class="modal fade" id="setUsernameModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Give your name</h5>
        </div>
        <div class="modal-body">
          <input type="text" name="userName" id="usernameInput">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="confirmUsernameButton">Confirm</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Add ToDo Modal -->
  <div class="modal fade" id="addToDoModal" tabindex="-1" aria-labelledby="addToDo" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add new ToDo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
              <form>
                  <div class="mb-3">
                      <label for="newToDoNameInput" class="form-label">Name</label>
                      <input type="text" class="form-control" name="newToDoNameInput" id="newToDoNameInput">
                  </div>
                  <div class="mb-3">
                      <label for="newToDoDescInput" class="form-label">Description</label>
                      <input type="text" class="form-control" name="newToDoDescInput" id="newToDoDescInput">
                  </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="addButton">Add</button>
        </div>
      </div>
    </div>
  </div>

<?php endif; ?>