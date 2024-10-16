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

    public function getCategoriaEspecifica($IDConsola){
        $sentencia= $this->db->prepare('SELECT * FROM `juegos` WHERE ID_consola = ?');
        $sentencia->execute(array($IDConsola));
       
        return $juegos=$sentencia->fetchAll(PDO::FETCH_OBJ);
    }



    public function getConsola($id){  
        $sentencia= $this->db->prepare('SELECT * FROM `consolas` WHERE ID = ?');
        $sentencia->execute(array($id));  
        $consola = $sentencia->fetch(PDO::FETCH_OBJ);
        
        return $consola;
    } 


    public function getConsolaByName($nombre){  
        $sentencia= $this->db->prepare('SELECT * FROM `consolas` WHERE nombre = ?');
        $sentencia->execute(array($nombre));  
        $consola = $sentencia->fetch(PDO::FETCH_OBJ);
        
        return $consola;
    } 

    public function getConsolas(){
        $sentencia= $this->db->prepare('SELECT * FROM `consolas`');
        $sentencia->execute(); 
        
        return $consolas=$sentencia->fetchAll(PDO::FETCH_OBJ);
    }


    public function addJuego($nombre,$fechaLanzamiento,$jugadores,$IDConsola){
    
        try{
        $sentencia = $this->db->prepare("INSERT INTO `juegos`(`nombre`, `fecha_lanzamiento`,`jugadores`,`ID_consola`) VALUES (?,?,?,?)");

            $sentencia->execute([$nombre,$fechaLanzamiento,$jugadores,$IDConsola]);
        }
        catch(Exception $e){
            return;
        }
    }

    public function addConsola($nombre,$marca,$color,$generacion){
        try{
            $sentencia = $this->db->prepare("INSERT INTO `consolas`(`nombre`, `marca`,`color`,`generacion`) VALUES (?,?,?,?)");
    
                $sentencia->execute([$nombre,$marca,$color,$generacion]);
            }
            catch(Exception $e){
                return;
            }
    }


    public function updateConsola($id,$nombre,$marca,$color,$generacion){
        
        try{
            $consulta = $this->db->prepare('UPDATE`consolas` SET `nombre`=?, `marca`=?, `color`=?, `generacion`=? WHERE ID=? ');
            $consulta->execute(array($nombre,$marca,$color,$generacion,$id));
            
        }
        catch(Exception $e){
            return;
        }
        
    }

    public function updateJuego($nombre,$fechaLanzamiento,$jugadores,$IDConsola,$id){
        
        try{
            $consulta = $this->db->prepare('UPDATE`consolas` SET `juegos`(`nombre`=?, `fecha_lanzamiento`=?,`jugadores`=?,`ID_consola`=? WHERE ID=? ');
            $consulta->execute(array($nombre,$fechaLanzamiento,$jugadores,$IDConsola,$id));
            
        }
        catch(Exception $e){
            return;
        }
        
    }

}