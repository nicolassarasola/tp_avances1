<?php
require_once './model/Model.php';
require_once './view/View.php';

class Controller { 

    private $view;
    private $model;


    public function __construct(){
        $this->view= new View();
        $this->model= new Model();
    }

    public function showHome(){
        $this->view->showHome();
    }

    public function showCatalogo(){
        
        $juegos=$this->model->getCatalogo();
        $consolas=$this->model->getConsolas();
        $this->view->showCatalogo($juegos, $consolas);
    
        
    }

   //MOSTRAR UN JUEGO ESPECIFICANDO SU ID EN LA URL
   public function showJuego($id)
   {  
       $juego = $this->model->getJuego($id);
       $consolas=$this->model->getConsolas();
       try {
           if ($juego !== null) { // Comparación estricta
            $this->view->showJuego($juego, $consolas);
           
            
           } else {
               $this->view->showError404();
           }
       } catch (Exception $e) {
           // Puedes registrar el error si es necesario
           error_log($e->getMessage()); // Registro del error
           $this->view->showError404();
       }
   }


    
   public function showCatalogoEspecifico($consolaElegida)
   {
       $categoriaElegida = $this->model->getCatalogoEspecifico($consolaElegida);
       $consolas=$this->model->getConsolas();
       $this->view->showCatalogoEspecifico($categoriaElegida, $consolas);

   }

   /* public function showCategorias(){
        $consolas=$this->model->getConsolas();

        foreach($consolas as $consola){
            $juegos=$this->model->getCategoriaEspecifico($consola->ID);
            $this->view->showCategorias($juegos,$consola);

        }
    }
*/

    public function addJuego(){
           // $consolas=$this->model->getConsolas();        
         // $this->view->showFormAddJuego($consolas);

            if ((!isset($_POST['nombreJuego']) || empty($_POST['nombreJuego']))
                ||(!isset($_POST['fechaLanzamiento'])|| empty($_POST['fechaLanzamiento']))
                ||(!isset($_POST['cantidadJugadores']) || empty($_POST['cantidadJugadores']))
                ||(!isset($_POST['categoriaElegidaModal']) || empty($_POST['categoriaElegidaModal']))) {
                $this->view->showMensaje('ingrese los datos correctamente');
            }
            else{

                    $nombre = $_POST['nombreJuego'];
                    $fechaLanzamiento = $_POST['fechaLanzamiento'];
                    $jugadores = $_POST['cantidadJugadores'];
                    $IDConsola = $_POST['categoriaElegidaModal'];
                /////////////////////////////////////////       ESTO ES PARA LO DE LA IMAGEN

                if($_FILES['imagenJuego']['type'] == "image/jpg" || $_FILES['imagenJuego']['type'] == "image/jpeg" || $_FILES['imagenJuego']['type'] == "image/png" ) {
                        $this->model->addJuego($nombre,$fechaLanzamiento,$jugadores,$IDConsola,  $_FILES['imagenJuego']);
                    }
                    else{
                        $this->model->addJuego($nombre,$fechaLanzamiento,$jugadores,$IDConsola);
                        $this->view->showError('error al procesar la imagen');
                    }
                /////////////////////////////////////////

                    //$this->model->addJuego($nombre,$fechaLanzamiento,$jugadores,$IDConsola);
                    $this->view->showMensaje('juego agregado correctamente');
               
            }
            $this->showHome(); 
        }
    

    public function addConsola(){
        
        $this->view->showFormAddConsola();

        if ((!isset($_POST['nombreCategoria']) || empty($_POST['nombreCategoria']))
            ||(!isset($_POST['marcaCategoria'])|| empty($_POST['marcaCategoria']))
            ||(!isset($_POST['colorConsola']) || empty($_POST['colorConsola']))
            ||(!isset($_POST['generacionConsola']) || empty($_POST['generacionConsola']))) {

            $this->view->showMensaje('ingrese los datos correctamente');
        }   

        else{
            $nombre= $_POST['nombreCategoria'];
            $consola=$this->model->getConsolaByName($nombre);
            if($consola){
                $this->view->ShowError('consola existente en el sistema');
            }
            else{
                $nombre = $_POST['nombreCategoria'];
                $marca = $_POST['marcaCategoria'];
                $color = $_POST['colorConsola'];
                $generacion = $_POST['generacionConsola'];
            
                $this->model->addConsola($nombre,$marca,$color,$generacion);
                $this->view->showMensaje('consola agregada correctamente');
            }
            
        }
        $this->showHome();
    
    }


