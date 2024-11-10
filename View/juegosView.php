<?php

class juegosView{
   
   public function __construct(){
    
   }

   public function ShowHome(){
    require_once './Templates/header.phtml';
   }


     public function showCatalogo($juegos)
     {
      require_once './Templates/header.phtml';
     
       require_once './Templates/headerTabla.phtml';
       require_once 'Templates/showCatalogo.phtml';
   }

   public function showCatalogoEspecifico($categoriaElegida, $consolas, $nombreConsola)
   {
      require_once './Templates/header.phtml';
      require_once './Templates/headerTabla.phtml';
      require_once 'Templates/showCatalogoEspecifico.phtml';
   }



   public function getId($valor){
      require_once './Templates/header.phtml';
      require_once './templates/formJuego.phtml';
     
   }

   public function showJuego($juego, $consola){
      require_once './Templates/header.phtml';
    
       require_once './Templates/headerTabla.phtml';
       require_once './templates/showJuego.phtml';
   }
   
   public function showCategoria($juegos){
      require_once './Templates/header.phtml';
     
      require_once './Templates/formAddJuego.phtml';
       require_once 'Templates/formAddConsola.phtml';
       require_once './Templates/headerTabla.phtml';
      require_once './Templates/showCatalogo.phtml';
   }
   public function showCategorias($categorias){

      require_once './Templates/header.phtml';
   
      echo '<h2>Listado de Categorías</h2>';
   
      foreach ($categorias as $categoria) {
            
           
            require './Templates/headerTabla.phtml';
   
           
            $juegos = $categoria['juegos'];
            $consola = $categoria['consola'];
            
          
            include './Templates/showCategorias.phtml';
            
            
      }
   
      
      require_once './Templates/showFooter.phtml';
   }
    
   


  
   public function showFormAddJuego($consolas){
      require_once './Templates/header.phtml';
      require_once './Templates/formAddJuego.phtml';
   }


   public function showUpdateJuegos($juegos,$consolas){
      require_once './Templates/header.phtml';
      require_once './Templates/formUpdateJuego.phtml';
      require './Templates/showFooter.phtml';
     
   }

   public function showDeleteJuego($juegos){
      require_once './Templates/header.phtml';
      require_once './Templates/formDeleteJuego.phtml';
   }
   
}