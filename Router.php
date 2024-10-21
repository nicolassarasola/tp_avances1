<?php
require_once './controller/Controller.php';
require_once './controller/authController.php';

require_once './libs/Response.php';
require_once './middlewares/sessionAuthMiddleware.php';
require_once './middlewares/verifyAuthMiddleware.php';


$action = 'home';

//DETERMINAMOS SI ES UN MÉTODO POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['action'])) {
        $action = htmlspecialchars($_POST['action']);
    }
}
//DETERMINAMOS SI ES UN MÉTODO GET
else {
    if (!empty($_GET['action'])) {
        $action = htmlspecialchars($_GET['action']);
    }
}

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response();

$params = explode('/', $action);


//Form Buscador: El usuario elige CATEGORÍA, luego selecciona una CONSOLA, que va a ser la categoría elegida para mostrar
if (isset($_POST['tipo']) && $_POST['tipo'] === 'categoria' && isset($_POST['categoriaElegida']) && is_numeric($_POST['categoriaElegida'])) {
    $consolaElegida = (int) $_POST['categoriaElegida'];
    $controller = new Controller();
    $controller->showCatalogoEspecifico($consolaElegida);
}
//LO EMPLEAMOS A LA HORA DE LAS SOLICITUDES DE LA URL, EL USUARIO ELIGE UN JUEGO Y UN ID
//EJEMPLO ../juego/1 
 else if 
 ( strtolower($params[0] === 'juego' && isset($params[1]) && is_numeric($params[1])) ||
    strtolower($params[0] === 'juego' && isset($params[1]) && is_numeric($params[1]) && isset($params[2]) && $params[2] === "")
) {
    $id = (int) $params[1];
    $controller = new Controller();

    $controller->showJuego($id);

}

//Form Buscador: El usuario elige JUEGO, luego selecciona un ID de JUEGO; se le muestra una tabla con los datos de éste último
else if (isset($_POST['tipo']) && $_POST['tipo'] === 'juego' && isset($_POST['id_juego']) && is_numeric($_POST['id_juego'])) {
    $id = (int) $_POST['id_juego'];
    $controller = new Controller();
    $controller->showJuego($id);
}



    switch (strtolower ($params[0])) {
        case 'home':
            $controller = new Controller();
            $controller->showHome();
            break;
        case 'catalogo':
            $controller = new Controller();
            $controller->showCatalogo();
            break;
        case 'juego/':
            $controller = new Controller();
            $controller->showJuego($params[1]);
            break;
        case 'juegos':
            $controller = new Controller();
            $controller->showCatalogo();
            break;
        case 'categoria':
            $controller = new Controller();
            $controller->showCatalogo();
            break;
        case 'categorias':
            $controller = new Controller();
            $controller->showCatalogo();
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
            $controller->deleteConsola($params[1]);
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



