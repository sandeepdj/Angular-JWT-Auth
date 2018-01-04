<?php

require 'vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Tuupola\Base62;
 
$container = new \Slim\Container;

// Set the current mode
$app = new \Slim\Slim(array(
    'mode' => 'development' ,
    'JWT_SECRET'=>"@2017@#isthehidden@key"
));
 
$corsOptions = array(
        "origin" => "*",
        "exposeHeaders" => array("X-My-Custom-Header", "X-Another-Custom-Header"),
        "maxAge" => 1728000,
        "allowCredentials" => True,
        "allowMethods" => array("POST, GET,PUT, PATCH, DELETE,"),
        "allowHeaders" => array("Origin, X-Requested-With, Content-Type, Accept,Authorization")
);

$app->add(new \CorsSlim\CorsSlim($corsOptions));
// Only invoked if mode is "production"
$app->configureMode('production', function () use ($app) {
    $app->config(array(
        'log.enable' => true,
        'debug' => false
    ));
});

// Only invoked if mode is "development"
$app->configureMode('development', function () use ($app) {
    $app->config(array(
        'log.enable' => false,
        'debug' => true
    ));
});
 



function echoResponse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);
    // setting response content type to json
    $app->contentType('application/json');

    echo json_encode($response);
}


 
require_once 'jwtConfig.php';
require_once 'auth.php';
require_once 'procedures.php';

$app->run();