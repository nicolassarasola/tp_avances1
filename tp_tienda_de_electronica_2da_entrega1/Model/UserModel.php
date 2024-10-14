<?php
class UserModel { 

    private $db;
    
    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=_tp_tienda_de_electronica;charset=utf8', 'root', '');
    }

    public function getUser($email){
        $sentencia= $this->db->prepare('SELECT * FROM usuarios WHERE email = ?');
        $sentencia->execute([$email]);  

        return $user = $sentencia->fetch(PDO::FETCH_OBJ);
    }



}