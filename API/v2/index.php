<?php
require 'vendor/autoload.php';

// Set the current mode
$app = new \Slim\Slim(array(
    'mode' => 'development'
));

/*** 
 //CAN BE USED FOR headers options
$corsOptions = array(
    "origin" => "*",
    "exposeHeaders" => array("X-My-Custom-Header", "X-Another-Custom-Header"),
    "maxAge" => 1728000,
    "allowCredentials" => True,
    "allowMethods" => array("POST, GET"),
    "allowHeaders" => array("X-PINGOTHER")
    );
$cors = new \CorsSlim\CorsSlim($corsOptions);

*/

$app->add(new \CorsSlim\CorsSlim());


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

/*
    //Alternative to above 2 modes
    $_ENV['SLIM_MODE'] = 'production';
*/


require 'procedures.php';

$app->run();