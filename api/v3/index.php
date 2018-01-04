<?php
 
 use Monolog\Logger;
 use Monolog\Handler\RotatingFileHandler;
 use \Firebase\JWT\JWT;
<<<<<<< HEAD
 use  \Tuupola\Base62;


require 'vendor/autoload.php';
$app = new \Slim\App(array( 'debug' => true ));
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});
=======
 use  Tuupola\Base62;
 use DateTime;
 
 
 require 'vendor/autoload.php';
 
 $app = new \Slim\App();
>>>>>>> fc8106df357b27df4b94eae0348f028d43f8ce20

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
 
$app->add(new \Slim\Middleware\JwtAuthentication([
<<<<<<< HEAD
    "path" => ["/books","/modules"],
    "logger" => $logger,
=======
    
    "path" => ["/books","/test"],
>>>>>>> fc8106df357b27df4b94eae0348f028d43f8ce20
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

<<<<<<< HEAD
$app->get('/hello/{name}', function ($request, $response, $args) {
=======



$app->get('/hello', function (Request $request, Response $response, array $args) {
    $name = "SANDEEP JADHAV";
    $response->getBody()->write("Hello, $name");
    return $response;
});



$app->get('/test/{name}', function (Request $request, Response $response, array $args) {
>>>>>>> fc8106df357b27df4b94eae0348f028d43f8ce20
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});

<<<<<<< HEAD
function token($emid,$name,$dbnm){
    $now = new DateTime();
    $future = new DateTime("now +2 hours");
    $jti = new Base62(["characters" => Base62::GMP]);
    $secret = "supersecretkeyyoushouldnotcommittogithub";
=======


$app->get('/token', function (Request $request, Response $response, array $args) {
    $now = new DateTime();
    $future = new DateTime("now +2 hours");
    $future1 = new DateTime("now +3 hours");
    $jti = new Base62(["characters" => Base62::GMP]);
     $secret = "supersecretkeyyoushouldnotcommittogithub";

 
    
>>>>>>> fc8106df357b27df4b94eae0348f028d43f8ce20
    $payload = [
        "emid" =>$emid,
        "ename"=>$name,
        "dbname"=>$dbnm,
        "jti" => $jti,
        "nbf"=>$future1->getTimeStamp(),
        "iat" => $now->getTimeStamp(),
        "exp" => $future->getTimeStamp(),
    ];
<<<<<<< HEAD
    JWT::$leeway = 5;
    $token = JWT::encode($payload, $secret, "HS256");
=======
    JWT::$leeway = 60; // $leeway in seconds
     $token = JWT::encode($payload, $secret, "HS256");
>>>>>>> fc8106df357b27df4b94eae0348f028d43f8ce20
    return $token;
}

$app->get('/token', function ($request, $response, $args) {
    $token  = token();
    echo $token;

});

function adminDb(){
    $host="localhost";
    $user = "root";
    $pass="";
    $db="s_admin";
    $con = mysqli_connect($host,$user,$pass,$db);
    return $con;
}

function getConnection($dbname){
    $host="localhost";
    $user = "root";
    $pass="";
    $db=$dbname;
    $conn = mysqli_connect($host,$user,$pass,$db);
    return $conn;
}


$app->post('/login', function ($request, $response, $args) use ($app) {
    //$token  = token();
    $response=array();
    $data = $request->getParsedBody();
    $username = $data['username'];
    $password = $data['password'];
    $scode= $data['scode'];
    $fyear = $data['fyear'];
    $con = adminDb();
    $qry = "select cldb,clid,clnm from clients where clcode='$scode' AND fyear='$fyear'";
    $sql = mysqli_query($con,$qry) or die(mysqli_error($con));
    $count = mysqli_num_rows($sql);
    if($count==1){
        $adm = mysqli_fetch_assoc($sql);
        $dbnm = $adm['cldb'];
        mysqli_next_result($con);
        $conn  = getConnection($dbnm);
        $user = "select * from employee where uname='$username' AND password='$password'";
        $exec=mysqli_query($conn , $user) or die(mysqli_error($conn));
        $ucount = mysqli_num_rows($exec);
        if($ucount==1){
            $udata = mysqli_fetch_assoc($exec);
            $emid       =     $udata['emid'];
            $fname      =     $udata['fname'];
            $lname      =     $udata['lname'];
            $photo      =     $udata['photo'];
            $education  =     $udata['education'];
            $name = $fname. " ". $lname;
             $email = "sandeep@gmail.com";
             $token  = token($emid,$name,$dbnm);
             $response["token"] = $token;
              $response['username']=$name;
             $response['photo']= $photo;
             $response['education']= $education;
        }else{
            $response['status']='error';
            $response['message']='Wrong login credentails';
            $response['user']="No user found";
        }
    }else{
        $response['status']='error';
        $response['message']='School code wrong';
        $response['user']="No user found";
    }
    echo json_encode($response); 

//echoResponse(200,$response);
});
 
$app->get('/modules',function($request, $response, $args){

     $db = $this->jwt->dbname;
        $conn = getConnection($db);

      //$conn =getConnection();
    $refs = array();
    $list = array();
    $sql ="select * from menus where active='Yes'";
    $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    while($data = mysqli_fetch_assoc($result)) {
        $thisref = &$refs[ $data['mid'] ];
        $thisref['mnm'] = $data['mnm'];
        $thisref['url'] = $data['url'];
        $thisref['icon'] = $data['icon'];
         $thisref['parent_id'] = $data['pid'];
        if ($data['pid'] == 0) {
            $list[  ] = &$thisref;
        } else {
            $refs[ $data['pid'] ]['children'][] = &$thisref;
        }
    }
    $mylist["data"] = $list;
echo json_encode($mylist);
});



$app->group('/books', function () use ($app) {
<<<<<<< HEAD
    $app->get('', function ($request, $response, $args) {
        $response = array();
        $db = $this->jwt->dbname;
        $conn = getConnection($db);
        $user = "select * from employee ";
        $exec=mysqli_query($conn , $user) or die(mysqli_error($conn));
        while($row = mysqli_fetch_assoc($exec)){
              $response['users'][] = $row;
        }
        //$response['users'][] = $_SESSION;
        echo json_encode($response);

        //var_dump($response);
    });
    $app->post('', function ($request, $response, $args) {
        // Create a new book
    });
    $app->get('/{id:\d+}', function ($request, $response, $args) {
        // Return a single book
    });
    $app->put('/{id:\d+}', function ($request, $response, $args) {
=======
    $app->get('', function (Request $request, Response $response, array $args) {
        $name ="Books Root";
        $response->getBody()->write("I'm in , $name");
        return $response;
    });
    $app->post('', function (Request $request, Response $response, array $args) {
        // Create a new book
    });
    $app->get('/{id:\d+}', function (Request $request, Response $response, array $args) {
        // Return a single book
    });
    $app->put('/{id:\d+}', function (Request $request, Response $response, array $args) {
>>>>>>> fc8106df357b27df4b94eae0348f028d43f8ce20
        // Update a book
    });
});

$app->run();

