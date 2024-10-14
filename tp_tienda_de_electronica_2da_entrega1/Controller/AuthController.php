<?php
require_once './model/UserModel.php';
require_once './view/AuthView.php';

class AuthController { 

    private $view;
    private $model;


    public function __construct(){
        $this->view= new AuthView();
        $this->model= new UserModel();
    }


    public function showLogin(){
        $this->view->showLogin();
    }

    public function login(){

        if(!isset($_POST['email'])||empty($_POST['email'])){
            echo 'falta completar el email';
        }
        if(!isset($_POST['password'])||empty($_POST['password'])){
            echo 'falta completar el nombre de password';
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
    
        //verificar el usuario en la base de dato
        $userFromDB = $this->model->getUser($email);

        if($userFromDB){
            
            if($userFromDB && password_verify($password, $userFromDB->password)){

                session_start();

                $_SESSION['ID_USER']=$userFromDB->id;
                $_SESSION['email']=$userFromDB->email;
                $_SESSION['LAST_ACTIVITY'] = time();

                header('location: '.BASE_URL);
            }
            else{
                return $this->view->showError('usuario no encontrado');
            }

        }  
        else{
            return $this->view->showError('usuario no existente');
        }
    }

    public function closeSesion(){
        session_start();
        session_destroy();
        header('location: '.BASE_URL);
    }





}