<?php

    function sessionAuthMiddleware($res){
        session_start();
       
       if(isset( $_SESSION['email'])){
            $res->user = new stdClass();

            $res->user->id = $_SESSION['ID_USER'];
            $res->user->email = $_SESSION['email'];
            echo $res->user->id = $_SESSION['ID_USER'] .'  '.$res->user->email = $_SESSION['email'];
            return;
       }
       else{
          echo 'nop';
           // header('location: '.BASE_URL.'showLogin');
       }


    }



?>