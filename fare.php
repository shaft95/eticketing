<?php
  // session_start();
  // $a = $_SESSION["id"];

  include 'include/layout/nav.html';
  include 'include/php/config.php';
  $result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id DESC");
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
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
  <h2 style="color: white">Fare</h2>
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
    while($res = mysqli_fetch_array($result)) {     
      
      echo "<tr>";
      echo "<td>".$res['name']."</td>";
      echo "<td>".$res['age']."</td>";
      echo "<td>".$res['email']."</td>";  
      echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";   
    }
    ?>
  </tbody>
</table>
</div>
    

<script>
  $(function(){
    $("#farePage").addClass( "active");
  });
  $('#submit').click(function() {
    $.ajax({
        url: 'send_email.php',
        type: 'POST',
        data: {
            email: 'email@example.com',
            message: 'hello world!'
        },
        success: function(msg) {
            alert('Email Sent');
        }               
    });
});
</script>

</body>
</html>
    
      
    


