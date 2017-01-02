<?php
/**
 * Services are globally registered in this file
 *
 * @var \Phalcon\Config $config
 */

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;
use Phalcon\Mvc\View\Simple as SimpleView;
use Phalcon\Mvc\Router;
use Phalcon\Crypt;
use Phalcon\Mvc\Dispatcher;
use app\library\Verify;
use app\library\Benchmark;
use Phalcon\Logger\Adapter\File as FileLogger;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\UserPlugin\Plugin\Security as SecurityPlugin;
use Phalcon\UserPlugin\Auth\Auth;
use Phalcon\UserPlugin\Acl\Acl;
use Phalcon\UserPlugin\Mail\Mail;
//use Phalcon\Mvc\DispatchEventsManager;
use Phalcon\Db\Profiler as ProfilerDb;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
//$di = new FactoryDefault();
$config = $di->get('config');

$di->set('profiler', function () {
    return new ProfilerDb();
}, true);

$di->set('collectionManager', function(){
      return new \Phalcon\Mvc\Collection\Manager();
 });

$di->set( 'bench', function(){
    $bm = new Benchmark();
    return $bm;
}, true);

$di->set('router',function (){
    require_once APP_PATH . '/app/config/router.php';
    return $router;
}, true );

// $di->setShared(
//     'dispatcher',
//     function() use ($di) {
//         $eventsManager = $di->getShared('eventsManager');

//         $security = new SecurityPlugin($di);
//         $eventsManager->attach('dispatch', $security);

//         $dispatcher = new Dispatcher();
//         $dispatcher->setEventsManager($eventsManager);

//         return $dispatcher;
//     }
// );

$di->setShared(
    'auth',
    function() {
        return new Auth();
    }
);

$di->setShared(
    'acl',
    function() {
        return new Acl();
    }
);

$di->setShared(
    'mail',
    function() {
        return new Mail();
    }
);
/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () use ($config) {

    $view = new View();
    //$view = new SimpleView();
    // Disable several levels
//     $view->disableLevel(array(
//         View::LEVEL_LAYOUT => true,
//         View::LEVEL_MAIN_LAYOUT => true,
//     ));

    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines(array(
        '.volt' => function ($view, $di) use ($config) {

            $volt = new VoltEngine($view, $di);

            $volt->setOptions(array(
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_'
            ));

            return $volt;
        },
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
    ));

    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () use ($config) {
    $dbConfig = $config->database->toArray();
    $adapter = $dbConfig['adapter'];
    unset($dbConfig['adapter']);

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;

    return new $class($dbConfig);
});

// $di->set('db', function (){
//     $logger = new FileLogger(dirname(__DIR__). "/app/logs/db.log");
//     $eventsManager = new \Phalcon\Events\Manager();
//     //listen all the database events
//     $eventsManager->attach('db', function($event,$connection) use($logger){
//         if($event->getType() == 'beforeQuery'){
//             $logger->log($connection->getSQLStatement(), \Phalcon\Logger::INFO);
//         }        
//     });
//     $connection = new DbAdapter(
//         array(
//             "host" => "localhost",
//             "username" => "root",
//             "password" => "root",
//             "dbname" => "phalcon2"
//         )
//     );
//     // Assign the eventsManager to the db adapter instance
//     $connection->setEventsManager($eventsManager);
//     return $connection;
// });

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new Flash(array(
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ));
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

$di->set('cookies',function(){
    $cookies = new \Phalcon\Http\Response\Cookies();
    $cookies->useEncryption(true); //false
    //ini_set("session.cookie_httponly", 1);
    return $cookies;
});
$di->set('crypt',function(){
    $crypt = new Crypt();
    $crypt->setKey('*&^%#(*(@)#)#)##)#!!!!!!'); //16 24,32bit
    return $crypt;
});

// 注册调度器，并设置控制器的默认命名空间
$di->set('dispatcher', function () {
    $dispatcher = new Dispatcher();
    //$dispatcher->setEventsManager(DispatchEventsManager::create());
    //控制器无后缀,可自定义
    //$dispatcher->setControllerSuffix(null);
    $dispatcher->setDefaultNamespace('app\controllers');
    return $dispatcher;
});

//profile register
$di->setShared('profiler', function(){
    $profiler = new \Fabfuel\Prophiler\Profiler();
    return $profiler;
});

$di->set( 'verify', function (){
    $verify = new Verify();
    return $verify;
}, true );

//cache set list
$di->set( 'mongo', function (){   
    //$mongo =  new \MongoClient( '127.0.0.1:27017' ); 
    $mongo = new \MongoClient("mongodb://127.0.0.1:27017");       
    return $mongo->selectDB('mydatabase');       
}, true );

/**
 * redis cache
 */
$di->set( 'redisCache',function() use( $config ){
    $frontCache = new \Phalcon\Cache\FrontEnd\Data( array(
        'lifetime' => $config->cache->redisTime,
            
    ) );

    $cache = new \Phalcon\Cache\Backend\Redis( $frontCache,
        array(
            'host'       => '127.0.0.1',
            'port'       => 6379,
            //'auth' => 'foobared',
            'persistent' => false,
            'prefix' => 'phalcon2.dev_'
        ) );
    return $cache;
}, true );

/**
 * native redis
 * 原生native使用phpredis扩展
 */
// $di->set( 'nredis', function(){
//     if( !extension_loaded( 'redis' ) )
//     {
//         var_dump( 'redis extension not loaded!' );
//         //exit();
//     }    
//     $redis = new \Redis();
    
//     $redis->connect( '127.0.0.1', 6379 /*, 'password'*/ );
    
//     return $redis;
// }, true );
