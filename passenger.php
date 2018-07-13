<?php
  session_start();
  $_SESSION['title'] = "passenger"; 
  include 'include/layout/nav.html';
  include 'include/php/config.php';
  include 'include/php/modal.php';
  $result = mysqli_query($mysqli, "SELECT * FROM passenger ORDER BY passenger_id");
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ticketing Management</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  body  {
    background-image: url("img/japanbg.jpg");
    background-repeat: no-repeat, repeat;
    background-color: #cccccc;
    
  }
  </style>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <!-- <link rel="stylaesheet" href="css/welcome.css"> -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
  <h2 align="center">Passenger</h2>
  <p>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPassenger">
      Add
    </button>
  </p>
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">Username</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile No</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php 
    //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
    while($res = mysqli_fetch_array($result)) {     
      // $id = $res['driver_id'];
      echo "<tr id='".$res['passenger_id']."'>";
      echo "<td class='username'>".$res['username']."</td>";
      echo "<td class='first_name'>".$res['first_name']."</td>";  
      echo "<td class='last_name'>".$res['last_name']."</td>"; 
      echo "<td class='email'>".$res['email']."</td>"; 
      echo "<td class='mobile_no'>".$res['mobile_no']."</td>"; 
      // echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";   
      echo <<<HTML
        <td>
          <button type="button" class="btn btn-info editBtn" data-toggle="modal" data-target="#editPassenger">
            Edit
          </button>
          <button type="button" class="btn btn-danger deleteBtn" data-toggle="modal" data-target="#deletePassenger">
            Delete
          </button>
          </td>
HTML;
    }
    ?>
  </tbody>
</table>

<!-- Modal -->

<script>
  var id = "";
  $(function(){
    $("#passengerPage").addClass( "active");
  });


  $('.editBtn').click(function(){
      id = $(this).closest('tr').attr('id');
      username = $(this).closest('tr').find(".username").text();
      first_name = $(this).closest('tr').find(".first_name").text();
      last_name = $(this).closest('tr').find(".last_name").text();
      email = $(this).closest('tr').find(".email").text();
      mobile_no = $(this).closest('tr').find(".mobile_no").text();
      $("#edit_username").val(username);
      $("#edit_first_name").val(first_name);
      $("#edit_last_name").val(last_name);
      $("#edit_email").val(email);
      $("#edit_mobile_no").val(mobile_no);
      $("#passenger_id").val(id);
  });

  $('.deleteBtn').click(function(){
      driver_name = $(this).closest('tr').find(".driver_name").text();
      id = $(this).closest('tr').attr('id');
      text = "Delete "+driver_name+"?";
      console.log(id);
      if (confirm(text)){
         $.post("include/php/manage-passenger.php",
        {
            key: "delete",
            id: $(this).closest('tr').attr('id')
        },
        function(data, status){
            alert("Data: " + data + "\nStatus: " + status);
            location.reload();
        });
      }
      
  });
  

  $("#btnAddBusDriver").click(function(){
    
    $.post("include/php/manage-passenger.php",
    {
        key: "create",
        driverName: $( "#driverName" ).val(),
        icNo: $( "#icNo" ).val()
    },
    function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
        location.reload();
    });
  });

  $("#btnEditPassenger").click(function(){
    asdf = $("#passenger_id").val();
    console.log(asdf);
    $.post("include/php/manage-passenger.php",
    {
        key: "update",
        username: $( "#edit_username" ).val(),
        first_name: $( "#edit_first_name" ).val(),
        last_name: $( "#edit_last_name" ).val(),
        email: $( "#edit_email" ).val(),
        mobile_no: $( "#edit_mobile_no" ).val(),
        id: $("#passenger_id").val()
    },
    function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
        location.reload();
    });


  });



</script>



</body>
</html>
    
      
    


