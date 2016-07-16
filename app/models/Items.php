<?php
namespace app\models;
use Phalcon\Mvc\Model;

class Items extends Model {
    public $id;
    public $name;
    public $email;
    public $address;
    public $registration_date;
    //first way
   public function getSource(){
       return 'items';
   }
    
    public function initialize(){
        //second way
        //$this->setSource('items');
        $this->belongsTo('types_id', 'app\models\Types', 'id',array('alias'=>'types'));
    }
}