<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
   array(
       $config->application->controllersDir,
       $config->application->modelsDir
   )
)->register();

//使用命名空间
$loader->registerNamespaces(
    array(
        'app\controllers' => $config->application->controllersDir,
        'app\models' => $config->application->modelsDir,
        'app\library' => $config->application->libraryDir,
        'app\listeners' => $config->application->listenDir,
        'app\component' => $config->application->componentDir,
        'app\modules' => $config->application->modulesDir,
    )
)->register();
