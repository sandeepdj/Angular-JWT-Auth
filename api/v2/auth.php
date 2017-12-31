<?php
$app->post("/login", function ()  use ($app) {
    // get and decode JSON request body
    $request = $app->request();
    $body = $request->getBody();
    $input = json_decode($body); 
    $response=array();

    $username  = $input->username;
    $password  = $input->password;
    //$username = $app->request->post('username');
    //$password = $app->request->post('password');
   if($username=="sandeep" &&  $password =="admin"){
        $now = new DateTime();
        $future = new DateTime("+10 minutes");
        // $server = $request->getServerParams();
       //$jti = \Tuupola\Base62::encode(random_bytes(16));
           $payload = [
               "email"=>"example@gmail.com",
               "iat" => $now->getTimeStamp(),
               "exp" => $future->getTimeStamp(),
               "sub"=>"Test for JWT"
                
           ];
          $secret = getenv("JWT_SECRET");
          $token = \Firebase\JWT\JWT::encode($payload, $secret, "HS256");
          
          // $token = JWT::encode($payload, $secret, "HS256");
          
         // $token = JWT::encode($payload, $secret, "HS256");
           $response["token"] = $token;
           $response["expires"] = $future->getTimeStamp();
           $response['username']=$username.$password.$secret;

   }else{
       $response['status']='error';
       $response['message']='Wrong login credentails';
       $response['user']="F".$username.$password;
   }


 echoResponse(200,$response);
 
});
