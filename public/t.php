<?php

use Phalcon\Mvc\Micro;

$app = new Micro();

$app->get('/',function(){
    $response = new Phalcon\Http\Response();
    $response->setContentType('text/plain');
    $response->setContent(file_get_contents('data.txt'));
    return $response;
});
$app->handle();