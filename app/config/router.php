<?php
use Phalcon\Mvc\Router;
// $router = new \Phalcon\Mvc\Router(false);
$router = new Router(false);
$router->removeExtraSlashes(true);

$router->add('/admin',array(
    'module' => 'admin',
    'controller' => 'index',
    'action' => 'index'
));

$router->add('/:controller/:action/:params', array(
    'controller' => 1,
    'action' => 2,
    'params' => 3
));

$router->add('/:module/:controller/:action/:params', array(
    'module' => 1,
    'controller' => 2,
    'action' => 3,
    'params' => 4
));

$router->add(
	'/abc/db/p',
	array(
		"module" => 'admin',
		"controller" => "index",
		"action" => "index"
	)
);

$router->add(
    '/db/pages',
    [
        'controller' => 'db',
        'action' => 'pages'
    ]
);

// $router->setDefaultModule( 'admin' );
// $router->setDefaultController( 'index' );
// $router->setDefaultAction( 'index' );