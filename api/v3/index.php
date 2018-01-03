<?php
 use \Psr\Http\Message\ServerRequestInterface as Request;
 use \Psr\Http\Message\ResponseInterface as Response;
 use Monolog\Logger;
 use Monolog\Handler\RotatingFileHandler;
 use \Firebase\JWT\JWT;
 use  \Tuupola\Base62;
 

 require 'vendor/autoload.php';
 


 $app = new \Slim\App();

 

 $logger = new Logger("slim");
$rotating = new RotatingFileHandler(__DIR__ . "/logs/slim.log", 0, Logger::DEBUG);
$logger->pushHandler($rotating);


 $container = $app->getContainer();
 $container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler('../logs/app.log');
    $logger->pushHandler($file_handler);
    return $logger;
};

// $container['db'] = function ($c) {
//     $db = $c['settings']['db'];
//     $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
//         $db['user'], $db['pass']);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
//     return $pdo;
// };

$app->add(new \Slim\Middleware\JwtAuthentication([
    "path" => ["/books","/hello"],
    "logger" => $logger,
    "passthrough" => ["/login"],
    "secret" => "supersecretkeyyoushouldnotcommittogithub",
    "algorithm" => ["HS256", "HS384"],
    "callback" => function ($request, $response, $arguments) use ($container) {
        $container["jwt"] = $arguments["decoded"];
    },
    "error" => function ($request, $response, $arguments) {
        $data["status"] = "error";
        $data["message"] = $arguments["message"];
        return $response
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
]));




$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});


$app->get('/token', function (Request $request, Response $response, array $args) {
    $now = new DateTime();
    $future = new DateTime("now +2 hours");

     // $jti = $base62->encode(987654321); 

    $jti = new Base62(["characters" => Base62::GMP]);
    // $jti = Base62::encode(123456578);
    $secret = "supersecretkeyyoushouldnotcommittogithub";
    $payload = [
        "jti" => $jti,
        "iat" => $now->getTimeStamp(),
        "nbf" => $future->getTimeStamp()
    ];
    $token = JWT::encode($payload, $secret, "HS256");
    return $token;
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

