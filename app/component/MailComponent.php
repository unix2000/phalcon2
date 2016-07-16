<?php
namespace app\component;
use Phalcon\Events\EventsAwareInterface;

class MailComponent implements EventsAwareInterface {
    protected $_eventsManager;
    
    public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){
        $this->_eventsManager = $eventsManager;
    }
    
    public function getEventsManager(){
        return $this->_eventsManager;
    }
    public function mailTask(){
        $this->_eventsManager->fire("mail-component:beforeSomeTask", $this);
        // Do some task
        echo "Here, mailTask <br />";
        $this->_eventsManager->fire("mail-component:afterSomeTask", $this);
    }
}