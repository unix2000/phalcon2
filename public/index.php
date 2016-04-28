<?php

error_reporting(E_ALL);

define('APP_PATH', realpath('..'));
include APP_PATH . "/app/common/global.php";
//加载compose第三方类库
require APP_PATH . "/vendor/autoload.php";
try {

    /**
     * Read the configuration
     */
    $config = include APP_PATH . "/app/config/config.php";

    /**
     * Read auto-loader
     */
    include APP_PATH . "/app/config/loader.php";

    /**
     * Read services
     */
    include APP_PATH . "/app/config/services.php";

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);
    $di['app'] = $application; //将应用实例保存到$di的app服务中
    #根据debugbar.php存放的路径，适当的调整引入的相对路径
    //$provider = new Snowair\Debugbar\ServiceProvider('../config/debugbar.php');
    //$provider -> register();//注册
    //$provider -> boot(); //启动
//     (new Snowair\Debugbar\ServiceProvider('../config/debugbar.php'))->start();
    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
