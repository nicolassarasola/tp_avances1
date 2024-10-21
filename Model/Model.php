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
        return $sentencia->fetch(PDO::FETCH_OBJ);
        
      
    }

    
    public function getCatalogo(){
        $sentencia = $this->db->prepare('SELECT * FROM juegos');
        $sentencia->execute();  
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCatalogoEspecifico($consolaElegida){
        $sentencia= $this->db->prepare('SELECT * FROM `juegos` WHERE ID_consola = ?');
        $sentencia->execute(array($consolaElegida));
       
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
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
        
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }


/////////////////////////////////////////////////

    public function addjuego($nombre,$fechaLanzamiento,$jugadores,$IDConsola, $imagen = null) {
        $pathImg = null;
        if ($imagen)
            $pathImg = $this->uploadImage($imagen);
        
        $query = $this->db->prepare('INSERT INTO  `juegos`(`nombre`, `fecha_lanzamiento`,`jugadores`,`ID_consola`, imagen) VALUES(?,?,?,?,?)');
        $query->execute([$nombre,$fechaLanzamiento,$jugadores,$IDConsola, $pathImg]);

   
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



/*
    public function updateJuego($nombre,$fechaLanzamiento,$jugadores,$IDConsola, $imagen = null,$id){
        $pathImg = null;
   
        try{
            if ($imagen)
                $pathImg = $this->uploadImage($imagen);
                $consulta = $this->db->prepare('UPDATE `consolas` SET `nombre`=?, `fecha_lanzamiento`=?, `jugadores`=?, `ID_consola`=?, imagen=? WHERE ID=?');
               // $consulta = $this->db->prepare('UPDATE`consolas` SET `juegos`(`nombre`=?, `fecha_lanzamiento`=?,`jugadores`=?,`ID_consola`=?, imagen=? WHERE ID=? ');
                $consulta->execute(array($nombre,$fechaLanzamiento,$jugadores,$IDConsola,$pathImg,$id));    
        }
        catch(Exception $e){
            return;
        }
        
    }*/

   /* public function updateJuego($nombre, $fechaLanzamiento, $jugadores, $IDConsola, $imagen = null, $id) {
        $pathImg = $imagen ? $this->uploadImage($imagen) : null;
    
        try {
            $consulta = $this->db->prepare('UPDATE `consolas` SET `nombre`=?, `fecha_lanzamiento`=?, `jugadores`=?, `ID_consola`=?, imagen=? WHERE ID=?');
            $consulta->execute(array($nombre, $fechaLanzamiento, $jugadores, $IDConsola, $pathImg, $id));
        } catch (Exception $e) {
            // Maneja la excepción, tal vez loguear el error
            return;
        }
    }*/


    public function updateJuego($nombre, $fechaLanzamiento, $jugadores, $IDConsola, $imagen = null, $id) {
        $pathImg = null;
    
        // Si se proporciona una imagen, se procesa y se guarda
        if ($imagen) {
            $pathImg = $this->uploadImage($imagen);
        }
    
        try {
            // Preparar la consulta SQL para la actualización
            if ($pathImg) {
                // Si se ha subido una imagen, se incluye en la actualización
                $query = $this->db->prepare('UPDATE juegos SET nombre = ?, fecha_lanzamiento = ?, jugadores = ?, ID_consola = ?, imagen = ? WHERE ID = ?');
                $query->execute(array($nombre, $fechaLanzamiento, $jugadores, $IDConsola, $pathImg, $id));
            } else {
                // Si no se sube imagen, se actualizan los demás campos sin modificar la imagen
                $query = $this->db->prepare('UPDATE juegos SET nombre = ?, fecha_lanzamiento = ?, jugadores = ?, ID_consola = ? WHERE ID = ?');
                $query->execute(array($nombre, $fechaLanzamiento, $jugadores, $IDConsola, $id));
            }
        } catch (Exception $e) {
            // Manejo de la excepción
            return false;
        }
    
        return true;
    }
    
    
    
    public function updateConsola( $nombre,$marca,$color,$generacion,$id){
        
        try{
            $query = $this->db->prepare('UPDATE`consolas` SET `nombre`=?, `fecha_lanzamiento`=?,`jugadores`=?,`ID_consola`=?, imagen WHERE ID=? ');
            $query->execute(array($nombre,$marca,$color,$generacion,$id));
            
        }
        catch(Exception $e){
            return;
        }
        
    }





   /* public function deleteJuego($id){
        $query = $this->db->prepare('DELETE FROM `juegos` WHERE ID=?');
        $query->execute($id);
    }*/
    public function deleteJuego($id) {
        $query = $this->db->prepare('DELETE FROM `juegos` WHERE ID=?');
        $query->execute([$id]); // Asegúrate de pasar el ID como un array
    }
    
    public function deleteConsola($id){
        $query = $this->db->prepare('DELETE FROM `consolas` WHERE ID=?');
        $query->execute($id);
    }

}