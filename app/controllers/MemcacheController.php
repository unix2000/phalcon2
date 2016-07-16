<?php
namespace app\controllers;
use Phalcon\Mvc\Controller;
use Phalcon\Cache\Backend\Memcache;

class MemcacheController extends Controller{
    function indexAction(){
        $mem = new Memcache();
        //dump($mem);
    }
}