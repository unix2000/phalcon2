<?php
namespace app\controllers;
use Phalcon\Mvc\Controller;
use app\models\Items;
use Phalcon\Http\Response\Exception;

class ControllerBase extends Controller {
    public function cAction(){
        //items add
        if($this->request->isPost()){
            //
        }
        $objects = new Items();
        $objects->name = "xiaolin";
        $objects->email = "xiexxl2000@163.com";
        $objects->address = "苏州xxx";
        $objects->registration_date = "2012-01-01";
        $objects->save();
    }
    public function rAction(){
        $data = Items::findFirst(1);
        if(!$data){
            throw new Exception('data errors');
        }
        dump($data->toArray());
    }
    public function uAction(){
        if($this->request->isPost()){
            //valid id
        }
        $objects = Items::findFirst(17995);
        $objects->address = "苏州xxxxxxxx";
        $objects->update();
    }
    public function dAction(){
        if($this->request->isPost()){
            //valid id
        }
        $objects = Items::findFirst(17994);
        $objects->delete();
    }
}
