<?php
namespace app\controllers;
use Phalcon\Mvc\Controller;
use Phalcon\Logger;
use Phalcon\Logger\Adapter\File as FileAdapter;

class ServiceController extends Controller {
    // escaper 内容(HTML)转义  Phalcon\Escaper 
    // annotations 注释分析器   Phalcon\Annotations\Adapter\Memory  
    // modelsManager   model管理服务   Phalcon\Mvc\Model\Manager   
    // modelsMetadata  model元数据服务  Phalcon\Mvc\Model\MetaData\Memory   
    // transactionManager  model事务管理服务 Phalcon\Mvc\Model\Transaction\Manager
    // modelsCache model的缓存服务
    // viewsCache  view的缓存服务
    public function requestAction(){
//        $req = new \Phalcon\Http\Request();
        $req = $this->request;
//        if($req->getHeader("HTTP_X_REQUESTED_WITH")== 'XMLHttpRequest'){
//            echo "The request was made with Ajax";
//        }
//        $req->isAjax();
        $req->isSecureRequest();
        // Get the servers's IP address
        //echo $ipAddress = $req->getServerAddress();
        // Get the client's IP address
        //echo $ipAddress = $req->getClientAddress();
        // Get the User Agent (HTTP_USER_AGENT)
        //echo $userAgent = $req->getUserAgent();
        // Get the best acceptable content by the browser. ie text/xml
        //dump($contentType = $req->getAcceptableContent());
        // Get the best charset accepted by the browser. ie. utf-8
        //echo $charset = $req->getBestCharset();
        // Get the best language accepted configured in the browser. ie. en-us
        echo $language = $req->getBestLanguage();
    }
    public function responseAction(){
//        $res = new \Phalcon\Http\Response();
        $res = $this->response;
    }
    public function cookiesAction(){
        if($this->cookies->has('username')){
           dump($this->cookies->get('username')->getValue());
       } else {
            $this->cookies->set('username','liner.xie',time()+15);
        }
    }
    
    public function dispatcherAction(){
//        $this->dispatcher->
        $this->dispatcher->forward(array(
            'controller' => 'db',
            'action' => 'pages',
        ));
    }
    
    public function sessionAction(){}
    public function dbAction(){
        //$db = $this->db;
        dump($this->crypt);
    }
    public function routerAction(){
        $router = $this->router;
        $controller_name = $router->getControllerName();
        $action_name = $router->getActionName();
        echo $controller_name.'--'.$action_name;
    }
    public function urlAction(){}
    public function filterAction(){}
    //flashSession
    public function flashAction(){}
    public function securityAction(){}
    public function cryptAction(){}
    public function tagAction(){
//        $this->tag
    }

    //not as service
    public function persistentAction(){
        dump($this->persistent);
    }
    public function diAction(){
//        dump($this->getDI()->getServices());
        $services = $this->getDI()->getServices();
        foreach( $services as $k => $v ){
            dump($k).'<br />';
        }
    }
    public function logAction(){
        //log日志
        $logger = new FileAdapter(APP_PATH.'/app/logs/tests.log');
        $logger->critical('This is a critical messages');
        $logger->emergency("This is an emergency message");
        $logger->debug("This is a debug message");
        $logger->error("This is an error message");
        $logger->info("This is an info message");
        $logger->notice("This is a notice message");
        $logger->warning("This is a warning message");
        $logger->alert("This is an alert message");

        // You can also use the log() method with a Logger constant:
        $logger->log("This is another error message", Logger::ERROR);

        // If no constant is given, DEBUG is assumed.
        $logger->log("This is a message");
    }
}