<?php
include_once 'libs/router.php';

$router = new Router();

                // ENDPOINT  //VERB      //CONTROLLER         //METHOD
$router->addRoute('productos', 'GET', 'ProductApiController', 'getAll');


//$router->addRoute('tareas', 'POST', 'TaskApiController', 'crearTarea');
//$router->addRoute('tareas/:ID', 'GET', 'TaskApiController', 'obtenerTarea');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
