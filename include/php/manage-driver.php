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
         $sql = "INSERT INTO busdriver (driver_name, ic_no) VALUES (?, ?)";
         if($query = $conn->prepare($sql)) { // assuming $mysqli is the connection
            $driverName = $_POST['driverName'];
            $icNo = $_POST['icNo'];
             $query->bind_param('ss', $driverName, $icNo);
             $query->execute();
         } else {
             $error = $conn->errno . ' ' . $conn->error;
             echo $error; 
         }

      break;

      // Update an existing record in the technologies table
      case "update":

         $sql = "UPDATE busdriver SET driver_name=?, ic_no=? WHERE driver_id=?";
         if($query = $conn->prepare($sql)) { // assuming $mysqli is the connection
            $driverName = $_POST['driverName'];
            $icNo = $_POST['icNo'];
            $driver_id = $_POST['id'];
             $query->bind_param('ssi', $driverName, $icNo, $driver_id);
             $query->execute();
         } else {
             $error = $conn->errno . ' ' . $conn->error;
             echo $error; 
         }
      break;

      case "delete":
         $id = $_POST['id'];
         var_export($id);

         $sql = "DELETE FROM busdriver WHERE driver_id=?";
         if($query = $conn->prepare($sql)) { 
            
            $driver_id = $_POST['id'];
            $query->bind_param('i', $driver_id);
            $query->execute();
         } else {
             $error = $conn->errno . ' ' . $conn->error;
             echo $error; 
         }
      break;
   }

?>