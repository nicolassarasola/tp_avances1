<?php
require_once './config.php';
require_once './Model/model.php';
class juegosModel extends model {



    public function getJuegos()
    {
        $sentencia = $this->db->prepare('SELECT * FROM juegos');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public function getJuegosByConsola($consolaID)
    {
        $sentencia = $this->db->prepare('SELECT * FROM juegos WHERE ID_consola = ?  ');
        $sentencia->execute([$consolaID]);

        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public function getJuegoByid($id)
    {
        $sentencia = $this->db->prepare('SELECT * FROM `juegos` WHERE ID = ?');
        $sentencia->execute([$id]);
        return $sentencia->fetch(PDO::FETCH_OBJ);


    }



    
    public function addjuego($nombre, $fechaLanzamiento, $jugadores, $IDConsola, $imagen = null){
        $query = $this->db->prepare('INSERT INTO juegos (nombre, fecha_lanzamiento, jugadores, ID_consola) VALUES (?, ?, ?, ?)');
        $query->execute([$nombre, $fechaLanzamiento, $jugadores, $IDConsola]);       
    }

 
    public function updateJuego($nombre, $fechaLanzamiento, $jugadores, $IDConsola, $id)
    {
        $query = $this->db->prepare('UPDATE juegos SET nombre = ?, fecha_lanzamiento = ?, jugadores = ?, ID_consola = ? WHERE ID = ?');
        $query->execute([$nombre, $fechaLanzamiento, $jugadores, $IDConsola, $id]);       

        return true;
    }


    public function deleteJuego($id)
    {
        $query = $this->db->prepare('DELETE FROM juegos WHERE ID=?');
        $query->execute([$id]);
    }
    

}

?>