<?php
require_once './model/Model.php';
require_once './Model/modelCatalogo.php';
require_once './Model/modelConsolas.php';
require_once './Model/modelCrud.php';
require_once './view/View.php';
///
class Controller
{

    private $aceituna;
    private $view;
    private $model;

    private $modelConsolas;

    private $modelCatalogo;

    private $modelCrud;

    private $modelCategoria;


    public function __construct()
    {
        $this->view = new View();
        $this->model = new Model();
        $this->modelCatalogo = new modelCatalogo();
        $this->modelConsolas = new modelConsolas();
        $this->modelCrud = new modelCrud();
      
    }

    public function showHome()
    {
        $this->view->showHome();
    }

    
    public function showCatalogo()
    {

        $juegos = $this->modelCatalogo->getCatalogo();
        foreach($juegos as $juego) {
            $juego->nombreConsola = $this->modelConsolas->getNameConsola($juego->ID_consola)->nombre;
            
        }
        $this->view->showCatalogo($juegos);


    }
    public function showCategorias()
    {

        $consolas = $this->modelConsolas->getConsolas();

        foreach ($consolas as $consola) {

           $juegos = $this->modelCatalogo->getCatalogoEspecifico($consola->ID);
           $this->view->showCategorias($juegos, $consola->nombre);        

        }

    }

    public function showJuego($id)
    {
        $juego = $this->model->getJuego($id);
        $consola = $this->modelConsolas->getConsola($juego->ID_consola);
        try {
            if ($juego) {
                $this->view->showJuego($juego, $consola->nombre);


            } else {
                $this->view->showError404();
            }
        } catch (Exception $e) {

            error_log($e->getMessage());
            $this->view->showError404();
        }
    }



    public function showCategoriaEspecifica($consolaElegida)
    {
        $existeConsola = $this->modelConsolas->checkConsola($consolaElegida);

        if (!empty($existeConsola)) {
            $categoriaElegida = $this->modelCatalogo->getCatalogoEspecifico($existeConsola->ID);
            $consolas = $this->modelConsolas->getConsolas();
            $this->view->showCatalogoEspecifico($categoriaElegida, $consolas, $existeConsola->nombre);

        } else {
            $this->view->showError404();
        }

    }

    public function addJuego()
    {
        $consolas = $this->modelConsolas->getConsolas();
        $this->view->showFormAddJuego($consolas);


        if (
            (!isset($_POST['nombreJuego']) || empty($_POST['nombreJuego']))
            || (!isset($_POST['fechaLanzamiento']) || empty($_POST['fechaLanzamiento']))
            || (!isset($_POST['cantidadJugadores']) || empty($_POST['cantidadJugadores']))
            || (!isset($_POST['categoriaID']) || empty($_POST['categoriaID']))
        ) {
            $this->view->showMensaje('ingrese los datos correctamente');

        } else {

            $nombre = $_POST['nombreJuego'];
            $fechaLanzamiento = $_POST['fechaLanzamiento'];
            $jugadores = $_POST['cantidadJugadores'];
            $IDConsola = $_POST['categoriaID'];


            if ($_FILES['input_name']['type'] == "image/jpg" || $_FILES['input_name']['type'] == "image/jpeg" || $_FILES['input_name']['type'] == "image/png") {
                $this->modelCrud->addJuego($nombre, $fechaLanzamiento, $jugadores, $IDConsola, $_FILES['input_name']);
            } else {
                $this->modelCrud->addJuego($nombre, $fechaLanzamiento, $jugadores, $IDConsola);
                $this->view->showError('error al procesar la imagen');
            }


            $this->view->showMensaje('juego agregado correctamente');

        }

        $this->showHome();
    }


    public function addConsola()
    {

        $this->view->showFormAddConsola();

        if (
            (!isset($_POST['nombreCategoria']) || empty($_POST['nombreCategoria']))
            || (!isset($_POST['marca']) || empty($_POST['marca']))
            || (!isset($_POST['color']) || empty($_POST['color']))
            || (!isset($_POST['generacion']) || empty($_POST['generacion']))
        ) {

            $this->view->showMensaje('ingrese los datos correctamente');
        } else {
            $nombre = $_POST['nombreCategoria'];
            $consola = $this->modelConsolas->getConsolaByName($nombre);
            if ($consola) {
                $this->view->ShowError('consola existente en el sistema');
            } else {
                $nombre = $_POST['nombreCategoria'];
                $marca = $_POST['marca'];
                $color = $_POST['color'];
                $generacion = $_POST['generacion'];

                $this->modelCrud->addConsola($nombre, $marca, $color, $generacion);
                $this->view->showMensaje('consola agregada correctamente');
            }

        }
        $this->showHome();

    }


