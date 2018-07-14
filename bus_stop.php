<?php
  session_start();
  $_SESSION['title'] = "bus_stop"; 
  include 'include/layout/nav.html';
  include 'include/php/config.php';
  include 'include/php/modal.php';
  $result = mysqli_query($mysqli, "SELECT * FROM bus_stop ORDER BY zone_no");
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
  <h2 align="center">Bus Stop</h2>
  <p>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBusStop">
      Add
    </button>
  </p>
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">Bus Stop Name</th>
      <th scope="col">Zone No.</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php 
    //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
    while($res = mysqli_fetch_array($result)) {     
      // $id = $res['driver_id'];
      echo "<tr id='".$res['stop_id']."'>";
      echo "<td class='stop_name'>".$res['stop_name']."</td>";
      echo "<td class='zone_no'>".$res['zone_no']."</td>";  
      // echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";   
      echo <<<HTML
        <td>
          <button type="button" class="btn btn-info editBtn" data-toggle="modal" data-target="#editBusStop">
            Edit
          </button>
          <button type="button" class="btn btn-danger deleteBtn" data-toggle="modal" data-target="#deleteBusStop">
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
    $("#stopPage").addClass( "active");
  });


  $('.editBtn').click(function(){
      id = $(this).closest('tr').attr('id');
      // console.log(id);
      stop_name = $(this).closest('tr').find(".stop_name").text();
      zone_no = $(this).closest('tr').find(".zone_no").text();
      $("#edit_stop_name").val(stop_name);
      $("#edit_zone_no").val(zone_no);
      $("#stop_id").val(id);
  });

  $('.deleteBtn').click(function(){
      stop_name = $(this).closest('tr').find(".stop_name").text();
      id = $(this).closest('tr').attr('id');
      text = "Delete "+stop_name+"?";
      console.log(id);
      if (confirm(text)){
         $.post("include/php/manage-stop.php",
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
  

  $("#btnAddBusStop").click(function(){
    
    $.post("include/php/manage-stop.php",
    {
        key: "create",
        stop_name: $( "#stop_name" ).val(),
        zone_no: $( "#zone_no" ).val()
    },
    function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
        location.reload();
    });
  });

  $("#btnEditBusStop").click(function(){
    asdf = $("#edit_stop_name").val();
    console.log(asdf);
    $.post("include/php/manage-stop.php",
    {
        key: "update",
        stop_name: $( "#edit_stop_name" ).val(),
        zone_no: $( "#edit_zone_no" ).val(),
        id: $("#stop_id").val()
    },
    function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
        location.reload();
    });


  });



</script>



</body>
</html>
    
      
    


