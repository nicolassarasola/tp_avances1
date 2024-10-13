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


}