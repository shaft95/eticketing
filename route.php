<?php
  session_start();
  $_SESSION['title'] = "route"; 
  include 'include/layout/nav.html';
  include 'include/php/config.php';
  include 'include/php/modal.php';
  $result = mysqli_query($mysqli, "SELECT * FROM route ORDER BY route_id");
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
  <h2 align="center">Route</h2>
  <p>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRoute">
      Add
    </button>
  </p>
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">Route Code</th>
      <th scope="col">No. Of Stop</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php 
    //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
    while($res = mysqli_fetch_array($result)) {     
      // $id = $res['driver_id'];
      
      // var_export($res['route_id']);
      echo "<tr id='".$res['route_id']."'>";
      echo "<td class='route_code'>".$res['route_code']."</td>";
      echo "<td class='no_stop'>".$res['no_stop']."<input type='hidden' class='form-control stop_id_hidden' value='".$res['stop_id']."'></td>";  
      // echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";   
      echo <<<HTML
        <td>
          <button type="button" class="btn btn-info editBtn" data-toggle="modal" data-target="#editRoute">
            Edit
          </button>
          <button type="button" class="btn btn-danger deleteBtn" data-toggle="modal" data-target="#deleteRoute">
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
    $("#routePage").addClass( "active");
  });


  $('.editBtn').click(function(){
      id = $(this).closest('tr').attr('id');
      // console.log(id);
      route_code = $(this).closest('tr').find(".route_code").text();
      stop_id_hidden = $(this).closest('tr').find(".stop_id_hidden").val();
      console.log(stop_id_hidden);
      $("#edit_route_code").val(route_code);
      $("#edit_stop_id").val(stop_id_hidden);
      $("#route_id").val(id);
  });

  $('.deleteBtn').click(function(){
      route_code = $(this).closest('tr').find(".route_code").text();
      id = $(this).closest('tr').attr('id');
      text = "Delete "+route_code+"?";
      console.log(id);
      if (confirm(text)){
         $.post("include/php/manage-route.php",
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
  

  $("#btnAddRoute").click(function(){
    
    $.post("include/php/manage-route.php",
    {
        key: "create",
        route_code: $( "#route_code" ).val(),
        stop_id: $( "#stop_id" ).val()
    },
    function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
        location.reload();
    });
  });

  $("#btnEditRoute").click(function(){
    asdf = $("#edit_stop_id").val();
    console.log(asdf);
    $.post("include/php/manage-route.php",
    {
        key: "update",
        route_code: $( "#edit_route_code" ).val(),
        stop_id: $( "#edit_stop_id" ).val(),
        id: $("#route_id").val()
    },
    function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
        location.reload();
    });


  });



</script>



</body>
</html>
    
      
    


