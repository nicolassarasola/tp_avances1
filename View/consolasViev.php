<?php

class consolasView{
   
   public function __construct(){
    
   }

    public function showFormAddConsola(){
       require_once './Templates/header.phtml';
       require_once './Templates/formAddConsola.phtml';
    }

    public function showUpdateConsolas($consolas){
       require_once './Templates/header.phtml';
       require_once './Templates/formUpdateConsola.phtml';
    }

    public function showDeleteConsola($consolas){
        require_once './Templates/header.phtml';
        require_once './Templates/formDeleteConsolas.phtml';
     }
}