<?php
namespace app\modules\admin;

use Phalcon\Mvc\Controller;
class IndexController extends Controller {
    public function indexAction(){
        echo '<h1>admin-index-index</h1>';
    }
}