<?php
namespace app\controllers;
use app\library\Verify;
use Gregwar\Captcha\CaptchaBuilder;
use Phalcon\Http\Response;

class TestsController extends \phalcon\Mvc\Controller{
    public function helloAction(){
        //$this->view->disable();
        //echo 'ab webbench tests--';
        $this->flash->error("You don't have permission to access this area");      
    }
    public function uploadAction(){
        if($this->request->hasFiles()){
            // Print the real file names and sizes
            foreach ($this->request->getUploadedFiles() as $file) {
                // Print file details
                echo $file->getName(), " ", $file->getSize(), "\n";
                // Move the file into the application
                $file->moveTo('files/' . $file->getName());
            }
        }
    }
    public function verifyAction(){
		//thinkphp验证码无法正常显示 好大一坑
		$this->view->disable();
		//$res = new Response();
		//$res->setHeader('Content-type', 'image/jpeg');
		//$res->setHeader('Pragma', 'no-cache');
		//$res->setHeader('Cache-Control', 'no-cache');
		//$res->setContentType('image/jpeg');
		//ob_clean();
        //$verify = new Verify( array( 'imageH' => 40, 'imageW' => 140, 'fontSize' => 20, 'length' => 6 ));
        //$verify->entry( 'code' );
		//dump($this->verify);
		//dump($this->getDI()->get('verify'));
		//$this->verify->entry();
// // 		$res = $this->response;

		$captcha = new CaptchaBuilder();
		header('Cache-Control: private, max-age=0, no-store, no-cache, must-revalidate');
		header('Cache-Control: post-check=0, pre-check=0', false);
		header('Pragma: no-cache');
		header('Content-type: image/jpeg');
		//$captcha->build();
// // 		//$builder->save('out.jpg');
// // 		//ob_clean();		
		//$captcha->output();
		//echo $builder->getPhrase();
		$captcha->build()->output();
    }
}