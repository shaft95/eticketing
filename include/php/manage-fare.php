<?php
   $databaseHost = 'localhost';
   $databaseName = 'etma';
   $databaseUsername = 'root';
   $databasePassword = '';

   $conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);

   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   $key = $_POST['key'];
   $data    = array();

   switch($key)
   {
      case "create":
         $sql = "INSERT INTO fare (diff_no, fare_price) VALUES (?, ?)";
         if($query = $conn->prepare($sql)) { // assuming $mysqli is the connection
            $diff_no = $_POST['diff_no'];
            $fare_price = $_POST['fare_price'];
             $query->bind_param('id', $diff_no, $fare_price);
             $query->execute();
         } else {
             $error = $conn->errno . ' ' . $conn->error;
             echo $error; 
         }

      break;

      // Update an existing record in the technologies table
      case "update":

         $sql = "UPDATE fare SET diff_no=?, fare_price=? WHERE fare_id=?";
         if($query = $conn->prepare($sql)) { // assuming $mysqli is the connection
            $diff_no = $_POST['diff_no'];
            $fare_price = $_POST['fare_price'];
            $fare_id = $_POST['id'];
             $query->bind_param('idi', $diff_no, $fare_price, $fare_id);
             $query->execute();
         } else {
             $error = $conn->errno . ' ' . $conn->error;
             echo $error; 
         }
      break;

      case "delete":
         $id = $_POST['id'];
         var_export($id);

         $sql = "DELETE FROM fare WHERE fare_id=?";
         if($query = $conn->prepare($sql)) { 
            
            $fare_id = $_POST['id'];
            $query->bind_param('i', $fare_id);
            $query->execute();
         } else {
             $error = $conn->errno . ' ' . $conn->error;
             echo $error; 
         }
      break;
   }

?>