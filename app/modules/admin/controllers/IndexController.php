<?php
namespace app\modules\admin\controllers;

use Phalcon\Mvc\Controller;
use Phalcon\UserPlugin\Forms\User\LoginForm;

class IndexController extends Controller {
    public function indexAction(){
        //echo '<h1>admin-index-index</h1>';
        //dump($this->db);
        // dump($this->auth);
        // dump($this->mail);
        // dump($this->acl);
        //dump($this->eventsManager);
        //$di = new \Phalcon\Di\FactoryDefault;
        //dump($di->getShared('eventsManager'));
        dump($this->dispatcher);
    }

    /**
     * Login user
     * @return \Phalcon\Http\ResponseInterface
     */
    public function loginAction() {
    	dump($this->auth->isUserSignedIn());
        if (true === $this->auth->isUserSignedIn()) {
            $this->response->redirect(['action' => 'profile']);
        }

        $form = new LoginForm();

        try {
            $this->auth->login($form);
        } catch (AuthException $e) {
            $this->flash->error($e->getMessage());
        }

        $this->view->form = $form;
        $this->view->data = ['email' => 'liner.xie@qq.com'];
    }
}