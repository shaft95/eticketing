<?php
// var_export("create");
// $driverName = $_POST['driverName'].$_POST['icNo'];
// var_export($driverName);die;

   // header('Access-Control-Allow-Origin: *');
   // include 'config.php';

   $databaseHost = 'localhost';
   $databaseName = 'etma';
   $databaseUsername = 'root';
   $databasePassword = '';

   // $conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
   $conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);

   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }

   // Define database connection parameters
   // $hn      = 'localhost';
   // $un      = 'id6445800_admin';
   // $pwd     = 'admin';
   // $db      = 'id6445800_etma';
   // $cs      = 'utf8';

   // // Set up the PDO parameters
   // $dsn  = "mysql:host=" . $hn . ";port=3306;dbname=" . $db . ";charset=" . $cs;
   // $opt  = array(
   //                      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
   //                      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
   //                      PDO::ATTR_EMULATE_PREPARES   => false,
   //                     );
   // // Create a PDO instance (connect to the database)
   // $pdo  = new PDO($dsn, $un, $pwd, $opt);

   // Retrieve specific parameter from supplied URL
   //$key  = strip_tags($_REQUEST['key']);
   $key = $_POST['key'];
   // $driverName = $_POST['driverName'].$_POST['icNo'];
   $data    = array();


   // Determine which mode is being requested
   switch($key)
   {

      // Add a new record to the technologies table
      case "create":
         // prepare and bind
         // $stmt = $conn->prepare("INSERT INTO busdriver (driverName, icNo) VALUES (?, ?)");
         // $stmt->bind_param("ss", $firstname, $lastname);
         
         $sql = "INSERT INTO busdriver (driver_name, ic_no) VALUES (?, ?)";
         if($query = $conn->prepare($sql)) { // assuming $mysqli is the connection
            $driverName = $_POST['driverName'];
            $icNo = $_POST['icNo'];
             $query->bind_param('ss', $driverName, $icNo);
             $query->execute();
             // any additional code you need would go here.
         } else {
             $error = $conn->errno . ' ' . $conn->error;
             echo $error; // 1054 Unknown column 'foo' in 'field list'
         }
         // set parameters and execute
         // $driverName = $_POST['driverName'];
         // $icNo = $_POST['icNo'];
         // $stmt->execute();

      break;

      // Update an existing record in the technologies table
      case "update":
         // $id = $_POST['id'];
         // var_export($id);

         $sql = "UPDATE busdriver SET driver_name=?, ic_no=? WHERE driver_id=?";
         if($query = $conn->prepare($sql)) { // assuming $mysqli is the connection
            $driverName = $_POST['driverName'];
            $icNo = $_POST['icNo'];
            $driver_id = $_POST['id'];
             $query->bind_param('ssi', $driverName, $icNo, $driver_id);
             $query->execute();
             // any additional code you need would go here.
         } else {
             $error = $conn->errno . ' ' . $conn->error;
             echo $error; // 1054 Unknown column 'foo' in 'field list'
         }
      break;



      // Remove an existing record in the technologies table
      case "delete":
         $id = $_POST['id'];
         var_export($id);

         $sql = "DELETE FROM busdriver WHERE driver_id=?";
         if($query = $conn->prepare($sql)) { // assuming $mysqli is the connection
            
            $driver_id = $_POST['id'];
            $query->bind_param('i', $driver_id);
            $query->execute();
             // any additional code you need would go here.
         } else {
             $error = $conn->errno . ' ' . $conn->error;
             echo $error; // 1054 Unknown column 'foo' in 'field list'
         }
         /*
        //INSERT INTO Cafeteria(cafe_Name, cafe_pw) VALUES(:name, :password)
         // Sanitise supplied record ID for matching to table record
         $recordID   =  filter_var($_REQUEST['recordID'], FILTER_SANITIZE_NUMBER_INT);

         // Attempt to run PDO prepared statement
         try {
            $pdo  = new PDO($dsn, $un, $pwd);
            $sql  = "DELETE FROM Menu WHERE food_id = :recordID";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':recordID', $recordID, PDO::PARAM_INT);
            $stmt->execute();

            echo json_encode('Congratulations the record ' . $name . ' was removed');
         }
         
         // Catch any errors in running the prepared statement
         catch(PDOException $e)
         {
            echo $e->getMessage();
         }
*/
      break;
   }

?>