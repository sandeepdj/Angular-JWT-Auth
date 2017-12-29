<?php

$app->get('/hello/:name', function ($name) {
    echo "Hello, " . $name;
});
$app->get('/books/:id', function ($id) {
    echo "Hello, Book Id" . $id;
});
$app->get('/books/:one/:two', function ($one, $two) {
    echo "The first parameter is " . $one;
    echo "The second parameter is " . $two;
});

$app->get("/not-secure",  function () {
    $data = ["status" => 1, 'msg' => "No need of token to access me"];
    echo   json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
});
 
$app->post("/login", function ()  use ($app) {
     // get and decode JSON request body
     $request = $app->request();
     $body = $request->getBody();
     $input = json_decode($body); 
     $username  = $input->username;
     $password  = $input->password;
     $response=array();
    if($username=="sandeep" &&  $password =="admin"){
        // $response['status']='success';
        
        
            $now = new DateTime();
            $future = new DateTime("+10 minutes");
           // $server = $request->getServerParams();
           // $jti = (new Base62)->encode(random_bytes(16));
            $payload = [
                "iat" => $now->getTimeStamp(),
                "exp" => $future->getTimeStamp(),
                "sub"=>"Test for JWT"
                 
            ];
            $secret = "123456789helo_secret";
            $token = JWT::encode($payload, $secret, "HS256");
            $response["token"] = $token;
            $response["expires"] = $future->getTimeStamp();



    }else{
        $response['status']='error';
        $response['message']='Wrong login credentails';
        $response['user']="F".$username.$password;
    }

     //var_dump($username );
  echoResponse(200,$response);
  
});

// API group
// GET    /api/library/books/:id
// PUT    /api/library/books/:id
// DELETE /api/library/books/:id


$app->group('/api', function () use ($app) {
    
        // Library group
        $app->group('/library', function () use ($app) {
    
            // Get book with ID
            $app->get('/books/:id', function ($id) {
                echo "The second parameter is " . $id;
            });
    
            // Update book with ID
            $app->put('/books/:id', function ($id) {
    
            });
    
            // Delete book with ID
            $app->delete('/books/:id', function ($id) {
    
            });
    
        });
    
});

