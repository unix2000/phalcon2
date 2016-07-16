<?php
namespace app\listeners;

class SomeListener {
    public function beforeSomeTask($event, $myComponent){
        echo "Here, beforeSomeTask<br />";
        echo "<h1>event variables</h1>";
        dump($event);
        echo "<h1>myComponent</h1>";
        dump($myComponent);
    }
    
    public function afterSomeTask($event, $myComponent){
        echo "Here, afterSomeTask<br />";
    }
}