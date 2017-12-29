<?php
require 'vendor/autoload.php';

// Set the current mode
$app = new \Slim\Slim(array(
    'mode' => 'development' ,
    'JWT_SECRET'=>"supersecretkeyyoushouldnotcommittogithub"
));

 
 
 $corsOptions = array(
        "origin" => "*",
        "exposeHeaders" => array("X-My-Custom-Header", "X-Another-Custom-Header"),
        "maxAge" => 1728000,
        "allowCredentials" => True,
        "allowMethods" => array("POST, GET,PUT, PATCH, DELETE,"),
        "allowHeaders" => array("Origin, X-Requested-With, Content-Type, Accept")
);


$app->add(new \CorsSlim\CorsSlim($corsOptions));
 


//$app->add(new \CorsSlim\CorsSlim());

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
 
/*************************************************************************
                                JWT MIDDLEWARE
*************************************************************************/
 

$app->add(new \Slim\Middleware\JwtAuthentication([
    "path" => "/api", /* or ["/api", "/admin"]  Protected paths */
    "passthrough" => ["/login","/not-secure"],  /* make exceptions to path parameter. */
    "secret" => getenv("JWT_SECRET") ,
    "algorithm" => ["HS256", "HS384"]
]));


function echoResponse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);
    // setting response content type to json
    $app->contentType('application/json');

    echo json_encode($response);
}



require 'procedures.php';

$app->run();