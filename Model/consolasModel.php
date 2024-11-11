<?php
require_once './config.php';
require_once './Model/model.php';
class consolasModel extends model{


public function getConsola($id)
{
    $sentencia = $this->db->prepare('SELECT * FROM `consolas` WHERE ID = ?');
    $sentencia->execute([$id]);
    $consola = $sentencia->fetch(PDO::FETCH_OBJ);

    return $consola;
}

public function getNameConsola($id)
{
    $sentencia = $this->db->prepare('SELECT nombre FROM `consolas` WHERE ID = ?');
    $sentencia->execute(array($id));
    $consola = $sentencia->fetch(PDO::FETCH_OBJ);

    return $consola;
}



public function getConsolaByName($nombre)
{
    $sentencia = $this->db->prepare('SELECT * FROM `consolas` WHERE nombre = ?');
    $sentencia->execute(array($nombre));
    $consola = $sentencia->fetch(PDO::FETCH_OBJ);

    return $consola;
}

public function getConsolas()
{
    $sentencia = $this->db->prepare('SELECT * FROM `consolas`');
    $sentencia->execute();

    return $sentencia->fetchAll(PDO::FETCH_OBJ);
}






public function addConsola($nombre, $marca, $color, $generacion)
{
   
        $sentencia = $this->db->prepare("INSERT INTO `consolas`(`nombre`, `marca`,`color`,`generacion`) VALUES (?,?,?,?)");
        
        $sentencia->execute([$nombre, $marca, $color, $generacion]);

}

public function updateConsola($nombre, $marca, $color, $generacion, $id)
{

    $query = $this->db->prepare('UPDATE consolas SET nombre=?, marca=?, color=?, generacion =? WHERE ID=? ');
    $query->execute([$nombre, $marca, $color, $generacion, $id]);
    return true;
}



public function deleteConsola($id)
{
    $query = $this->db->prepare('DELETE FROM `consolas` WHERE ID=?');
    $query->execute([$id]);
}

}