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
         $sql = "INSERT INTO bus_stop (stop_name, stop_code, zone_no) VALUES (?, ?, ?)";
         if($query = $conn->prepare($sql)) { // assuming $mysqli is the connection
            $stop_name = $_POST['stop_name'];
            $stop_code = $_POST['stop_code'];
            $zone_no = $_POST['zone_no'];
             $query->bind_param('ssi', $stop_name, $stop_code, $zone_no);
             $query->execute();
         } else {
             $error = $conn->errno . ' ' . $conn->error;
             echo $error; 
         }

      break;

      // Update an existing record in the technologies table
      case "update":

         $sql = "UPDATE bus_stop SET stop_name=?, stop_code=?, zone_no=? WHERE stop_id=?";
         if($query = $conn->prepare($sql)) { // assuming $mysqli is the connection
            $stop_name = $_POST['stop_name'];
            $stop_code = $_POST['stop_code'];
            $zone_no = $_POST['zone_no'];
            $stop_id = $_POST['id'];
             $query->bind_param('ssii', $stop_name, $stop_code, $zone_no, $stop_id);
             $query->execute();
         } else {
             $error = $conn->errno . ' ' . $conn->error;
             echo $error; 
         }
      break;

      case "delete":
         $id = $_POST['id'];
         var_export($id);

         $sql = "DELETE FROM bus_stop WHERE stop_id=?";
         if($query = $conn->prepare($sql)) { 
            
            $stop_id = $_POST['id'];
            $query->bind_param('i', $stop_id);
            $query->execute();
         } else {
             $error = $conn->errno . ' ' . $conn->error;
             echo $error; 
         }
      break;
   }

?>