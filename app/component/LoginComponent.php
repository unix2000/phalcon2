<?php
namespace app\component;
use Phalcon\Events\EventsAwareInterface;

class LoginComponent implements EventsAwareInterface {
    protected $_eventsManager;
    
    public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){
        $this->_eventsManager = $eventsManager;
    }
    
    public function getEventsManager(){
        return $this->_eventsManager;
    }
    public function loginTask(){
        $this->_eventsManager->fire("login-component:beforeSomeTask", $this);
        // Do some task
        echo "Here, loginTask <br />";
        $this->_eventsManager->fire("login-component:afterSomeTask", $this);
    }
}