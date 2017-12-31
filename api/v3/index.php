<?php
 
require 'vendor/autoload.php';
$app = new \Slim\App();
 
 


//slim application routes
$app->get('/', function ($request, $response, $args) { 
    $response->write("Welcome: This is AlphansoTech Tutorial Guide");
    return $response;
});


$app->get('/friends', function ($request, $response, $args) {
    $response->write("Hello Friends!");

    return $response;
});

$app->post('/friends', function ($request, $response, $args) {
    $request = $app->request();
    $body = $request->getBody();
    $input = json_decode($body);
   
    $name = $input->name;
    $lastname = $input->lastname;

   // $response->write("Hello Friends!");
    //return $response;

    var_dump($input );
});


$app->group('/books', function () use ($app) {
    $app->get('', function ($req, $res) {
    // Return list of books
    });
    $app->post('', function ($req, $res) {
    // Create a new book
    });
    $app->get('/{id:\d+}', function ($req, $res, $args) {
    // Return a single book
    });
    $app->put('/{id:\d+}', function ($req, $res, $args) {
    // Update a book
    });
});

$app->run();

