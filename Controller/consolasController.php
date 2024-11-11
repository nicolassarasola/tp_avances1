<?php

require_once './Model/consolasModel.php';
require_once './View/messageView.php';
require_once './View/consolasViev.php';
class consolasController
{

    private $messageView;
    private $consolasModel;
    private $consolasView;

    public function __construct()
    {
        $this->messageView = new messageView();
        $this->consolasModel = new consolasModel();
        $this->consolasView = new consolasView();
      
    }


    public function addConsola()
    {

        $this->consolasView->showFormAddConsola();

        if (
            (!isset($_POST['nombreCategoria']) || empty($_POST['nombreCategoria']))
            || (!isset($_POST['marca']) || empty($_POST['marca']))
            || (!isset($_POST['color']) || empty($_POST['color']))
            || (!isset($_POST['generacion']) || empty($_POST['generacion']))
        ) {

            $this->messageView->showMensaje('ingrese los datos correctamente');
        } else {
            $nombre = $_POST['nombreCategoria'];
            $consola = $this->consolasModel->getConsolaByName($nombre);
            if ($consola) {
                $this->messageView->ShowError('consola existente en el sistema');
            } else {
                $nombre = $_POST['nombreCategoria'];
                $marca = $_POST['marca'];
                $color = $_POST['color'];
                $generacion = $_POST['generacion'];

                $this->consolasModel->addConsola($nombre, $marca, $color, $generacion);
                $this->messageView->showMensaje('consola agregada correctamente');
            }
        }
    }
    
    public function updateConsola()
    {
        $consolas = $this->consolasModel->getConsolas();
        $this->consolasView->showUpdateConsolas($consolas);

        if (
            (!isset($_POST['nombre']) || empty($_POST['nombre']))
            || (!isset($_POST['marca']) || empty($_POST['marca']))
            || (!isset($_POST['color']) || empty($_POST['color']))
            || (!isset($_POST['generacion']) || empty($_POST['generacion']))
            || (!isset($_POST['ID']) || empty($_POST['ID']))
        ) {

            $this->messageView->showMensaje('ingrese los datos correctamente');
        } else {

            $id = $_POST['ID'];
            $nombre = $_POST['nombre'];
            $marca = $_POST['marca'];
            $color = $_POST['color'];
            $generacion = $_POST['generacion'];

            if ($id) {
                $consola = $this->consolasModel->getConsola($id);
                
                 if (empty($consola)) {
                    $this->messageView->showError('La consola asignada no existe. No se puede modificar un elemento inexistente');
                }
                else {
                    $this->consolasModel->updateConsola($nombre, $marca, $color, $generacion, $id);

                    $this->messageView->showMensaje('cambio realizado');
                }
            }
        }
    }

    public function deleteConsola($id)
    {

        $consolas = $this->consolasModel->getConsolas();
        $this->consolasView->showDeleteConsola($consolas);

        if (isset($_POST['ID']) && !empty($_POST['ID'])) {
            $id = $_POST['ID'];


        }
           
        if ($this->consolasModel->getConsola($id)) {
            $this->consolasModel->deleteConsola($id);
            return $this->messageView->showMensaje('la consola fue eliminada correctamente.');
        }else{
            return $this->messageView->showError('la consola ingresada no existe.');
        }
    }


}
