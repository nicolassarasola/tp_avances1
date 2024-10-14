<?php
require_once './controller/Controller.php';

$action = 'home';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

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
        $controller= new Controller();
        $controller->showCatalogo();
        break;
    case 'juego':
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
  case 'addJuego':
        $controller= new Controller();
        $controller->addJuego();
        break;
/*    case 'delete':
        $controller= new Controller();
        $controller->deleteJuego();
        break;
   
    case 'update':
        $controller = new Controller();
        $controller->updateJuego();
        break;
        /*
  case 'add':
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
        break;
        */
    default:
        echo('404 Page not found');
        break;
}