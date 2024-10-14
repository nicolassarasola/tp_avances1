<?php

class AuthView{
   private $user=null;

   public function showLogin(){
      require './Templates/formLogin.phtml';
   }

   public function showError($error){
      require './Templates/showError.phtml';
   }

}