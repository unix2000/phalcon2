<?php
namespace app\modules\sys;

use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Events\Manager as EventsManager;
use apps\user\listeners\DispatcherListener;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;

class Module implements ModuleDefinitionInterface {
    public function registerAutoloaders(\Phalcon\DiInterface $di=null){
        $loader = new \Phalcon\Loader();
        $loader->registerNamespaces(array(
            'app\modules\sys\controllers' => APP_PATH . '/app/modules/sys/controllers/',
            'app\modules\sys\models' => APP_PATH . '/app/modules/sys/models/',
        ));
        $loader->register();
    }   
    
    public function registerServices(\Phalcon\DiInterface $di=null){
        $di->set('dispatcher', function() {       
            $dispatcher = new \Phalcon\Mvc\Dispatcher();        
 			$dispatcher->setDefaultNamespace( "app\\modules\sys\\controllers\\" );
 			return $dispatcher;
        });

        $di->set('view', function() {
            $view = new \Phalcon\Mvc\View();
            $view->setViewsDir(APP_PATH . '/app/modules/sys/views/');
            $view->registerEngines(array(
                    '.volt' => function ($view, $di) {
                        $volt = new VoltEngine($view, $di);
                        $volt->setOptions(array(
                                'compiledPath' => APP_PATH . '/app/modules/sys/cache/',
                                'compiledSeparator' => '_',
                                'compileAlways' => true
                        ));
                        return $volt;
                    },
                //  '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
                ));
            return $view;
        });
    }
}