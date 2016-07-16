<?php
namespace app\modules\sys\controllers;

use Phalcon\Mvc\Controller;
use app\modules\user\models\Customer;
use Gregwar\Captcha\CaptchaBuilder;

class IndexController extends Controller {
    public function indexAction(){
        //echo '<h1>User-index-index</h1>';
        //phalcon odm-[object-document mapper]
        // dump($this->mongodb);
       	//dump($this->mongodb->getCollectionInfo());
       	//dump($this->mongodb->getCollectionNames());
       	//dump($this->mongodb->listCollections());
       	//$data = Customer::find();
       	//dump(count($data));
       	////dump($data);
       	// foreach ($data as $k => $v) {
       	// 	echo $v->name.'----'.$v->email.'----'.$v->address."<br />";
       	// }
        // dump($this->bench);
        //$this->bench->mark('start');
		//$this->bench->mark('end');
		//echo $this->bench->elapsed_time('start', 'end');
        //dump($this->redisCache);
        //dump($this->nredis);
        //redis使用方法
        
    }
    public function testsAction(){
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