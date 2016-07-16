<?php
namespace app\controllers;
use Phalcon\Mvc\Controller;
//use app\library\sdk\PhalApiClient as Client;
use app\library\sdk\PhalApiClient;

class ClientController extends Controller {
	public function indexAction(){
		//Host本地地址无法连接
		$client = PhalApiClient::create()
        	->withHost('http://phalapi.oschina.mopaas.com/Public/demo/');

		$rs = $client->reset()
		    ->withService('Default.Index')
		    //->withParams('username', 'liner')
		    ->withTimeout(3000)
		    ->request();

		dump($rs->getRet());
		echo "\n";
		dump($rs->getData());
		echo "\n";
		dump($rs->getMsg());
	}
}