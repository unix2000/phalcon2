<?php
namespace app\controllers;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;

class SignController extends Controller {
    public function initialize(){
        //$this->view->setTemplateBefore('before');
        //$this->view->setTemplateAfter('after');
    }
    public function indexAction(){
        
    }
    public function registerAction(){
        $model = new Sign();
        if($this->request->isPost()){
            $model->writeAttribute('name', $this->request->getPost('name'));
            $model->writeAttribute('email', $this->request->getPost('email'));
            if($model->validation()){
                echo 'success!!';
            } else {
                //dump($model->getMessages());
            }
                
        }
        dump($this->request->getPost());
    }
    //public function showAction($id){
    public function showAction(){
        $id = $this->request->get('id');
        //控制渲染，有点类似于yii中的renderAjax renderPartial
        //phalcon 
//         View::CACHE_MODE_INVERSE
//         View::CACHE_MODE_NONE
//         View::LEVEL_ACTION_VIEW
//         View::LEVEL_AFTER_TEMPLATE
//         View::LEVEL_BEFORE_TEMPLATE
//         View::LEVEL_LAYOUT
//         View::LEVEL_MAIN_LAYOUT
//         View::LEVEL_NO_RENDER
//         $this->view->setRenderLevel(View::LEVEL_NO_RENDER);
//         $this->flash->notice('flash messages');
        //暂时禁用某些功能
//         $this->view->disableLevel(view::LEVEL_BEFORE_TEMPLATE);
//         $this->view->disableLevel(View::LEVEL_MAIN_LAYOUT);
        $this->view->id = $id;   

        //关闭视图
//         $this->response->redirect('index/index');
//         $this->view->disable();

        //使用pick覆盖app/views/sign/show.volt,id在form.volt输出
        $this->view->pick('sign/form');
    }
    function formAction(){
        //$this->view->username = 'liner.xie';
    }
    function renderAction(){
        //simple render
        $this->view->render('sign','show',array('id'=>99));
    }
    function simpleAction(){
        // Phalcon\Mvc\View\Simple 使用simple渲染
//         $simpleView = new \Phalcon\Mvc\View\Simple();
//         echo $simpleView->render('sign','simple', array(
//             'username'=>'liner.xie'            
//         ));
//         $this->view->username = 'liner';
//         $this->view->setVar('username', 'liner');
        $this->view->setVars(array(
            'username' => 'liner',
            'email' => 'liner.xie@qq.com',
        ));
    }
}