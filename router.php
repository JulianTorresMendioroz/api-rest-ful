<?php
include_once 'libs/router.php';

$router = new Router();

                // ENDPOINT  //VERB      //CONTROLLER         //METHOD
$router->addRoute('productos', 'GET', 'ProductApiController', 'get');
$router->addRoute('productos/:ID', 'GET', 'ProductApiController', 'get');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
