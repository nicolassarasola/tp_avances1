<?php
require_once './config.php';
class Model { 
    protected $db;

    public function __construct() {
        $this->db = new PDO(
        "mysql:host=".MYSQL_HOST .";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
    }


    private function _deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables) == 0) {
            $sql =<<<END

		END;
        $this->db->query($sql);
    }
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


/////////////////////////////////////////////////

    public function addjuego($nombre,$fechaLanzamiento,$jugadores,$IDConsola, $imagen = null) {
        $pathImg = null;
        if ($imagen)
            $pathImg = $this->uploadImage($imagen);

        $query = $this->db->prepare('INSERT INTO  `juegos`(`nombre`, `fecha_lanzamiento`,`jugadores`,`ID_consola`, imagen) VALUES(?,?,?,?,?)');
        $query->execute([$nombre,$fechaLanzamiento,$jugadores,$IDConsola, $pathImg]);

        return $this->db->lastInsertId();
    }

    private function uploadImage($image){
   
        $target = './img/juego/' . uniqid() . "." . strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));  
        move_uploaded_file($image['tmp_name'], $target);
        return $target;
    }



//////////////////////////////////////////////////


    public function addConsola($nombre,$marca,$color,$generacion){
        try{
            $sentencia = $this->db->prepare("INSERT INTO `consolas`(`nombre`, `marca`,`color`,`generacion`) VALUES (?,?,?,?)");
    
                $sentencia->execute([$nombre,$marca,$color,$generacion]);
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
    
    public function updateConsola($id,$nombre,$marca,$color,$generacion){
        
        try{
            $consulta = $this->db->prepare('UPDATE`consolas` SET `nombre`=?, `marca`=?, `color`=?, `generacion`=? WHERE ID=? ');
            $consulta->execute(array($nombre,$marca,$color,$generacion,$id));
            
        }
        catch(Exception $e){
            return;
        }
        
    }




}