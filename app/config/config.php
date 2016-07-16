<?php

//defined('APP_PATH') || define('APP_PATH', realpath('.'));

return new \Phalcon\Config(array(
    //use plugin
    'pup' => [
        'redirect' => [
            'success' => 'user/profile',
            'failure' => 'user/login'    
        ],
        'resources' => [
            'type' => 'private', //'type' => 'private',
            'resources' => [
                '*' => [
                    //all except
                    'user' => ['login', 'register']
                ]
            ]
        ]
    ],
    'database' => array(
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => 'root',
        'password'    => 'root',
        'dbname'      => 'phalcon2',
        'charset'     => 'utf8',
    ),
    'application' => array(
        'controllersDir' => APP_PATH . '/app/controllers/',
        'modelsDir'      => APP_PATH . '/app/models/',
        //'migrationsDir'  => APP_PATH . '/app/migrations/',
        'viewsDir'       => APP_PATH . '/app/views/',
        'pluginsDir'     => APP_PATH . '/app/plugins/',
        'libraryDir'     => APP_PATH . '/app/library/',
        'listenDir'     => APP_PATH . '/app/listeners/',
        'componentDir'  => APP_PATH . '/app/component',
        'cacheDir'       => APP_PATH . '/app/cache/',
        'baseUri'        => '/',
        'modulesDir'      => APP_PATH . '/app/modules',
    ),
    'cache' => array(
        'htmlCacheTime'    => 300,
        'fileCacheTime'    => 86400,
        'memCacheTime'     => 14400,
        'apcCacheTime'     => 7200,
        'xcacheTime'       => 3600,
        'eacceleratorTime' => 3600,
        'inMemCacheTime'   => 1800,
        'mongoTime'        => 7200,
        'redisTime'        => 7200,
        'metaCacheTime'    => 60
    ),
    /*
    'cacheAdapter'   =>  'memcache',
    'memcache'       => array(
        'host'     => '127.0.0.1',
        'port'       => '11211'
    ),
    'mongodb'        => array(
        'server'     => "mongodb://localhost", 
        'db'         => 'caches',
        'collection' => 'images',
    ),
    **/
    //'admin_regenrator_time_interval' => 3 * 60,
    //'home_regenarater_time_interval' => 3 * 60,
    //'sensitive_default_replace'        => '**',
));
