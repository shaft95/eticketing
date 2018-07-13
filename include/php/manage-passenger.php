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
      // case "create":
      //    $sql = "INSERT INTO passenger (driver_name, ic_no) VALUES (?, ?)";
      //    if($query = $conn->prepare($sql)) { // assuming $mysqli is the connection
      //       $driverName = $_POST['driverName'];
      //       $icNo = $_POST['icNo'];
      //        $query->bind_param('ss', $driverName, $icNo);
      //        $query->execute();
      //    } else {
      //        $error = $conn->errno . ' ' . $conn->error;
      //        echo $error; 
      //    }

      // break;

      // Update an existing record in the technologies table
      case "update":

         $sql = "UPDATE passenger SET username=?, first_name=?, last_name=?, email=?, mobile_no=? WHERE passenger_id=?";
         if($query = $conn->prepare($sql)) { // assuming $mysqli is the connection
            $username = $_POST['username'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $mobile_no = $_POST['mobile_no'];
            $passenger_id = $_POST['id'];
             $query->bind_param('ssssii', $username, $first_name, $last_name, $email, $mobile_no, $passenger_id);
             $query->execute();
         } else {
             $error = $conn->errno . ' ' . $conn->error;
             echo $error; 
         }
      break;

      case "delete":
         $id = $_POST['id'];
         var_export($id);

         $sql = "DELETE FROM passenger WHERE passenger_id=?";
         if($query = $conn->prepare($sql)) { 
            
            $passenger_id = $_POST['id'];
            $query->bind_param('i', $passenger_id);
            $query->execute();
         } else {
             $error = $conn->errno . ' ' . $conn->error;
             echo $error; 
         }
      break;
   }

?>