<?php
namespace app\models;
use Phalcon\Mvc\Model;
//phalcon3 校验写法已改
//2.0
//use Phalcon\Mvc\Model\Validator\Email;
//use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\ValidatorInterface;
use Phalcon\Mvc\EntityInterface;
use Phalcon\Mvc\Model\Validator\InclusionIn;
use app\models\MaxMinValidator;
//Validation 2.0与3.0校验方法写法错误
use Phalcon\Validation;
use Phalcon\Validation\Validator\ExclusionIn;
//3.0
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;


class Sign extends Model {
    public $name;
	public $email;
	public function initialize(){
		// Skips fields/columns on both INSERT/UPDATE operations
        $this->skipAttributes(
            array(
                'year',
                'price'
            )
        );

        // Skips only when inserting
        $this->skipAttributesOnCreate(
            array(
                'created_at'
            )
        );

        // Skips only when updating
        $this->skipAttributesOnUpdate(
            array(
                'modified_in'
            )
        );
	}

    public function validation(){
		//add
		$validator = new Validation();
		//$validator->add('email', new Email(array(
			//'field' => 'email' ,
			//'message' => 'Email格式错误'
		//)));
		
		//return $this->validate($validator);
		//错误使用 3.0写法不对
		//这是2.0写法 3.0已弃用此写法
		//Phalcon\Mvc\Model\Validation is now deprecated in favor of Phalcon\Validation\
		/**
        $this->validate(new Email(array(
            'field' => 'email' ,
			'message' => 'Email格式错误'
        )));
        $this->validate(new Uniqueness(array(
            'field' => 'name',
            'message' => '用户名不能重复'
        )));
		if ($this->validationHasFailed() == true) {
			return false;
		}
		*/

		//3.0写法
		$validator->add(
            'name',
            new UniquenessValidator([
                'model' => $this,
                'message' => '用户名不能重复',
            ])
        );
		$validator->add(
			'email', //your field name
            new EmailValidator([
                'model' => $this,
                'message' => 'Email格式错误'
            ])
        );
		return $this->validate($validator);
		/**
		$this->validate(
			new MaxMinValidator(
				array(
                    "field" => "tests",
                    "min"   => 10,
                    "max"   => 100
                )
            )
        );
		*/

//         if($this->validationHasFailed() == true){
//             return false;
//         }
        //return $this->validationHasFailed() != true;
    }
}