<?php
require_once './config.php';
class UserModel extends model{

    public function getUserByEmail($email) {    
        $query = $this->db->prepare("SELECT * FROM usuario WHERE email = ?");
        $query->execute([$email]);
    
        $user = $query->fetch(PDO::FETCH_OBJ);
    
        return $user;
    }
}
