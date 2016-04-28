<?php
namespace app\controllers;
// use Phalcon\Config;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
// use Phalcon\Events\Manager as EventsManager;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Mvc\Model\Query;
use app\models\Items;
use app\models\Types;

class DbController extends \Phalcon\Mvc\Controller {
    public function onConstruct(){
        echo "<h1>onConstruct</h1>";
    }
//     public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher){
//         echo '<h1>beforeExecuteRoute</h1>';
//     }
//      public function afterExecuteRoute(Event $event, Dispatcher $dispatcher){
//         echo '<h1>afterExecuteRoute</h1>';
//     }
    public function cacheAction(){
        // Check whether the cache with key "downloads" exists or has expired
//         if ($this->view->getCache()->exists('downloads')) {
//             // Query the latest downloads
//             $latest = Downloads::find(array('order' => 'created_at DESC'));     
//             $this->view->latest = $latest;
//         }      
//         // Enable the cache with the same key "downloads"
//         $this->view->cache(array('key' => 'downloads'));
        
        $cache_key = 'cache-keys';
        if(!$this->view->getCache()->exists($cache_key)){
            //read db
            $data = Items::findFirst(11);
            //$this->view->setVar('title',$data->title);
            $this->view->cache(array($cache_key => $data->title,'lifetime' => 15));
        }
        dump($this->view->getCache()->get($cache_key));
    }
    public function indexAction()
    {
//        dump($this->request);
//        echo "<br />";
//        dump($this->response);
//        echo "<br />";
//        dump($this->view);
        //dump($this->di);
        $this->dispatcher->forward(array(
            'controller' => 'db',
            'action' => 'random',
        ));
    }
    public function sessionAction(){
        $this->session->set('username','xiaolin');
        dump($this->session->get('username'));
        $this->session->remove('username');
        if($this->session->has('username')){
            echo 'session is exists';
        } else {
            echo "remove session" . $this->session->get('username');
        }
    }
    public function cookiesAction(){
        dump($this->cookies);
    }
    public function requestAction(){
        dump($this->request);
    }
    public function responseAction(){
        dump($this->response);
    }
    public function viewAction(){
        dump($this->view);
    }
    public function randomAction(){
        $random = new \Phalcon\Security\Random();
        //$bytes = $random->bytes();
        $hex = $random->hex(22);
        $base64 = $random->base64(64);
        $base64safe = $random->base64Safe(64);
        $uuid = $random->uuid();
        $num = $random->number(16);
        //echo 'bytes:'.$bytes."<br />";
        echo 'hex:'.$hex."<br />";
        echo 'base64:'.$base64."<br />";
        echo 'base64safe:'.$base64safe."<br />";
        echo 'uuid:'.$uuid."<br />";
        echo 'num:'.$num."<br />";
    }
    public function clusterAction(){
        
    }
    public function modelAction(){
        $model = new Items();
        $data = $model->findFirstById(2); 
//         $data = $model->findFirst(3);
//         dump($data);
        echo $data->name;
    
    }
    public function pagesAction(){
        //dump($this->persistent);
        $numpages = 1;
        if($this->request->isPost()){
            $query = Criteria::fromInput($this->di, 'items', $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numpages = $this->request->getQuery('page','int');
        }
        $parameters = array();
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }
        $data = Items::find($parameters);
        $paginator = new Paginator(array(
            "data"  => $data,
            "limit" => 10,
            "page"  => $numpages
        ));
//         dump($paginator);
        $this->view->page = $paginator->getPaginate();
//         dump($paginator->getPaginate());
    }
    public function phqlAction(){
        //execute sql
//         dump($this->modelsManager);
//         $query = new Query("select name from items limit 1,19",$this->getDI());
//         $query->execute();

        $query = $this->modelsManager->createQuery(
            //"select * from items"
            //"select * from items limit 0,10"
            "select items.name,items.email from items limit 0,10"
        );
//         dump($query);
        $data = $query->execute();
//         $data = $this->modelsManager->executeQuery("select name from items");
//         dump($data);
        foreach ($data as $v){
            echo $v->name.'---'.$v->email."<br />";
        }
    }
    public function belongstoAction(){
        //belongsto
//         $data = Items::find();
        $data = Items::findFirst();
        dump($data->getTypes()->toArray());
    }
    public function hasmanyAction(){
        //hasmany
        $data = Types::findFirst(2);
        //dump($data->toArray());
        //dump($data->getAllitems()->toArray());
        dump($data->getItems()->toArray());
        //dump($data->items);
    }
    public function builderAction(){
        $data = $this->modelsManager->createBuilder()
            ->from('Items')
            ->columns(array('name','email'))
//             ->limit(10,0)
            ->limit(20)
            ->getQuery()
            ->execute();
        foreach ($data as $v){
            echo $v->name.'---'.$v->email."<br />";
        }
        dump($data);
    }
}

