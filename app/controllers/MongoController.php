<?php
namespace app\controllers;
use Phalcon\Mvc\Controller;
use Phalcon\Cache\Backend\Mongo;

class MongoController extends Controller {
    function indexAction(){
        $mongo = new Mongo();
        //dump($mongo);
    }
}