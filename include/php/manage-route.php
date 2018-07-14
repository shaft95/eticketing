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
         $stop_id = $_POST['stop_id'];
         $no_stop = explode("/", $stop_id);
         $no_stop = count($no_stop);
         var_export($no_stop);
         $sql = "INSERT INTO route (route_code, stop_id, no_stop) VALUES (?, ?, ?)";
         if($query = $conn->prepare($sql)) { // assuming $mysqli is the connection
            $route_code = $_POST['route_code'];
            
            // $no_stop = $_POST['no_stop'];
             $query->bind_param('ssi', $route_code, $stop_id, $no_stop);
             $query->execute();
         } else {
             $error = $conn->errno . ' ' . $conn->error;
             echo $error; 
         }

      break;

      // Update an existing record in the technologies table
      case "update":
         $stop_id = $_POST['stop_id'];
         // var_export($stop_id);
         $no_stop = explode("/", $stop_id);
         $no_stop = count($no_stop);
         $sql = "UPDATE route SET route_code=?, stop_id=?, no_stop=? WHERE route_id=?";
         if($query = $conn->prepare($sql)) { // assuming $mysqli is the connection
            $route_code = $_POST['route_code'];
            $route_id = $_POST['id'];
             $query->bind_param('ssii', $route_code, $stop_id, $no_stop, $route_id);
             $query->execute();
         } else {
             $error = $conn->errno . ' ' . $conn->error;
             echo $error; 
         }
      break;

      case "delete":
         $id = $_POST['id'];
         var_export($id);

         $sql = "DELETE FROM route WHERE route_id=?";
         if($query = $conn->prepare($sql)) { 
            
            $route_id = $_POST['id'];
            $query->bind_param('i', $route_id);
            $query->execute();
         } else {
             $error = $conn->errno . ' ' . $conn->error;
             echo $error; 
         }
      break;
   }

?>