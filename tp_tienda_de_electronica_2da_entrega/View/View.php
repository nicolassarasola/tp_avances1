<?php

class View{
   
   public function __construct(){
    
   }

   public function ShowHome(){
    require_once './Templates/header.phtml';
   }

   public function showCatalogo($juego, $consola){
      require_once './Templates/header.phtml';
      require_once './Templates/headerTabla.phtml';
      require './templates/showJuego.phtml';
   }

   public function getId($valor){
      require_once './Templates/header.phtml';
      require_once './templates/formJuego.phtml';
     
   }

   public function showJuego($juego, $consola){
       require_once './Templates/header.phtml';
       require_once './templates/showJuego.phtml';
   }
   
   public function showCategoria($juegos){
      require_once './Templates/header.phtml';
      require_once './Templates/showCatalogo.phtml';
   }
   public function showCategorias($juegos,$consola){
      require_once './Templates/header.phtml';
      echo '<h2>'. $consola->nombre.'</h2>';
      foreach($juegos as $juego){ 
      
         require './Templates/showCategorias.phtml';
        
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
}