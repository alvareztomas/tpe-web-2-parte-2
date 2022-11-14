<?php

require_once 'libs/Router.php';
require_once 'Controller/ApiController.php';

$router = new Router();

$router->addRoute('topAnotadores', 'GET', 'ApiController', 'getAnotadores');
$router->addRoute('topAnotadores', 'POST', 'ApiController', 'addAnotador');
$router->addRoute('topAnotadores/:ID', 'GET', 'ApiController', 'getAnotador');
$router->addRoute('topAnotadores/:ID', 'DELETE', 'ApiController', 'deleteAnotador');
$router->addRoute('topAnotadores/:ID', 'PUT', 'ApiController', 'updateAnotador');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
