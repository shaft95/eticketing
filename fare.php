<?php
  session_start();
  $_SESSION['title'] = "fare"; 
  include 'include/layout/nav.html';
  include 'include/php/config.php';
  include 'include/php/modal.php';
  $result = mysqli_query($mysqli, "SELECT * FROM fare ORDER BY fare_id");
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
  <h2 align="center">Fare</h2>
  <p>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addFare">
      Add
    </button>
  </p>
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">Different No. Of Zone</th>
      <th scope="col">Fare Price</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php 
    //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
    while($res = mysqli_fetch_array($result)) {     
      // $id = $res['driver_id'];
      echo "<tr id='".$res['fare_id']."'>";
      echo "<td class='diff_no'>".$res['diff_no']."</td>";
      echo "<td class='fare_price'>".$res['fare_price']."</td>";  
      // echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";   
      echo <<<HTML
        <td>
          <button type="button" class="btn btn-info editBtn" data-toggle="modal" data-target="#editFare">
            Edit
          </button>
          <button type="button" class="btn btn-danger deleteBtn" data-toggle="modal" data-target="#deleteFare">
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
    $("#farePage").addClass( "active");
  });


  $('.editBtn').click(function(){
      id = $(this).closest('tr').attr('id');
      // console.log(id);
      diff_no = $(this).closest('tr').find(".diff_no").text();
      fare_price = $(this).closest('tr').find(".fare_price").text();
      $("#edit_diff_no").val(diff_no);
      $("#edit_fare_price").val(fare_price);
      $("#fare_id").val(id);
  });

  $('.deleteBtn').click(function(){
      diff_no = $(this).closest('tr').find(".diff_no").text();
      id = $(this).closest('tr').attr('id');
      text = "Delete "+diff_no+"?";
      console.log(id);
      if (confirm(text)){
         $.post("include/php/manage-fare.php",
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
  

  $("#btnAddFare").click(function(){
    
    $.post("include/php/manage-fare.php",
    {
        key: "create",
        diff_no: $( "#diff_no" ).val(),
        fare_price: $( "#fare_price" ).val()
    },
    function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
        location.reload();
    });
  });

  $("#btnEditFare").click(function(){
    asdf = $("#edit_diff_no").val();
    console.log(asdf);
    $.post("include/php/manage-fare.php",
    {
        key: "update",
        diff_no: $( "#edit_diff_no" ).val(),
        fare_price: $( "#edit_fare_price" ).val(),
        id: $("#fare_id").val()
    },
    function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
        location.reload();
    });


  });



</script>



</body>
</html>
    
      
    


