<?php

class messageView {

    public function showMensaje($mensaje){
        require_once './Templates/header.phtml';
        require_once './Templates/showMensaje.phtml';
     }
  
     public function showError($error){
        require_once './Templates/header.phtml';
        require_once './Templates/showError.phtml';
     }
  



}