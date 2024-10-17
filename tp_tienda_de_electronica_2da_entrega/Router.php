<?php
require_once './controller/Controller.php';
require_once './controller/authController.php';

require_once './libs/Response.php';
require_once './middlewares/sessionAuthMiddleware.php';
require_once './middlewares/verifyAuthMiddleware.php';


$action = 'home';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$res = new Response();

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
        sessionAuthMiddleware($res); // Setea $res->user si existe session
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login
        $controller= new Controller();
        $controller->addJuego();
        break;
/*    case 'delete':
        $controller= new Controller();
        $controller->deleteJuego();
        break;
  
*/ case 'updateJuego':
        sessionAuthMiddleware($res); // Setea $res->user si existe session
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login
        $controller = new Controller();
        $controller->updateJuego();
        break;
      
  case 'addConsola':
        sessionAuthMiddleware($res); // Setea $res->user si existe session
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login
        $controller= new Controller();
        $controller->addConsola();
        break;
   /*  case 'delete':
        $controller= new Controller();
        $controller->deleteConsola();
        break;
  
    */case 'updateConsola':
        sessionAuthMiddleware($res); // Setea $res->user si existe session
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login
        $controller = new Controller();
        $controller->updateConsola();
        break;
       
    case 'showLogin':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
           
    default:
        echo('404 Page not found');
        break;
}