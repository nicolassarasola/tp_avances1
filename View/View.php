<?php

class View{
   
   public function __construct(){
    
   }

   public function ShowHome(){
    require_once './Templates/header.phtml';
   }

   /*
   public function showCatalogo($juego, $consola){
    require_once './Templates/header.phtml';
      require_once './Templates/headerTabla.phtml';
      require './templates/showJuego.phtml';
      } */
     public function showCatalogo($juegos, $consolas)
     {
      require_once './Templates/header.phtml';
      require_once './Templates/formBuscador.phtml';
       require_once './Templates/headerTabla.phtml';
       require_once 'Templates/showCatalogo.phtml';
   }

   public function showCatalogoEspecifico($categoriaElegida, $consolas)
   {
      require_once './Templates/header.phtml';
      require_once './Templates/formBuscador.phtml';
      require_once './Templates/formAddJuego.phtml';
       require_once 'Templates/formAddConsola.phtml';
       require_once './Templates/headerTabla.phtml';
     require_once 'Templates/showCatalogoEspecifico.phtml';
 }


 public function showError404(){
   require_once './Templates/showError404.phtml';
   
}

   public function getId($valor){
      require_once './Templates/header.phtml';
      require_once './templates/formJuego.phtml';
     
   }

   public function showJuego($juego, $consolas){
      require_once './Templates/header.phtml';
      require_once './Templates/formBuscador.phtml';
       require_once './Templates/headerTabla.phtml';
       require_once './templates/showJuego.phtml';
   }
   
   public function showCategoria($juegos){
      require_once './Templates/header.phtml';
      require_once './Templates/formBuscador.phtml';
      require_once './Templates/formAddJuego.phtml';
       require_once 'Templates/formAddConsola.phtml';
       require_once './Templates/headerTabla.phtml';
      require_once './Templates/showCatalogo.phtml';
   }
   public function showCategorias($juegos,$consola){
      require_once './Templates/header.phtml';
      echo '<h2>'. $consola->nombre.'</h2>';
      
      foreach($juegos as $juego){ 

         require './Templates/showJuego.phtml';
        
      }
      echo '----------------------------------------';
   }


   public function showMensaje($mensaje){
      require_once './Templates/header.phtml';
      require_once './Templates/showMensaje.phtml';
   }

   public function showError($error){
      require_once './Templates/header.phtml';
      require_once './Templates/showError.phtml';
   }

   public function showFormAddJuego($consolas){//<-----falta agregar el seleccionar la consola a la que pertenece clickeandola
      require_once './Templates/header.phtml';
      require_once './Templates/formAddJuego.phtml';
   }

   public function showFormAddConsola(){
      require_once './Templates/header.phtml';
      require_once './Templates/formAddConsola.phtml';
   }

   public function showUpdateConsolas($consolas){
      require_once './Templates/header.phtml';
      require_once './Templates/formUpdateConsola.phtml';
   }

   public function showUpdateJuegos($juegos,$consolas){
      require_once './Templates/header.phtml';
      require_once './Templates/formUpdateJuego.phtml';
      require_once './Templates/headerTabla.phtml';
      require_once './Templates/showCatalogo.phtml';
   }

   public function showDeleteConsola($consolas){
      require_once './Templates/header.phtml';
      require_once './Templates/formDeleteConsolas.phtml';
      require_once './Templates/showCatalogo.phtml';
   }

   public function showDeleteJuego($juegos){
      require_once './Templates/header.phtml';
      require_once './Templates/formDeleteJuego.phtml';
      require_once './Templates/showCatalogo.phtml';
   }
   
}