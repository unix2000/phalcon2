<?php
namespace app\modules\sys\models;

use Phalcon\Mvc\Collection;

class Customer extends Collection {
	public function getSource(){
		return "customer";
	}
}