<?php 
namespace app\controllers;

class Index extends Base {
	public function indexAction(){
		$data = array(
            'username' => 'liner',
            'email' => 'linux8000@qq.com'
        );
        $this->view->data = 'liner.xie';
	}
}