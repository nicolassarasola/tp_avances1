
<?php
require_once './config.php';

class modelCrud {

    protected $db;

    public function __construct()
    {
        $this->db = new PDO(
            "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8",
            MYSQL_USER,
            MYSQL_PASS
        );
    }


/////////////////////////////////////////////////
    
    public function addjuego($nombre, $fechaLanzamiento, $jugadores, $IDConsola, $imagen = null)
    {
        $pathImg = null;
        if ($imagen)
            $pathImg = $this->uploadImage($imagen);

            $query = $this->db->prepare('INSERT INTO juegos (nombre, fecha_lanzamiento, jugadores, ID_consola, imagen) VALUES (?, ?, ?, ?, ?)');
       $query->execute([$nombre, $fechaLanzamiento, $jugadores, $IDConsola, $pathImg]);
        
    }

    private function uploadImage($image)
    {
        
        $target = './img/juego/' . uniqid() . "." . strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        move_uploaded_file($image['tmp_name'], $target);
        return $target;
    }

    
    //////////////////////////////////////////////////
    
    
  

    public function addConsola($nombre, $marca, $color, $generacion)
    {
       
            $sentencia = $this->db->prepare("INSERT INTO `consolas`(`nombre`, `marca`,`color`,`generacion`) VALUES (?,?,?,?)");
            
            $sentencia->execute([$nombre, $marca, $color, $generacion]);

    }

    
    //
    
    
    public function updateJuego($nombre, $fechaLanzamiento, $jugadores, $IDConsola, $imagen = null, $id)
    {
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
                $query->execute([$nombre, $fechaLanzamiento, $jugadores, $IDConsola, $pathImg, $id]);
            } else {
                // Si no se sube imagen, se actualizan los demás campos sin modificar la imagen
                $query = $this->db->prepare('UPDATE juegos SET nombre = ?, fecha_lanzamiento = ?, jugadores = ?, ID_consola = ? WHERE ID = ?');
                $query->execute([$nombre, $fechaLanzamiento, $jugadores, $IDConsola, $id]);
            }
        } catch (Exception $e) {
            // Manejo de la excepción
            return false;
        }

        return true;
    }



    public function updateConsola($nombre, $marca, $color, $generacion, $id)
    {

        try {
            $query = $this->db->prepare('UPDATE consolas SET nombre=?, marca=?, color=?, generacion =? WHERE ID=? ');
            $query->execute([$nombre, $marca, $color, $generacion, $id]);
            
        } catch (Exception $e) {
            return;
        }
        
    }




    

    public function deleteJuego($id)
    {
        $query = $this->db->prepare('DELETE FROM juegos WHERE ID=?');
        $query->execute([$id]);
    }
    
    public function deleteConsola($id)
    {
        $query = $this->db->prepare('DELETE FROM `consolas` WHERE ID=?');
        $query->execute([$id]);
    }

    }

    ?>