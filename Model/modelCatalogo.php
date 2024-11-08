<?php
require_once './config.php';

class modelCatalogo {

    protected $db;

    public function __construct()
    {
        $this->db = new PDO(
            "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8",
            MYSQL_USER,
            MYSQL_PASS
        );
    }

    public function getCatalogo()
    {
        $sentencia = $this->db->prepare('SELECT * FROM juegos');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCatalogoEspecifico($consolaElegida)
    {
        $sentencia = $this->db->prepare('SELECT * FROM juegos WHERE ID_consola = ?  ');
        $sentencia->execute([$consolaElegida]);

        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }



}

?>