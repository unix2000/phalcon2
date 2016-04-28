<?php
namespace app\controllers;
use Phalcon\Mvc\Controller;
use Phalcon\Config\Adapter\Ini as ConfigIni;

class ConfigController extends Controller{
    function indexAction(){
        $config = new ConfigIni(APP_PATH."/app/config/config.ini");
        dump($config);
        echo $config->phalcon->controllersDir, "<br />";
        echo $config->database->username, "<br />";
        echo $config->models->metadata->adapter, "<br />";
    }
}