<?php

$title = $_SESSION['title'];

switch ($title) {
  case 'busDriver':
      $title = "Bus Driver";
      $id = "BusDriver";
      $input =<<<HTML
        <div class="form-group">
          <label for="driverName" class="col-form-label">Driver Name:</label>
          <input type="text" class="form-control" id="driverName">
        </div>
        <div class="form-group">
          <label for="icNo" class="col-form-label">IC No.:</label>
          <input type="text" class="form-control" id="icNo">
        </div>
        <input type="hidden" class="form-control" id="key" value="create">
HTML;
      $editInput =<<<HTML
        <div class="form-group">
          <label for="driverName" class="col-form-label">Driver Name:</label>
          <input type="text" class="form-control" id="editDriverName">
        </div>
        <div class="form-group">
          <label for="icNo" class="col-form-label">IC No.:</label>
          <input type="text" class="form-control" id="editIcNo">
        </div>
        <input type="hidden" class="form-control" id="key" value="update">
        <input type="hidden" class="form-control" id="driver_id">
HTML;
    break;
  
  default:
      $title = "Default";
      $input =<<<HTML
        <div class="form-group">
          <label for="Default" class="col-form-label">Default:</label>
          <input type="text" class="form-control" id="Default">
        </div>
HTML;
    break;
}

echo<<<HTML
  <!-- Modal -->
<div class="modal fade" id="add$id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add $title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        $input
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btnAdd$id" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit$id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit $title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        $editInput
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btnEdit$id" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


HTML;



?>