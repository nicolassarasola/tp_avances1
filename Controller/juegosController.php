<?php
require_once './Model/juegosModel.php';
require_once './Model/consolasModel.php';
require_once './view/juegosView.php';
class juegosController
{

    private $juegosView;
    private $messageView;
    private $consolasModel;

    private $juegosModel;



    public function __construct()
    {
        $this->messageView = new messageView();
        $this->juegosView = new juegosView();
        $this->juegosModel = new juegosModel();
        $this->consolasModel = new consolasModel();
      
    }

    public function showHome()
    {
        $this->juegosView->showHome();
    }

    
    public function showJuegos()
    {

        $juegos = $this->juegosModel->getJuegos();
        foreach($juegos as $juego) {
            $juego->nombreConsola = $this->consolasModel->getNameConsola($juego->ID_consola)->nombre;
            
        }
        $this->juegosView->showCatalogo($juegos);


    }
    public function showJuegosByCategorias()
    {  
        $categorias = [];
        $consolas = $this->consolasModel->getConsolas();
    
        foreach ($consolas as $consola) {
            $juegos = $this->juegosModel->getJuegosByConsola($consola->ID);
            $categorias[] = [
                'consola' => $consola->nombre,
                'juegos' => $juegos
            ];
        }
    
        $this->juegosView->showCategorias($categorias);
    
    }

    public function showJuego($id)
    {
    
        $juego = $this->juegosModel->getJuegoByid($id);
        
        if(!$juego){
            return $this->messageView->showError("juego inexistente");
        }
        
        $consolaId=$juego->ID_consola;
        $consola = $this->consolasModel->getConsola($consolaId);
         
        $this->juegosView->showJuego($juego, $consola->nombre);
    
  

 
    }



    public function showCategoriaEspecifica($consolaElegida)
    {
        $existeConsola = $this->consolasModel->getConsola($consolaElegida);

        if (!empty($existeConsola)) {
            $categoriaElegida = $this->juegosModel->getJuegosByConsola($existeConsola->ID);
            $consolas = $this->consolasModel->getConsolas();
            $this->juegosView->showCatalogoEspecifico($categoriaElegida, $consolas, $existeConsola->nombre);

        } else {
            $this->messageView->showError("consola inexistente");
        }

    }

    public function addJuego()
    {
        $consolas = $this->consolasModel->getConsolas();
        $this->juegosView->showFormAddJuego($consolas);


        if (
            (!isset($_POST['nombreJuego']) || empty($_POST['nombreJuego']))
            || (!isset($_POST['fechaLanzamiento']) || empty($_POST['fechaLanzamiento']))
            || (!isset($_POST['cantidadJugadores']) || empty($_POST['cantidadJugadores']))
            || (!isset($_POST['categoriaID']) || empty($_POST['categoriaID']))
        ) {
            $this->messageView->showMensaje('ingrese los datos correctamente');

        } else {

            $nombre = $_POST['nombreJuego'];
            $fechaLanzamiento = $_POST['fechaLanzamiento'];
            $jugadores = $_POST['cantidadJugadores'];
            $IDConsola = $_POST['categoriaID'];

            $this->juegosModel->addJuego($nombre, $fechaLanzamiento, $jugadores, $IDConsola);


            $this->messageView->showMensaje('juego agregado correctamente');

        }

     
    }


   


    public function updateJuego()
    {
        $consolas=$this->consolasModel->getConsolas();
        $juegos = $this->juegosModel->getJuegos();
        foreach($juegos as $juego) {
            $juego->nombreConsola = $this->consolasModel->getNameConsola($juego->ID_consola)->nombre;
            
        }
        $this->juegosView->showUpdateJuegos($juegos,$consolas);


        if (
            (!isset($_POST['nombre']) || empty($_POST['nombre']))
            || (!isset($_POST['fecha_lanzamiento']) || empty($_POST['fecha_lanzamiento']))
            || (!isset($_POST['jugadores']) || empty($_POST['jugadores']))
            || (!isset($_POST['ID_consola']) || empty($_POST['ID_consola']))
            || (!isset($_POST['ID']) || empty($_POST['ID']))
        ) {


            $this->messageView->showMensaje('Ingrese los datos correctamente');
        } else {

            $id = $_POST['ID'];
            $nombre = $_POST['nombre'];
            $fecha_lanzamiento = $_POST['fecha_lanzamiento'];
            $jugadores = $_POST['jugadores'];
            $IDConsola = $_POST['ID_consola'];

            $this->juegosModel->updateJuego($nombre, $fecha_lanzamiento, $jugadores, $IDConsola, $id);
            $this->messageView->showMensaje('Juego actualizado sin modificar la imagen.');
        }
    }
    




  
    public function deleteJuego($id)
    {

        $juegos = $this->juegosModel->getJuegos();

    
        foreach($juegos as $juego) {
            $juego->nombreConsola = $this->consolasModel->getNameConsola($juego->ID_consola)->nombre;
            
        }
        $this->juegosView->showDeleteJuego($juegos);


        if (isset($_POST['ID']) && !empty($_POST['ID'])) {
            $id = $_POST['ID'];
        }
                    
        if ($this->juegosModel->getJuegoById($id)) {
            $this->juegosModel->deleteJuego($id);
            return $this->messageView->showMensaje('el juego fue eliminado correctamente.');
        }else{
            return $this->messageView->showError('el juego ingresado no existe.');
        }
    }
    

}