<?php

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

$loader = new Loader();

$loader->registerDirs(
    [
        '../app/controllers',
        '../app/models',
    ]
);

$loader->register();

$di = new FactoryDefault();

$di->set(
    'view',
    function(){
        $view = new View();

        $view->setViewsDir('../app/views/');

        return $view;
    }
);

$di->set(
    'url',
    function(){
        $url = new UrlProvider();

        $url->setBaseUri('/tutorial/');

        return $url;
    }
);

$application = new Application($di);

try{
    $response = $application->handle();

    $response->send();
}catch (\Excrption $e){
    echo 'Exception:'.$e->getMessage();

}