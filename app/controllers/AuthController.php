<?php
namespace app\controllers;
use Phalcon\Mvc\Controller;

class AuthController extends Controller{
    public function csrfAction(){
        //csrf token
//        $pass = $this->request->getPost('password','123');
//        dump($this->security->hash($pass));
//        $this->security->checkHash($pass,$password_find);
//        dump($this->security->hash(rand())); //openssl supported
        if($this->request->isPost()){
            if($this->security->checkToken()){
                echo 'csrf token is right';
            } else {
                $this->security->hash(rand());
                echo 'csrf token is wrong,pls check it!!!';
            }
        }
    }
    public function indexAction(){
        
    }
}