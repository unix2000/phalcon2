<?php
namespace app\models;
use Phalcon\Mvc\Model;

class Types extends Model {
    public $id;
    public $name;
    public $pid;
    
    public function getSource(){
        return 'types';
    }
    public function initialize(){
//        $this->hasMany('id', 'Items', 'types_id');
//        $this->hasMany('id','Items','types_id',array('alias'=>'allitems'));
        $this->hasMany('id','app\models\Items','types_id',array('alias'=>'items'));
    }
}