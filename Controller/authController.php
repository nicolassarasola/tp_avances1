<?php
require_once './Model/userModel.php';
require_once './View/authView.php';

class AuthController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    public function showLogin() {
        return $this->view->showLogin();
    }

    public function login() {
        if (!isset($_POST['email']) || empty($_POST['email'])) {
            return $this->view->showLogin('Falta completar el nombre de usuario');
        }
    
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            return $this->view->showLogin('Falta completar la contraseña');
        }
    
        $email = $_POST['email'];
        $password = $_POST['password'];
    
       
        $userFromDB = $this->model->getUserByEmail($email);

        if($userFromDB && password_verify($password, $userFromDB->password)){
          
            session_start();
            $_SESSION['ID_USER'] = $userFromDB->id;
            $_SESSION['EMAIL_USER'] = $userFromDB->email;
    
            header('Location: ' . BASE_URL);
        } else {
            return $this->view->showLogin('contraseña o mail incorrectos');
        }
    }

    public function logout() {
        session_start(); 
        session_destroy(); 
        header('Location: ' . BASE_URL);
    }
}
