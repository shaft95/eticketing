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
   if($query = $conn->prepare($sql)) { 
      $query->bind_param('s', $username);
      $query->execute();

      $res = $query->get_result(); 
      
      $row = $res->fetch_assoc();

      if($row['passenger_id']==null){ 
          $result = "invalid_username"; 
      } 
      else if($row['password']!=$password) 
      { 
          $result = "invalid_password"; 
      } 
      else{ 
          $result = "Success"; 
          session_start(); 
          $_SESSION["id"] = $row['passenger_id']; 
   
      } 

      echo $result;
   } else {
       $error = $conn->errno . ' ' . $conn->error;
       echo $error; 
   }


?>