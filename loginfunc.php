<?php
//   header('Access-Control-Allow-Origin: *');

   // Define database connection parameters
  $hn      = 'localhost';
  $un      = 'root';
  $pwd     = '';
  $db      = 'etma';
//   $cs      = 'utf8';
  $username = $_POST['username'];
    $password = $_POST['password'];
    
   $mysqli = new mysqli($hn, $un , $pwd , $db);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    
    if (!$mysqli->query("DROP TABLE IF EXISTS test") ||
        !$mysqli->query("CREATE TABLE test(id INT, label CHAR(1))") ||
        !$mysqli->query("INSERT INTO test(id, label) VALUES (1, 'a')")) {
        echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    //echo "SELECT passenger_id, password FROM passenger WHERE username = ".$username;
    
    $stmt = $mysqli->prepare("SELECT passenger_id, password FROM passenger WHERE username = '".$username."'");
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();

    if($row['passenger_id']==null){
      $modal_title = "Error";
        $html =<<< HTML
        <div class="alert alert-danger" role="alert">
          invalid username
        </div>

HTML;

        $script ="setTimeout(function () {window.location.href = 'login.html'}, 2000);";
    }
    else if($row['password']!=$password)
    {
      $modal_title = "Error";
        $html =<<< HTML
        <div class="alert alert-danger" role="alert">
          invalid password
        </div>
HTML;
        $script ="setTimeout(function () {window.location.href = 'login.html'}, 2000);";
    }
    else{
      $modal_title = "Success";
      $html =<<< HTML
        
        <div class="alert alert-success" role="alert">
          Success!
        </div>
HTML;
      $script ="setTimeout(function () {window.location.href = 'index.html'}, 2000);";

      session_start();
      $_SESSION["id"] = $row['passenger_id'];

    
    }
    // printf("id = %s (%s)\n", $row['passenger_id'], gettype($row['passenger_id']));
    // printf("label = %s (%s)\n", $row['password'], gettype($row['password']));

    $html =<<< HTML
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
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <!-- <link rel="stylaesheet" href="css/welcome.css"> -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body onload="getResult()">
    <div class="container">
      <h2 align="center">$html</h2>
      <h2 align="center">Please wait</h2>
      <div class="progress">
          <div class="progress-bar progress-bar-striped active" role="progressbar"
          aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
           
        </div>
            <!-- Button trigger modal -->
        
      </div>
      <!-- Modal -->  
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">$modal_title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              $html
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
  


    </div>

    <script>
    function getResult() {
        $script
    }

    //$('#myModal').modal('show'); 
    </script>
    </body>
</html>

HTML;
    
    echo $html;
?>
    
      
    