    public function updateConsola(){
            $consolas=$this->model->getConsolas();

        if ((!isset($_POST['nombre']) || empty($_POST['nombre']))
            ||(!isset($_POST['marca'])|| empty($_POST['marca']))
            ||(!isset($_POST['color']) || empty($_POST['color']))
            ||(!isset($_POST['generacion']) || empty($_POST['generacion']))
            ||(!isset($_POST['ID']) || empty($_POST['ID']))) {

            $this->view->showMensaje('ingrese los datos correctamente');
        }   
        else{
            
            $id = $_POST['ID'];
            $nombre = $_POST['nombre'];
            $marca = $_POST['marca'];
            $color = $_POST['color'];
            $generacion = $_POST['generacion'];

            if($id){
               $consola=$this->model->getConsolaByName($nombre);
                
                if($consola){    
                    $this->view->showError('consola no valida, el elemento ya existe');
                }
                else{
                    $this->model->updateConsola($id,$nombre,$marca,$color,$generacion);
                    
                    $this->view->showMensaje('cambio realizado');
                }
            }
        }
    }




public function showModificarJuegos() {
    $juegos=$this->model->getCatalogo();
    $consolas=$this->model->getConsolas();
    $this->view->showUpdateJuegos($juegos,$consolas);

}

/*
    public function updateJuego(){

        if ((!isset($_POST['nombreJuego']) || empty($_POST['nombreJuego']))
            ||(!isset($_POST['fechaLanzamiento'])|| empty($_POST['fechaLanzamiento']))
            ||(!isset($_POST['cantidadJugadores']) || empty($_POST['cantidadJugadores']))
            ||(!isset($_POST['categoriaElegida']) || empty($_POST['categoriaElegida'])) 
            ||(!isset($_POST['ID_juego']) || empty($_POST['ID_juego']))) {

            $this->view->showMensaje('ingrese los datos correctamente');
        }   
        else{
            
            $id = $_POST['ID_juego'];
            $nombre = $_POST['nombreJuego'];
            $fechaLanzamiento = $_POST['fechaLanzamiento'];
            $jugadores = $_POST['cantidadJugadores'];
            $IDConsola = $_POST['categoriaElegida'];
            if($id){
            if($_FILES['imagenJuego']['type'] == "image/jpg" || $_FILES['imagenJuego']['type'] == "image/jpeg" || $_FILES['imagenJuego']['type'] == "image/png" ) {
                $this->model->updateJuego($nombre,$fechaLanzamiento,$jugadores,$IDConsola,  $_FILES['imagenJuego'], $id);
            }
            else{ 
                $this->model->updateJuego($nombre,$fechaLanzamiento,$jugadores,$IDConsola,$id);
                $this->view->showError('error al procesar la imagen');
            }
            }

        }
    }*/

    /*
    public function updateJuego() {
        
            if ((!isset($_POST['nombreJuego']) || empty($_POST['nombreJuego'])) ||
                (!isset($_POST['fechaLanzamiento']) || empty($_POST['fechaLanzamiento'])) ||
                (!isset($_POST['cantidadJugadores']) || empty($_POST['cantidadJugadores'])) ||
                (!isset($_POST['categoriaElegida']) || empty($_POST['categoriaElegida'])) ||
                (!isset($_POST['ID_juego']) || empty($_POST['ID_juego']))) {
    
                $this->view->showMensaje('Ingrese los datos correctamente');
                return;
            }
    
            $id = $_POST['ID_juego'];
            $nombre = $_POST['nombreJuego'];
            $fechaLanzamiento = $_POST['fechaLanzamiento'];
            $jugadores = $_POST['cantidadJugadores'];
            $IDConsola = $_POST['categoriaElegida'];
    
            $imagen = $_FILES['imagenJuego'] ?? null;
            $pathImg = null;
    
            if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
                if ($imagen['type'] == "image/jpg" || $imagen['type'] == "image/jpeg" || $imagen['type'] == "image/png") {
                    $pathImg = $this->model->uploadImage($imagen);
                } else {
                    $this->view->showError('Error: Tipo de imagen no válido');
                    return;
                }
            }
    
            // Llama al modelo para actualizar, pasando la imagen solo si fue subida
            $this->model->updateJuego($nombre, $fechaLanzamiento, $jugadores, $IDConsola, $pathImg, $id);
        
    }
*/
public function updateJuego() {
    if ((!isset($_POST['nombreJuego']) || empty($_POST['nombreJuego'])) ||
        (!isset($_POST['fechaLanzamiento']) || empty($_POST['fechaLanzamiento'])) ||
        (!isset($_POST['cantidadJugadores']) || empty($_POST['cantidadJugadores'])) ||
        (!isset($_POST['categoriaElegida']) || empty($_POST['categoriaElegida'])) ||
        (!isset($_POST['ID_juego']) || empty($_POST['ID_juego']))) {

        $this->view->showMensaje('Ingrese los datos correctamente');
        return;
    }

    $id = $_POST['ID_juego'];
    $nombre = $_POST['nombreJuego'];
    $fechaLanzamiento = $_POST['fechaLanzamiento'];
    $jugadores = $_POST['cantidadJugadores'];
    $IDConsola = $_POST['categoriaElegida'];
    
    // Manejo de la imagen
    $image = $_FILES['imagenJuego'] ?? null;
    $pathImg = null;

    if ($image && $image['error'] === UPLOAD_ERR_OK) {
        if (in_array($image['type'], ['image/jpg', 'image/jpeg', 'image/png'])) {
            $pathImg = $this->model->uploadImage($image);
        } else {
            $this->view->showError('Error: Tipo de imagen no válido');
            return;
        }
    }

    // Llama al modelo para actualizar, pasando la imagen solo si fue subida
    $this->model->updateJuego($nombre, $fechaLanzamiento, $jugadores, $IDConsola, $pathImg, $id);
}


    public function deleteJuego($id){

        if($id){
            $this->model->deleteJuego($id);
           
        }        

    }
    public function deleteConsola($id){
        if($id){
            $this->model->deleteJuego($id);
            $juegos=$this->model->getCatalogo();
            $consolas=$this->model->getConsolas();
            $this->view->showCatalogo($juegos, $consolas);
        }        

    }

}