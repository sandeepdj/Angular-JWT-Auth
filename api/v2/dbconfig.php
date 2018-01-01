<?php
 
        
  

  $dbname = $_SESSION['cldb'];
  $host = "localhost";
  $user = "root";
  $pass= "";
 // $dbname = $session['cldb'];
  $conn = mysqli_connect($host,$user,$pass, $dbname);
  return $conn;


?>
