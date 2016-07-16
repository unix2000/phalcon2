<?php
namespace app\component;
use Phalcon\Events\EventsAwareInterface;

class MyComponent implements EventsAwareInterface {
    protected $_eventsManager;
    
    public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){
        $this->_eventsManager = $eventsManager;
    }
    
    public function getEventsManager(){
        return $this->_eventsManager;
    }
    public function someTask(){
        $this->_eventsManager->fire("my-component:beforeSomeTask", $this);
        // Do some task
        echo "Here, someTask <br />";
        $this->_eventsManager->fire("my-component:afterSomeTask", $this);
    }
}