<?php
namespace app\controllers;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $data = array(
            'username' => 'liner',
            'email' => 'linux8000@qq.com'
        );
        $this->view->data = 'liner.xie';
        //$this->view->render('index');
    }
    public function voltAction(){
        
    }
}

