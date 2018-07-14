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
  
  case 'passenger':
      $title = "Passenger";
      $id = "Passenger";
      $input =<<<HTML
        <div class="form-group">
          <label for="username" class="col-form-label">Username:</label>
          <input type="text" class="form-control" id="username">
        </div>
        <div class="form-group">
          <label for="first_name" class="col-form-label">First Name:</label>
          <input type="text" class="form-control" id="first_name">
        </div>
        <div class="form-group">
          <label for="last_name" class="col-form-label">Last Name:</label>
          <input type="text" class="form-control" id="last_name">
        </div>
        <div class="form-group">
          <label for="email" class="col-form-label">Email:</label>
          <input type="text" class="form-control" id="email">
        </div>
        <div class="form-group">
          <label for="mobile_no" class="col-form-label">Mobile No.:</label>
          <input type="text" class="form-control" id="mobile_no">
        </div>
HTML;
      $editInput =<<<HTML
        <div class="form-group">
          <label for="username" class="col-form-label">Username:</label>
          <input type="text" class="form-control" id="edit_username">
        </div>
        <div class="form-group">
          <label for="first_name" class="col-form-label">First Name:</label>
          <input type="text" class="form-control" id="edit_first_name">
        </div>
        <div class="form-group">
          <label for="last_name" class="col-form-label">Last Name:</label>
          <input type="text" class="form-control" id="edit_last_name">
        </div>
        <div class="form-group">
          <label for="email" class="col-form-label">Email:</label>
          <input type="text" class="form-control" id="edit_email">
        </div>
        <div class="form-group">
          <label for="mobile_no" class="col-form-label">Mobile No.:</label>
          <input type="text" class="form-control" id="edit_mobile_no">
        </div>
        <input type="hidden" class="form-control" id="passenger_id">
HTML;
    break;
  case 'fare':
      $title = "Fare";
      $id = "Fare";
      $input =<<<HTML
        <div class="form-group">
          <label for="diff_no" class="col-form-label">Different No. Of Zone:</label>
          <input type="text" class="form-control" id="diff_no">
        </div>
        <div class="form-group">
          <label for="fare_price" class="col-form-label">Fare Price:</label>
          <input type="text" class="form-control" id="fare_price">
        </div>
HTML;
      $editInput =<<<HTML
        <div class="form-group">
          <label for="diff_no" class="col-form-label">Different No. Of Zone:</label>
          <input type="text" class="form-control" id="edit_diff_no">
        </div>
        <div class="form-group">
          <label for="fare_price" class="col-form-label">Fare Price:</label>
          <input type="text" class="form-control" id="edit_fare_price">
        </div>
        <input type="hidden" class="form-control" id="fare_id">
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

    case 'bus_stop':
      $title = "Bus Stop";
      $id = "BusStop";
      $input =<<<HTML
        <div class="form-group">
          <label for="stop_name" class="col-form-label">Bus Stop Name:</label>
          <input type="text" class="form-control" id="stop_name">
        </div>
        <div class="form-group">
          <label for="zone_no" class="col-form-label">Zone No.:</label>
          <input type="text" class="form-control" id="zone_no">
        </div>
        <input type="hidden" class="form-control" id="key" value="create">
HTML;
      $editInput =<<<HTML
        <div class="form-group">
          <label for="stop_name" class="col-form-label">Bus Stop Name:</label>
          <input type="text" class="form-control" id="edit_stop_name">
        </div>
        <div class="form-group">
          <label for="zone_no" class="col-form-label">Zone No.:</label>
          <input type="text" class="form-control" id="edit_zone_no">
        </div>
        <input type="hidden" class="form-control" id="key" value="update">
        <input type="hidden" class="form-control" id="stop_id">
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