<?php

include_once 'config.php';
include_once 'libs/router.php';

$router = new Router();

                   //ENDPOINT     //VERB         //CONTROLLER        //METHOD
$router->addRoute('productos',     'GET',    'ProductApiController',  'get');
$router->addRoute('productos/:ID', 'GET',    'ProductApiController',  'get');
$router->addRoute('productos',     'POST',   'ProductApiController',  'create');
$router->addRoute('productos/:ID', 'PUT',    'ProductApiController',  'update');
$router->addRoute('productos/:ID', 'DELETE', 'ProductApiController',  'delete');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
