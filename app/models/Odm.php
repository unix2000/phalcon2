<?php
namespace app\controllers;

class Odm extends \Phalcon\Mvc\Collection {
    public function getSource()
    {
        return 'customer';
    }
}