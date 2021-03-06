<?php

error_reporting(E_ALL);
ini_set( 'display_errors', '1' );
define('APP_PATH', realpath('..'));
//phalcon3 新版本特性
include APP_PATH . "/app/common/global.php";
//加载compose第三方类库
require APP_PATH . "/vendor/autoload.php";
try {

    /**
     * Read the configuration
     * set config
     */
    $di = new \Phalcon\Di\FactoryDefault();
    $application = new \Phalcon\Mvc\Application($di);
    $di['app'] = $application; //将应用实例保存到$di的app服务中
    $config = require_once APP_PATH . "/app/config/config.php";
    $di->set('config', $config);
    /**
     * Read auto-loader
     */
    include APP_PATH . "/app/config/loader.php";

    /**
     * Read services
     */
    include APP_PATH . "/app/config/services.php";
    //include APP_PATH . "/app/config/router.php";
    
    // include APP_PATH . "/app/config/profile.php";
    // $profiler = new \Fabfuel\Prophiler\Profiler();
    // $toolbar = new \Fabfuel\Prophiler\Toolbar($profiler);
    // $toolbar->addDataCollector(new \Fabfuel\Prophiler\DataCollector\Request());
    // $profiler->addAggregator(new \Fabfuel\Prophiler\Aggregator\Database\QueryAggregator());
    // $profiler->addAggregator(new \Fabfuel\Prophiler\Aggregator\Cache\CacheAggregator());
    // echo $toolbar->render();
    /**
     * Handle the request
     */
    
    #根据debugbar.php存放的路径，适当的调整引入的相对路径
    //$provider = new Snowair\Debugbar\ServiceProvider('../config/debugbar.php');
    //$provider -> register();//注册
    //$provider -> boot(); //启动
//     (new Snowair\Debugbar\ServiceProvider('../config/debugbar.php'))->start();
    //register modules
    $application->registerModules(array(
        'admin' => array(
            'className' => 'app\modules\admin\Module',
            'path' => APP_PATH . '/app/modules/admin/Module.php'
        ),
        'sys' => array(
            'className' => 'app\modules\sys\Module',
            'path' => APP_PATH . '/app/modules/sys/Module.php'
        ),
    ));
    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
