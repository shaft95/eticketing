<?php
   $databaseHost = 'localhost';
   $databaseName = 'etma';
   $databaseUsername = 'root';
   $databasePassword = '';

   $conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);

   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   $data    = array();
   $username = $_POST['username'];
   $password = $_POST['password'];
   // var_export($username);die;
   $sql = "SELECT passenger_id, password FROM passenger WHERE username = ?";
   if($query = $conn->prepare($sql)) { // assuming $mysqli is the connection
      $driverName = $_POST['driverName'];
      $icNo = $_POST['icNo'];
      $query->bind_param('ss', $driverName, $icNo);
      $query->execute();


      $row = $query->fetch();
      var_export($row);die;
      if($row['passenger_id']==null){ 
          $modal_title = "Error"; 
   
          $script ="setTimeout(function () {window.location.href = 'login.html'}, 2000);"; 
      } 
      else if($row['password']!=$password) 
      { 
        $modal_title = "Error"; 
          $script ="setTimeout(function () {window.location.href = 'login.html'}, 2000);"; 
      } 
      else{ 
        $modal_title = "Success"; 
        session_start(); 
        $_SESSION["id"] = $row['passenger_id']; 
   
       
      } 
   } else {
       $error = $conn->errno . ' ' . $conn->error;
       echo $error; 
   }


?>