<?php
use Phalcon\Loader;
use Phalcon\DI;
use Phalcon\Http\Response;
use Phalcon\Mvc\Url;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Mvc\Application;


try {
    $loader = new Loader();
    $loader->registerNamespaces(array(
        'TestApp\Components' => '../app/components/',
        'TestApp\Controllers' => '../app/controllers/'
    ))->register();

    $di = new DI();

    $di->set('url', function(){
        $url = new Url();
        $url->setBaseUri('/');

        return $url;
    });

    $di->set('router', function(){
        $router = new Router();
        $router->removeExtraSlashes(true);

        return $router;
    });

    $di->set('dispatcher', function(){
        $dispatcher = new Dispatcher();
        $dispatcher->setDefaultNamespace('TestApp\Controllers');

        return $dispatcher;
    });

    $di->set('response', function(){
        $response = new Response();

        return $response;
    });

    $di->set('voltService', function($view, $di) {
        $volt = new Volt($view, $di);
        $volt->setOptions(array(
            'compileAlways' => true,
        ));

        return $volt;
    });

    $di->set('view', function(){
        $view = new View();
        $view->setViewsDir('../app/views');
        $view->registerEngines(array(
            '.volt' => 'voltService'
        ));

        return $view;
    });

    $application = new Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo 'PhalconException: ', $e->getMessage();
}
