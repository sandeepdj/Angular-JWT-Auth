<?php
function adminDb(){
    $host="localhost";
    $user = "root";
    $pass="";
    $db="s_admin";
    $con = mysqli_connect($host,$user,$pass,$db);
    return $con;
}

function getConnection($dbname){
    $host="localhost";
    $user = "root";
    $pass="";
    $db=$dbname;
    $conn = mysqli_connect($host,$user,$pass,$db);
    return $conn;
}

?>