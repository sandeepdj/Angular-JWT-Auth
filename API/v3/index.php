<?php
 
require 'vendor/autoload.php';
 
$app = new \Slim\App();

$app->add(new Tuupola\Middleware\CorsMiddleware([
    "origin" => ["*"],
    "methods" => ["GET", "POST", "PUT", "PATCH", "DELETE"],
    "headers.allow" => [],
    "headers.expose" => [],
    "credentials" => false,
    "cache" => 0,
]));


//slim application routes
$app->get('/', function ($request, $response, $args) { 
    $response->write("Welcome: This is AlphansoTech Tutorial Guide");
    return $response;
});


$app->get('/friends', function ($request, $response, $args) {
    $response->write("Hello Friends!");
    return $response;
});


$app->run();

