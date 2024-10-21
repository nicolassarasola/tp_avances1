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
           if ($juego) { // Comparación estricta
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
            $consolas=$this->model->getConsolas();        
            $this->view->showFormAddJuego($consolas);

          
            if ((!isset($_POST['nombreJuego']) || empty($_POST['nombreJuego']))
                ||(!isset($_POST['fechaLanzamiento'])|| empty($_POST['fechaLanzamiento']))
                ||(!isset($_POST['cantidadJugadores']) || empty($_POST['cantidadJugadores']))
                ||(!isset($_POST['categoriaID']) || empty($_POST['categoriaID']))) {
                $this->view->showMensaje('ingrese los datos correctamente');
               
            } 
            else{
              
                    $nombre = $_POST['nombreJuego'];
                    $fechaLanzamiento = $_POST['fechaLanzamiento'];
                    $jugadores = $_POST['cantidadJugadores'];
                    $IDConsola = $_POST['categoriaID'];
                /////////////////////////////////////////       ESTO ES PARA LO DE LA IMAGEN
                
                    if($_FILES['input_name']['type'] == "image/jpg" || $_FILES['input_name']['type'] == "image/jpeg" || $_FILES['input_name']['type'] == "image/png" ) {
                        $this->model->addJuego($nombre,$fechaLanzamiento,$jugadores,$IDConsola,  $_FILES['input_name']);
                    }
                    else{
                        $this->model->addJuego($nombre,$fechaLanzamiento,$jugadores,$IDConsola);
                        $this->view->showError('error al procesar la imagen');
                    }
                /////////////////////////////////////////

                    $this->view->showMensaje('juego agregado correctamente');
               
            }
            
            $this->showHome(); 
        }
    

    public function addConsola(){
        
        $this->view->showFormAddConsola();

        if ((!isset($_POST['nombreCategoria']) || empty($_POST['nombreCategoria']))
            ||(!isset($_POST['marca'])|| empty($_POST['marca']))
            ||(!isset($_POST['color']) || empty($_POST['color']))
            ||(!isset($_POST['generacion']) || empty($_POST['generacion']))) {

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
                $marca = $_POST['marca'];
                $color = $_POST['color'];
                $generacion = $_POST['generacion'];
            
                $this->model->addConsola($nombre,$marca,$color,$generacion);
                $this->view->showMensaje('consola agregada correctamente');
            }
            
        }
        $this->showHome();
    
    }


    public function updateJuego() {
        // Obtener datos necesarios para mostrar el formulario de actualización
        $juegos = $this->model->getCatalogo();
        $consolas = $this->model->getConsolas();
        $this->view->showUpdateJuegos($juegos, $consolas);
    
        // Verificar que los datos del formulario fueron enviados
        if ((!isset($_POST['nombre']) || empty($_POST['nombre']))
            || (!isset($_POST['fecha_lanzamiento']) || empty($_POST['fecha_lanzamiento']))
            || (!isset($_POST['jugadores']) || empty($_POST['jugadores']))
            || (!isset($_POST['ID_consola']) || empty($_POST['ID_consola'])) 
            || (!isset($_POST['ID']) || empty($_POST['ID']))) {
    
            // Mostrar mensaje de error si los datos son incorrectos o incompletos
            $this->view->showMensaje('Ingrese los datos correctamente');
        } else {
            // Asignar valores recibidos del formulario a variables
            $id = $_POST['ID'];
            $nombre = $_POST['nombre'];
            $fecha_lanzamiento = $_POST['fecha_lanzamiento'];
            $jugadores = $_POST['jugadores'];
            $IDConsola = $_POST['ID_consola'];
    
            // Verificar si se ha subido una imagen y si es de tipo permitido
            if (isset($_FILES['input_name']['name']) && !empty($_FILES['input_name']['name'])) {
                // Verificar tipo de imagen
                if ($_FILES['input_name']['type'] == "image/jpg" || 
                    $_FILES['input_name']['type'] == "image/jpeg" || 
                    $_FILES['input_name']['type'] == "image/png") {
                    // Procesar imagen y actualizar juego
                    $this->model->updateJuego($nombre, $fecha_lanzamiento, $jugadores, $IDConsola, $_FILES['input_name'], $id);
                    $this->view->showMensaje('Juego actualizado correctamente');
                } else {
                    // Si la imagen no es válida, mostrar error
                    $this->view->showError('Error al procesar la imagen. Formato no permitido.');
                }
            } else {
                // Si no se subió una imagen, actualizar el juego sin imagen
                $this->model->updateJuego($nombre, $fecha_lanzamiento, $jugadores, $IDConsola, null, $id);
                $this->view->showMensaje('Juego actualizado sin modificar la imagen.');
            }
        }
    }
    
    


public function updateConsola(){
    $consolas=$this->model->getConsolas();
    $this->view->showUpdateConsolas($consolas);

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
            $this->model->updateConsola($nombre,$marca,$color,$generacion,$id);
            
            $this->view->showMensaje('cambio realizado');
        }
    }
}
}

    
    public function deleteJuego($id) {
        // Obtener el catálogo de juegos y mostrar la vista de eliminación
        $juegos = $this->model->getCatalogo();
        $this->view->showDeleteJuego($juegos);

        // Verificar si se ha enviado el ID desde el formulario
        if (isset($_POST['ID']) && !empty($_POST['ID'])) {
            $id = $_POST['ID'];

            // Verificar si el juego existe antes de eliminarlo
            if ($this->model->getJuego($id)) {
                $this->model->deleteJuego($id);
            }
        }
    }
    public function deleteConsola($id) {
        // Obtener las consolas y mostrar la vista de eliminación
        $consolas = $this->model->getConsolas(); 
        $this->view->showDeleteConsola($consolas);

        // Verificar si se ha enviado el ID desde el formulario
        if (isset($_POST['ID']) && !empty($_POST['ID'])) {
            $id = $_POST['ID'];

            // Verificar si la consola existe antes de eliminarla
            if ($this->model->getConsola($id)) {
                $this->model->deleteConsola($id); // Cambiar a deleteConsola
                $this->view->showMensaje('Consola eliminada correctamente.');
            }
        }
    }

}