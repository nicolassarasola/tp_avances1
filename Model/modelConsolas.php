<?php
require_once './config.php';

class modelConsolas{

    protected $db;

    public function __construct()
    {
        $this->db = new PDO(
            "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8",
            MYSQL_USER,
            MYSQL_PASS
        );
    }

////COMANDOS CONSOLAS
public function checkConsola($consolaElegida)
{
    $sentencia = $this->db->prepare('SELECT ID, nombre FROM consolas WHERE ID = ?');
    $sentencia->execute([$consolaElegida]);

    return $sentencia->fetch(PDO::FETCH_OBJ);
}
/*
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

return $resultado ? intval ($resultado->ID) : null;
*/

public function getConsola($id)
{
    $sentencia = $this->db->prepare('SELECT * FROM `consolas` WHERE ID = ?');
    $sentencia->execute(array($id));
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



}