<?php
use Phalcon\Loader;
use PhalconRest\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url;
use Phalcon\Mvc\Application;

try {
	$loader = new Loader();
	$loader->registerDirs(array(
		'../app/controllers/',
		'../app/model/',
	))->register();

	$di = new FactoryDefault();
	$di->set('view',function(){
		$view = new View();
		$view->setViewsDir('../app/views/');
		return $view;
	});
	
	$di->set('url',function(){
		$url = new Url();
		$url->setBasePath('/');
		return $url;
	});

	$app = new Application($di);
	echo $app->handle()->getContent();

} catch (\Exception $e) {
	 echo "Exception:", $e->getMessage();
}