<?php

/* NAMED CONSTANTS*/
define('ROOT', __DIR__);
define('PROJECT_NAME' , 'NutriCalc');



/* AUTOLOAD */;
require_once ROOT . '/vendor/autoload.php';



/* SETTINGS */
$settings = new \NutriCalc\Component\Settings('dev');
$settings->setAllSettings();



/* DATA BASE CONNECTION */



/* ROUTER */
if(empty($_SERVER['REQUEST_URI'])){
    throw new \Exception('\'REQUEST_URI\' is empty');
}

$uri = trim($_SERVER['REQUEST_URI'], '/');
$routes = include(ROOT . '/src/config/routes.php');

$router = new \NutriCalc\Component\Router($uri, $routes);
$router->run();