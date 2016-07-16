<?php
namespace app\controllers;
use app\controllers\ControllerBase;
use Phalcon\Error\Error;

class ControlController extends ControllerBase {
    public function indexAction(){
        dump(new Error());
    }
}