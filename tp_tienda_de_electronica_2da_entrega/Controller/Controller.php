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
        

        $this->view->showCatalogo($juegos);
    }

    public function showJuego(){   
        $this->view->getId('juego');
    
        $id = $_POST['ID'];
        
        if($id){
            $juego=$this->model->getJuego($id);
            if($juego){
            $this->view->showJuego($juego); 
            }
            else{
                $this->view->showError('ese juego no existe');
            }
        }
        
    }


    public function showCategoriaEspecifica(){
        $this->view->getId('categoria');
        $id = $_POST['ID']; 
        
        if($id){
            $juegos=$this->model->getCategoriaEspecifica($id);
                if($juegos){
                    $this->view->showCategoria($juegos);
                }
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