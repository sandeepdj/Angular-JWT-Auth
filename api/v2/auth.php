<?php
// Clients Database
function adminDb(){
  $host = "localhost";
  $user = "root";
  $pass= "";
  $db = "s_admin";
  $conna = mysqli_connect($host,$user,$pass, $db);
  return $conna;
}


  function getDBname(){
     
     if(isset($_SESSION['cldb'])) {
      $sess["cldb"] = $_SESSION['cldb'];
    }
  }

 function getSession(){
    if (!isset($_SESSION)) {
        session_start();
    }
    $sess = array();
    if(isset($_SESSION['cldb'])) {
        $sess["cldb"] = $_SESSION['cldb'];
        $sess['emid'] = $_SESSION['emid'];
        $sess['name'] = $_SESSION['name'];
        $sess['photo'] = $_SESSION['photo'];
  } else{
      $sess["cldb"] = '';
      $sess["emid"] = '';
      $sess["name"] = '';
      $sess["photo"] = '';
    }
    return $sess;
}




function getConnection(){
  
  $dbname = $_SESSION['cldb'];
  $host = "localhost";
  $user = "root";
  $pass= "";
 // $dbname = $session['cldb'];
  $conn = mysqli_connect($host,$user,$pass, $dbname);
  return $conn;
}

function token($name,$email){
    $now = new DateTime();
    $future = new DateTime("+10 minutes");
    $payload = [
      "email"=>$name,
      "iat" => $now->getTimeStamp(),
      "exp" => $future->getTimeStamp(),
      "sub"=>"Test for JWT"
   ];
    $secret = getenv("JWT_SECRET");
    $token = \Firebase\JWT\JWT::encode($payload, $secret, "HS256");

  return  $token;  
}

$app->post("/login", function ()  use ($app) {
    // get and decode JSON request body
    //$username = $app->request->post('username');
    //$password = $app->request->post('password');
    $request = $app->request();
    $body = $request->getBody();
    $input = json_decode($body); 
    $response=array();
    $username  = $input->username;
    $password  = $input->password;
    $scode  = $input->scode;
    $fyear = $input->fyear;
    $con = adminDb();
    $qry = "select cldb,clid,clnm from clients where clcode='$scode' AND fyear='$fyear'";
    $sql = mysqli_query($con,$qry) or die(mysqli_error($con));
    $count = mysqli_num_rows($sql);
    if($count==1){
        $adm = mysqli_fetch_assoc($sql);
        $dbnm = $adm['cldb'];
         session_start();
        $_SESSION['cldb'] =  $dbnm ;

        $conn =getConnection();
        $user = "select * from employee where uname='$username' AND password='$password'";
        $exec=mysqli_query($conn , $user) or die(mysqli_error($conn));
        $ucount = mysqli_num_rows($exec);
        if($ucount==1){
            $udata = mysqli_fetch_assoc($exec);
            $emid       =     $udata['emid'];
            $fname      =     $udata['fname'];
            $lname      =     $udata['lname'];
            $photo      =     $udata['photo'];
            $education  =     $udata['education'];

             $name = $fname. " ". $lname;
             $_SESSION['emid'] = $emid;
             $_SESSION['name'] = $name;
             $_SESSION['photo'] = $photo ;
            $email = "sandeep@gmail.com";
            $now = new DateTime();
            $future = new DateTime("+10 minutes");
            $token = token($name,$email);
            $response["token"] = $token;
            $response["expires"] = $future->getTimeStamp();
            $response['username']=$name;
            $response['photo']= $photo;
            $response['education']= $education;
            $response['session']=$_SESSION;

        }else{
           $_SESSION['cldb'] ='';
           $response['status']='error';
           $response['message']='Wrong login credentails';
           $response['user']="No user found";

        }
    }else{
       $response['status']='error';
       $response['message']='Wrong login credentails';
       $response['user']="No user found";
    }
    

 echoResponse(200,$response);

});
