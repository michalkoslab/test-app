<?php
use Phalcon\DI;
use Phalcon\DI\FactoryDefault;

ini_set('display_errors',1);
error_reporting(E_ALL);

define('ROOT_PATH', __DIR__);

set_include_path(
    ROOT_PATH . PATH_SEPARATOR . get_include_path()
);

include __DIR__ . "/../vendor/autoload.php";

$loader = new \Phalcon\Loader();
$loader->registerDirs(
    array(
        ROOT_PATH
    )
);
$loader->registerNamespaces(array(
    'TestApp\Components' => '../app/components/'
))->register();

$di = new FactoryDefault();
DI::reset();

DI::setDefault($di);