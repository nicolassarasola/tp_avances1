<?php
require_once './Controller/Controller.php';
require_once './Controller/authController.php';

require_once './libs/Response.php';
require_once './Middlewares/sessionAuthMiddleware.php';
require_once './Middlewares/verifyAuthMiddleware.php';


$action = 'home';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

if (isset($_GET['action']) && !empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home';
}



$res = new Response();

$params = explode('/', $action);



switch ($params[0]) {
    case 'home':
    case 'inicio':
    case 'principal':
        $controller = new Controller();
        $controller->showHome();
        break;
    case 'catalogo':
        $controller = new Controller();
        $controller->showCatalogo();
        break;
    case 'juego':
        if ((count($params) === 2) && is_numeric($params[1])) {
            $controller = new Controller();
            $controller->showJuego($params[1]);
            break;

        } else {
            $controller = new Controller();
            $controller->showCatalogo();
            break;
        }
    case 'juegos':
        $controller = new Controller();
        $controller->showCatalogo();
        break;
    case 'categoria':
        if ((count($params) === 2) && is_numeric($params[1])) {
            $controller = new Controller();
            $controller->showCategoriaEspecifica($params[1]);
            break;
        } else {
            $controller = new Controller();
            $controller->showCategorias(); //HACER UN APARTADO CON TODAS LAS OPCIONES
            break;

        }
    case 'categorias':
        $controller = new Controller();
        $controller->showCategorias();
        break;

    case 'addjuego':

        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new Controller();
        $controller->addJuego();

        break;
    case 'deletejuego':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new Controller();
        $controller->deleteJuego($params);
        break;


    case 'updatejuego':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new Controller();
        $controller->updateJuego();
        break;


    case 'addconsola':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new Controller();
        $controller->addConsola();
        break;
    case 'deleteconsola':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new Controller();
        $controller->deleteConsola($params);
        break;

    case 'updateconsola':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new Controller();
        $controller->updateConsola();
        break;

    case 'showlogin':
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
        break;

    default:
        echo ('404 Page not found');
        break;
}
