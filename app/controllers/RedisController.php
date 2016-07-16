<?php
namespace app\controllers;
use Phalcon\Cache\Backend\Redis;
use Phalcon\Mvc\Controller;
use Phalcon\Cache\Frontend\Data;

class RedisController extends Controller {
    public function indexAction(){
        //$redis = new Redis();
        //dump($redis);
        $frontCache = new Data(array(
            'lifetime' => 172800,
        ));
        $cache = new Redis($frontCache,array(
            'host' => 'localhost',
            'port' => 6379,
            'persistent' => false,
        ));
        //$cache->save('my-data',array(1,2,3,4,5,6));
        $data = $cache->get('my-data');
//         dump($data);
        //$cache->delete('my-data');
        $cache->save('my-data',array('username'=>'xiaolin','nickname'=>'谢小林'));
        $cache->save('username','liner.xie');
        dump($cache->get('my-data'));
        dump($cache->get('username'));
    }
    public function tableAction(){
        //用set全局注入
        $frontCache = new Data(array(
            'lifetime' => 172800,
        ));
        $cache = new Redis($frontCache,array(
            'host' => '127.0.0.1',
            'port' => 6379,
            'persistent' => false,
        ));
//         dump($cache);
        //$model = new RedisModel();
        //dump($model);
        dump($cache->get('redis_model'));
    }
    public function queueAction(){
        //队列使用

    }
    public function sessionAction(){
        //redis session
        $session = new \Phalcon\Session\Adapter\Redis(array(
            'uniqueId' => 'my-private-app',
            'host' => 'localhost',
            'port' => 6379,
            //'auth' => 'foobared',
            'persistent' => false,
            'lifetime' => 3600,
            'prefix' => 'my_'
        ));
        $session->start();
        $session->set('username', 'liner.xie');
        echo $session->get('username');
        //sleep(10);
        //echo 'session is:'.$session->get('username');
    }
}