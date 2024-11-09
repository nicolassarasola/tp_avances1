
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


    public function addjuego($nombre, $fechaLanzamiento, $jugadores, $IDConsola, $imagen = null){


            $query = $this->db->prepare('INSERT INTO juegos (nombre, fecha_lanzamiento, jugadores, ID_consola) VALUES (?, ?, ?, ?)');
       $query->execute([$nombre, $fechaLanzamiento, $jugadores, $IDConsola]);
        
    }



    
    
  

    public function addConsola($nombre, $marca, $color, $generacion)
    {
       
            $sentencia = $this->db->prepare("INSERT INTO `consolas`(`nombre`, `marca`,`color`,`generacion`) VALUES (?,?,?,?)");
            
            $sentencia->execute([$nombre, $marca, $color, $generacion]);

    }

    
    //
    
    
    public function updateJuego($nombre, $fechaLanzamiento, $jugadores, $IDConsola, $id)
    {
        $query = $this->db->prepare('UPDATE juegos SET nombre = ?, fecha_lanzamiento = ?, jugadores = ?, ID_consola = ? WHERE ID = ?');
        $query->execute([$nombre, $fechaLanzamiento, $jugadores, $IDConsola, $id]);       

        return true;
    }



    public function updateConsola($nombre, $marca, $color, $generacion, $id)
    {

        $query = $this->db->prepare('UPDATE consolas SET nombre=?, marca=?, color=?, generacion =? WHERE ID=? ');
        $query->execute([$nombre, $marca, $color, $generacion, $id]);
        return true;
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