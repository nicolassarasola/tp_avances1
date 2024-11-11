<?php
require_once './Controller/juegosController.php';
require_once './Controller/consolasController.php';
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
        $controller = new juegosController();
        $controller->showHome();
        break;
    case 'catalogo':
        $controller = new juegosController();
        $controller->showJuegos();
        break;
    case 'juego':
        if ((count($params) === 2) && is_numeric($params[1])) {
            $controller = new juegosController();
            $controller->showJuego($params[1]);
            break;

        } else {
            $controller = new juegosController();
            $controller->showJuegos();
            break;
        }
    case 'juegos':
        $controller = new juegosController();
        $controller->showJuegos();
        break;
    case 'categoria':
        if ((count($params) === 2) && is_numeric($params[1])) {
            $controller = new juegosController();
            $controller->showCategoriaEspecifica($params[1]);
            break;
        } else {
            $controller = new juegosController();
            $controller->showJuegosByCategorias(); //HACER UN APARTADO CON TODAS LAS OPCIONES
            break;

        }
    case 'categorias':
        $controller = new juegosController();
        $controller->showJuegosByCategorias();
        break;

    case 'addjuego':

        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new juegosController();
        $controller->addJuego();

        break;
    case 'deletejuego': 
    if(!empty($params[1])){
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new juegosController();
        $controller->deleteJuego($params[1]);
        break;
    }
    else{
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new juegosController();
        $controller->deleteJuego(0);
        break;
    }


    case 'updatejuego':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new juegosController();
        $controller->updateJuego();
        break;


    case 'addconsola':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new consolasController();
        $controller->addConsola();
        break;

    case 'deleteconsola':
            if(!empty($params[1])){
            sessionAuthMiddleware($res);
            verifyAuthMiddleware($res);
            $controller = new consolasController();
            $controller->deleteConsola($params[1]);
            break;
        }
        else{
            sessionAuthMiddleware($res);
            verifyAuthMiddleware($res);
            $controller = new consolasController();
            $controller->deleteConsola(0);
            break;
        }

    case 'updateconsola':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new consolasController();
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
