<?php

  include 'include/php/session.php';
  include 'include/layout/nav.html';
  include 'include/php/config.php';
  include 'include/php/modal.php';
  $result = mysqli_query($mysqli, "SELECT * FROM busdriver ORDER BY driver_id DESC");
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
  <h2 align="center">Bus Driver</h2>
  <p>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBusDriver">
      Add
    </button>
  </p>
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">Driver Name</th>
      <th scope="col">IC No</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php 
    //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
    while($res = mysqli_fetch_array($result)) {     
      // $id = $res['driver_id'];
      echo "<tr id='".$res['driver_id']."'>";
      echo "<td class='driver_name'>".$res['driver_name']."</td>";
      echo "<td class='ic_no'>".$res['ic_no']."</td>";  
      // echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";   
      echo <<<HTML
        <td>
          <button type="button" class="btn btn-info editBtn" data-toggle="modal" data-target="#editBusDriver">
            Edit
          </button>
          <button type="button" class="btn btn-danger deleteBtn" data-toggle="modal" data-target="#deleteBusDriver">
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
    $("#busDriverPage").addClass( "active");
  });


  $('.editBtn').click(function(){
      id = $(this).closest('tr').attr('id');
      driver_name = $(this).closest('tr').find(".driver_name").text();
      ic_no = $(this).closest('tr').find(".ic_no").text();
      $("#editDriverName").val(driver_name);
      $("#editIcNo").val(ic_no);
      $("#driver_id").val(id);
      console.log(ic_no);
  });

  $('.deleteBtn').click(function(){
      driver_name = $(this).closest('tr').find(".driver_name").text();
      id = $(this).closest('tr').attr('id');
      text = "Delete "+driver_name+"?";
      console.log(id);
      if (confirm(text)){
         $.post("include/php/manage-driver.php",
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
    
    $.post("include/php/manage-driver.php",
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

  $("#btnEditBusDriver").click(function(){
    asdf = $("#driver_id").val();
    console.log(asdf);
    $.post("include/php/manage-driver.php",
    {
        key: "update",
        driverName: $( "#editDriverName" ).val(),
        icNo: $( "#editIcNo" ).val(),
        id: $("#driver_id").val()
    },
    function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
        location.reload();
    });


  });



</script>



</body>
</html>
    
      
    


