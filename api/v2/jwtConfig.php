<?php

/*************************************************************************
                                JWT MIDDLEWARE
*************************************************************************/
 
$container["jwt"] = function ($container) {
    return new StdClass;
};
$app->add(new \Slim\Middleware\JwtAuthentication([
    "environment" => "HTTP_X_TOKEN",
    "path" => ["/api"], /* or ["/api", "/admin"]  Protected paths */
    "passthrough" => ["/login","/not-secure"],  /* make exceptions to path parameter. */
    "secret" => getenv("JWT_SECRET") ,
    "header" => "X-Token",
    "secure" => false,
    "algorithm" => ["HS256", "HS384"],
    "callback" => function ($options) use ($container) {
        $container["jwt"] = $options["decoded"];
    },
    "error" => function ($options) use ($app) {
        $response["status"] = "error";
        $response["message"] = $options["message"];
        $app->response->header("Content-Type", "application/json");
        $app->response->write(json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
]));


?>