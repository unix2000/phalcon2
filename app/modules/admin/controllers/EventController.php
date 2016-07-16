<?php
namespace app\modules\admin\controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use app\listeners\MyDbListener;
use app\component\MyComponent;
use app\listeners\SomeListener;

class EventController extends Controller {
    public function indexAction(){
        //no set injector
        $eventsManager = new EventsManager();
        // Create a database listener
        $dbListener = new MyDbListener();
        
        // Listen all the database events
        $eventsManager->attach('db', $dbListener);
        
        $connection = new DbAdapter(
            array(
                "host" => "localhost",
                "username" => "root",
                "password" => "root",
                "dbname" => "phalcon2"
            )
        );
        // Assign the eventsManager to the db adapter instance
        $connection->setEventsManager($eventsManager);
        
        $connection->execute("SELECT * FROM items p WHERE p.types_id = 0");
        foreach ($dbListener->getProfiler()->getProfiles() as $profile) {
            echo "SQL Statement: ", $profile->getSQLStatement(), "<br />";
            echo "Start Time: ", $profile->getInitialTime(), "<br />";
            echo "Final Time: ", $profile->getFinalTime(), "<br />";
            echo "Total Elapsed Time: ", $profile->getTotalElapsedSeconds(), "<br />";
        }       
    }
    public function componentAction(){
        // Create an Events Manager
        $eventsManager = new EventsManager();
        
        // Create the MyComponent instance
        $myComponent= new MyComponent();
        
        // Bind the eventsManager to the instance
        $myComponent->setEventsManager($eventsManager);
        
        // Attach the listener to the EventsManager
        $eventsManager->attach('my-component', new SomeListener());
        
        // Execute methods in the component
        $myComponent->someTask();
    }
}