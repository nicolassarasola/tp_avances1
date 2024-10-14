<?php
require_once './libs/Response.php';
require_once './middlewares/SessionAuthMiddleware.php';
require_once './controller/Controller.php';
require_once './Controller/AuthController.php';



$action = 'home';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response(); 

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}


$params = explode('/', $action);


switch ($params[0]) {
    case 'home':
        $controller= new Controller();
        $controller->showHome();
        break;
    case 'catalogo':
        sessionAuthMiddleware($res);
        $controller= new Controller();
        $controller->showCatalogo();
        break;
    case 'juego':
        sessionAuthMiddleware($res);
        $controller= new Controller();
        $controller->showJuego();
        break;
    case 'categoria':
        $controller= new Controller();
        $controller->showCategoriaEspecifica();
        break;
    case 'categorias':
        $controller= new Controller();
        $controller->showCategorias();
        break;
    case 'showLogin':
        $controller= new AuthController();
        $controller->showLogin();
        break;
case 'login':
    $controller= new AuthController();
    $controller->login();
    break;
case 'close sesion':
    $controller= new AuthController();
    $controller->closeSesion();
   
    /*  case 'add':
        $controller= new Controller();
        $controller->addConsola();
        break;
    case 'delete':
        $controller= new Controller();
        $controller->deleteConsola();
        break;
   
    case 'update':
        $controller = new Controller();
        $controller->updateConsola();
        break;*/
    default:
        echo('404 Page not found');
        break;
}