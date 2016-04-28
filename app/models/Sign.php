<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Validator\Email;
use Phalcon\Mvc\Model\Validator\Uniqueness;
class Sign extends Model{
    public $name,$email;
    public function validation(){
        $this->validate(new Email(array(
            'field' => 'email'
        )));
        $this->validate(new Uniqueness(array(
            'field' => 'name',
            'message' => '用户名不能重复'
        )));
//         if($this->validationHasFailed() == true){
//             return false;
//         }
        return $this->validationHasFailed() != true;
    }
}