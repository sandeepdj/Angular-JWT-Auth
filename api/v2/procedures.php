<?php
 
$app->get('/', function () {
    echo "I am root";
});

 
$app->get("/not-secure",  function () {
    $data = ["status" => 1, 'msg' => "No need of token to access me"];
    echo   json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
});
 

$app->get("/secure",  function () use ($app) {
    //$name = $this->jwt->email;
    //echo  $name;
    //print_r($app->jwt);
    
      //$data = ["status" => 1, 'msg' => "I have token number ...Authorized","sesss"=>$cldb];
      echo   json_encode($app, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
});


$app->get('/modules',function(){
        $conn =  getConnection();
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
    echoResponse(200, $mylist);
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