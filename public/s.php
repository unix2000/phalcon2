<?php
use Phalcon\Loader;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\Application;

try {
    $loader = new Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/',   
    ))->register();
    
    $di = new FactoryDefault();
    $di->set('view', function (){
        $view = new View();
        $view->setViewsDir('../app/views/');
        return $view; 
    });
    
    $di->set('url', function (){
       $url = new UrlProvider();
       $url->setBasePath('/');
       return $url;
    });
    
    $app = new Application($di);
    echo $app->handle()->getContent();
} catch (\Exception $e) {
    echo "Exception:", $e->getMessage();    
}