    public function updateJuego()
    {

        $juegos = $this->modelCatalogo->getCatalogo();
        foreach($juegos as $juego) {
            $juego->nombreConsola = $this->modelConsolas->getNameConsola($juego->ID_consola)->nombre;
            
        }
        $this->view->showUpdateJuegos($juegos);


        if (
            (!isset($_POST['nombre']) || empty($_POST['nombre']))
            || (!isset($_POST['fecha_lanzamiento']) || empty($_POST['fecha_lanzamiento']))
            || (!isset($_POST['jugadores']) || empty($_POST['jugadores']))
            || (!isset($_POST['ID_consola']) || empty($_POST['ID_consola']))
            || (!isset($_POST['ID']) || empty($_POST['ID']))
        ) {


            $this->view->showMensaje('Ingrese los datos correctamente');
        } else {

            $id = $_POST['ID'];
            $nombre = $_POST['nombre'];
            $fecha_lanzamiento = $_POST['fecha_lanzamiento'];
            $jugadores = $_POST['jugadores'];
            $IDConsola = $_POST['ID_consola'];


            if (isset($_FILES['input_name']['name']) && !empty($_FILES['input_name']['name'])) {

                if (
                    $_FILES['input_name']['type'] == "image/jpg" ||
                    $_FILES['input_name']['type'] == "image/jpeg" ||
                    $_FILES['input_name']['type'] == "image/png"
                ) {

                    $this->modelCrud->updateJuego($nombre, $fecha_lanzamiento, $jugadores, $IDConsola, $_FILES['input_name'], $id);
                    $this->view->showMensaje('Juego actualizado correctamente');
                } else {

                    $this->view->showError('Error al procesar la imagen. Formato no permitido.');
                }
            } else {

                $this->modelCrud->updateJuego($nombre, $fecha_lanzamiento, $jugadores, $IDConsola, null, $id);
                $this->view->showMensaje('Juego actualizado sin modificar la imagen.');
            }
        }
    }




    public function updateConsola()
    {
        $consolas = $this->modelConsolas->getConsolas();
        $this->view->showUpdateConsolas($consolas);

        if (
            (!isset($_POST['nombre']) || empty($_POST['nombre']))
            || (!isset($_POST['marca']) || empty($_POST['marca']))
            || (!isset($_POST['color']) || empty($_POST['color']))
            || (!isset($_POST['generacion']) || empty($_POST['generacion']))
            || (!isset($_POST['ID']) || empty($_POST['ID']))
        ) {

            $this->view->showMensaje('ingrese los datos correctamente');
        } else {

            $id = $_POST['ID'];
            $nombre = $_POST['nombre'];
            $marca = $_POST['marca'];
            $color = $_POST['color'];
            $generacion = $_POST['generacion'];

            if ($id) {
                $consola = $this->modelConsolas->getConsola($id);

              /*  if (!empty($consola)) {
                    $this->view->showError('consola no valida, el elemento ya existe');
                }*/
                
                 if (empty($consola)) {
                    $this->view->showError('La consola asignada no existe. No se puede modificar un elemento inexistente');
                }
                else {
                    $this->modelCrud->updateConsola($nombre, $marca, $color, $generacion, $id);

                    $this->view->showMensaje('cambio realizado');
                }
            }
        }
    }


    public function deleteJuego($id)
    {

        $juegos = $this->modelCatalogo->getCatalogo();

    
        foreach($juegos as $juego) {
            $juego->nombreConsola = $this->modelConsolas->getNameConsola($juego->ID_consola)->nombre;
            
        }
        $this->view->showDeleteJuego($juegos);


        if (isset($_POST['ID']) && !empty($_POST['ID'])) {
            $id = $_POST['ID'];

            if ($this->model->getJuego($id)) {
                $this->modelCrud->deleteJuego($id);
            }
        }
    }
    public function deleteConsola($id)
    {

        $consolas = $this->modelConsolas->getConsolas();
        $this->view->showDeleteConsola($consolas);

        if (isset($_POST['ID']) && !empty($_POST['ID'])) {
            $id = $_POST['ID'];


            if ($this->modelConsolas->getConsola($id)) {
                $this->modelCrud->deleteConsola($id);
                $this->view->showMensaje('Consola eliminada correctamente.');
            }
        }
    }

}