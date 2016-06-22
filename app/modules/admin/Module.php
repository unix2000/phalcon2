<?php
namespace app\modules\admin;

use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Events\Manager as EventsManager;
use apps\admin\listeners\DispatcherListener;

class Module implements ModuleDefinitionInterface {
    public function registerAutoloaders(\Phalcon\DiInterface $di=null){
        $loader = new \Phalcon\Loader();
        $loader->registerNamespaces(array(
            'app\modules\admin\controllers' => APP_PATH . '/app/modules/admin/controllers/',
            'app\modules\admin\models' => APP_PATH . '/app/modules/admin/models/',
        ));
        $loader->register();
    }   
    
    public function registerServices(\Phalcon\DiInterface $di=null){
        $di->set('dispatcher', function() {       
            $dispatcher = new \Phalcon\Mvc\Dispatcher();        
            //Attach a event listener to the dispatcher
            $eventManager = new \Phalcon\Events\Manager();         
 			$eventManager->attach( 'dispatch', new DispatcherListener() );
 				
 			$dispatcher->setEventsManager( $eventManager );
 			$dispatcher->setDefaultNamespace( "app\\modules\admin\\controllers\\" );
 			return $dispatcher;
        });
    }
}