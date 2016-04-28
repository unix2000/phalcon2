<?php

use Phalcon\Mvc\Micro;

$app = new Micro();
function say_hello($name) {
    echo "<h1>Hello! $name</h1>";
}
$app->get('/', function () {
    echo "<h1>Welcome!</h1>";
});
$app->get('/show/data',function(){
    $response = new Phalcon\Http\Response();
    $response->setContentType('text/plain');
    $response->setContent(file_get_contents('data.txt'));
    return $response;
});
$app->get('/say/hellos/{name}', function ($name) use ($app) {
    echo "<h1>Hello! $name</h1>";
    echo "Your IP Address is ", $app->request->getClientAddress();
});

$app->get('/say/hello/{name}', "say_hello");

$app->post('/store/something', function () use ($app) {

    $name = $app->request->getPost('name');

    echo "<h1>Hello! $name</h1>";
});

$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo 'This is crazy, but this page was not found!';
});

$app->handle();