<?php
// session_start();
        
  
 
  echoResponse(200, $_SESSION);

  //$dbname = $_SESSION['cldb'];
  $host = "localhost";
  $user = "root";
  $pass= "";
 // $dbname = $session['cldb'];
  $conn = mysqli_connect($host,$user,$pass);
  //return $conn;


?>
