<?php

    
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
?>