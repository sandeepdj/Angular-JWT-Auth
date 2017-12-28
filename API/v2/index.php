<?php
require 'vendor/autoload.php';
$app = new \Slim\Slim();

// $corsOptions = array(
//     "origin" => "*",
//     "exposeHeaders" => array("X-My-Custom-Header", "X-Another-Custom-Header"),
//     "maxAge" => 1728000,
//     "allowCredentials" => True,
//     "allowMethods" => array("POST, GET"),
//     "allowHeaders" => array("X-PINGOTHER")
//     );
// $cors = new \CorsSlim\CorsSlim($corsOptions);


$app->add(new \CorsSlim\CorsSlim());


$app->get('/hello/:name', function ($name) {
    echo "Hello, " . $name;
});



$app->run();