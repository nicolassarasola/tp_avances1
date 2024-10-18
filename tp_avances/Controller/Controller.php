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
        
        $juegos=$this->model->getJuegos();

        foreach($juegos as $juego){
            $consola=$this->model->getConsola($juego->ID_consola);
            $this->view->showCatalogo($juego,$consola);
        }
    }

    public function showJuego(){   
        $this->view->getId('juego');
        
        if(!empty($_POST['ID'])){
            $id = $_POST['ID'];
        
            if($id){
                $juego=$this->model->getJuego($id);
                if($juego){
                    $consola=$this->model->getConsola($juego->ID_consola);
                    $this->view->showJuego($juego,$consola); 
                }
                else{
                    $this->view->showError('ese juego no existe');
                }
            }
        }
        else{
            $this->view->showMensaje('por favor inserte id del juego a buscar');
        }
        
    }

    public function showCategoriaEspecifica(){
        $this->view->getId('categoria');
        if(!empty($_POST['ID'])){
            $id = $_POST['ID']; 
            
            if($id){
                $consola=$this->model->getConsola($id);
                $juegos=$this->model->getCategoriaEspecifica($id);
                foreach($juegos as $juego){
                    $this->view->showCatalogo($juego,$consola);
                }
            }        
        }
        else{
            $this->view->showMensaje('por favor inserte id de la categoria a buscar');
        }
    }

    public function showCategorias(){
        $consolas=$this->model->getConsolas();

        foreach($consolas as $consola){
            $juegos=$this->model->getCategoriaEspecifica($consola->ID);
            $this->view->showCategorias($juegos,$consola);

        }
    }


    public function addJuego(){
        
            $this->view->showFormAddJuego();

            if ((!isset($_POST['nombre']) || empty($_POST['nombre']))
                ||(!isset($_POST['fecha_lanzamiento'])|| empty($_POST['fecha_lanzamiento']))
                ||(!isset($_POST['jugadores']) || empty($_POST['jugadores']))
                ||(!isset($_POST['ID_consola']) || empty($_POST['ID_consola']))) {
                $this->view->showMensaje('ingrese los datos correctamente');
            }
            else{

                    $nombre = $_POST['nombre'];
                    $fechaLanzamiento = $_POST['fecha_lanzamiento'];
                    $jugadores = $_POST['jugadores'];
                    $idConsola = $_POST['ID_consola'];
                
                    $this->model->addJuego($nombre,$fechaLanzamiento,$jugadores,$idConsola);
                    $this->view->showMensaje('juego agregado correctamente');
                
            }
            $this->showHome();
        
    }

    public function addConsola(){
        
        $this->view->showFormAddConsola();

        if ((!isset($_POST['nombre']) || empty($_POST['nombre']))
            ||(!isset($_POST['marca'])|| empty($_POST['marca']))
            ||(!isset($_POST['color']) || empty($_POST['color']))
            ||(!isset($_POST['generacion']) || empty($_POST['generacion']))) {

            $this->view->showMensaje('ingrese los datos correctamente');
        }   

        else{
            $nombre= $_POST['nombre'];
            $consola=$this->model->getConsolaByName($nombre);
            if($consola){
                $this->view->ShowError('consola existente en el sistema');
            }
            else{
                $nombre = $_POST['nombre'];
                $marca = $_POST['marca'];
                $color = $_POST['color'];
                $generacion = $_POST['generacion'];
            
                $this->model->addConsola($nombre,$marca,$color,$generacion);
                $this->view->showMensaje('consola agregada correctamente');
            }
            
        }
        $this->showHome();
    
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
                    $this->model->updateConsola($id,$nombre,$marca,$color,$generacion);
                    
                    $this->view->showMensaje('cambio realizado');
                }
            }
        }
    }








    public function updateJuego(){
        $juegos=$this->model->getJuegos();
        $consolas=$this->model->getConsolas();
        $this->view->showUpdateJuegos($juegos,$consolas);

    if ((!isset($_POST['nombre']) || empty($_POST['nombre']))
        ||(!isset($_POST['fecha_lanzamiento'])|| empty($_POST['fecha_lanzamiento']))
        ||(!isset($_POST['jugadores']) || empty($_POST['jugadores']))
        ||(!isset($_POST['ID_consola']) || empty($_POST['ID_consola'])) 
        ||(!isset($_POST['ID']) || empty($_POST['ID']))) {

        $this->view->showMensaje('ingrese los datos correctamente');
    }   
    else{
        
        $id = $_POST['ID'];
        $nombre = $_POST['nombre'];
        $fecha_lanzamiento = $_POST['fecha_lanzamiento'];
        $jugadores = $_POST['jugadores'];
        $IDConsola = $_POST['ID_consola'];

        if($id){
    
            $this->model->updateConsola($nombre,$fecha_lanzamiento,$jugadores,$IDConsola,$id);
            
            $this->view->showMensaje('cambio realizado');
            
        }



    }
}

    

}