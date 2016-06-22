<?php
$router = new \Phalcon\Mvc\Router(false);

$router->removeExtraSlashes(true);

$router->add('/admin',array(
    'module' => 'admin',
    'controller' => 'index',
    'action' => 'index'
));

$router->add('/:module/:controller/:action/:params', array(
    'module' => 1,
    'controller' => 2,
    'action' => 3,
    'params' => 4
));