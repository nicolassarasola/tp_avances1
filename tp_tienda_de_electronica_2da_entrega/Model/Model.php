<?php
class Model { 

    private $db;
    
    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=_tp_tienda_de_electronica;charset=utf8', 'root', '');
    }

    public function getJuego($id){  
        $sentencia= $this->db->prepare('SELECT * FROM `juegos` WHERE ID = ?');
        $sentencia->execute(array($id));  
        $juego = $sentencia->fetch(PDO::FETCH_OBJ);
        
        return $juego;
    }

    public function getJuegos(){
        $sentencia= $this->db->prepare('SELECT * FROM juegos');
        $sentencia->execute();  

        return $juegos = $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCategoriaEspecifica($idConsola){
        $sentencia= $this->db->prepare('SELECT * FROM `juegos` WHERE ID_consola = ?');
        $sentencia->execute(array($idConsola));
       
        return $juegos=$sentencia->fetchAll(PDO::FETCH_OBJ);
    }



    

    public function getConsola($id){  
        $sentencia= $this->db->prepare('SELECT * FROM `consolas` WHERE ID = ?');
        $sentencia->execute(array($id));  
        $consola = $sentencia->fetch(PDO::FETCH_OBJ);
        
        return $consola;
    }



    
    public function getConsolas(){
        $sentencia= $this->db->prepare('SELECT * FROM `consolas`');
        $sentencia->execute(); 
        
        return $consolas=$sentencia->fetchAll(PDO::FETCH_OBJ);
    }

}