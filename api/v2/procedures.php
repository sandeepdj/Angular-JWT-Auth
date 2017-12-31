<?php

$app->get('/', function () {
    echo "I am root";
});


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
 

$app->get("/secure",  function () use ($app) {
    //$name = $this->jwt->email;
    //echo  $name;
     $data = ["status" => 1, 'msg' => "I have token number ...Authorized"];
     echo   json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
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

//https://github.com/tuupola/slim-jwt-auth/issues/9
//https://github.com/tuupola/slim-jwt-auth/issues/13
//https://github.com/tuupola/slim-jwt-auth/issues/14