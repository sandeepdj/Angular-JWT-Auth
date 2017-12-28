<?php


$app->get('/hello/:name', function ($name) {
    echo "Hello, " . $name;
});

$app->get('/books/:id', function ($id) {
    echo "Hello, Book Id" . $id;
});

$app->get('/books/:one/:two', function ($one, $two) {
    echo "The first parameter is " . $one;
    echo "The second parameter is " . $two;
});

$app->get('/archive(/:year(/:month(/:day)))', function ($year = 2010, $month = 12, $day = 05) {
    echo sprintf('%s-%s-%s', $year, $month, $day);
});


$app->post('/books', function () {
    //Create book
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
    
            });
    
            // Update book with ID
            $app->put('/books/:id', function ($id) {
    
            });
    
            // Delete book with ID
            $app->delete('/books/:id', function ($id) {
    
            });
    
        });
    
});

