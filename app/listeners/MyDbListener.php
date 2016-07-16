<?php
namespace app\listeners;

use Phalcon\Db\Profiler;
//use Phalcon\Logger;
use Phalcon\Logger\Adapter\File as Logger;

class MyDbListener {
    protected $_profiler;
    protected $_logger;
    
    /**
    * Creates the profiler and starts the logging
    */
    public function __construct(){
        $this->_profiler = new Profiler();
        $this->_logger= new Logger("../app/logs/db.log");
    }
    
    /**
    * This is executed if the event triggered is 'beforeQuery'
    */
    public function beforeQuery($event, $connection){
        $this->_profiler->startProfile($connection->getSQLStatement());
    }
    
    /**
    * This is executed if the event triggered is 'afterQuery'
    */
    public function afterQuery($event, $connection){
        $this->_logger->log($connection->getSQLStatement(), \Phalcon\Logger::INFO);
        $this->_profiler->stopProfile();
    }
    
    public function getProfiler(){
        return $this->_profiler;
    }
}