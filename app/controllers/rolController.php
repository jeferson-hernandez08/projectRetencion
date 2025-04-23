<?php
namespace App\Controllers;
use App\Models\RolModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/RolModel.php";

class RolController extends BaseController {
    
    public function __construct() {            // Para que nos cargue y nos renderize es con esta funcion.
        # Se define la plantilla para este controlador
        $this->layout = "admin_layout";
        // Llamamos al constructor del padre
        parent::__construct();
    }

    public function index() {
        echo "<br>CONTROLLER> RolController";
        echo "<br>ACTION> index";
        $this->redirectTo("rol/view");
    }

    public function view() {

        // Llamamos al modelo de Rol
        $rolObj = new RolModel();
        $roles = $rolObj->getAll();
        
        // Llamamos a la vista
        $data = [
            "title" => "Roles",
            "roles" => $roles
        ];
        $this->render('rol/viewRol.php', $data);
    }

    public function newRol() {
        
        // Llamamos a la vista
        $data = [
            "title" => "Roles"
        ];
        $this->render('rol/newRol.php', $data);     // Renderiza o muestra el formulario
    }

    public function createRol() {
        if (isset($_POST['txtNombre'])) {
            $nombre = $_POST['txtNombre'] ?? null;
            
            // Creamos instancia del Modelo Rol
            $rolObj = new RolModel();
            
            // Se llama al método que guarda en la base de datos
            $rolObj->saveRol($nombre);
            $this->redirectTo("rol/view");
        } else {
            echo "No se capturó el nombre del rol";
        }
    }

    public function viewRol($id) {
        $rolObj = new RolModel();
        $rolInfo = $rolObj->getRol($id);
        
        $data = [
            "title" => "Roles",
            'rol' => $rolInfo
        ];
        $this->render('rol/viewOneRol.php', $data);    // Llamamos a la vista, renderizamos la vista y enviamos los datos. 
    }

    public function editRol($id) {
        $rolObj = new RolModel();
        $rolInfo = $rolObj->getRol($id);
        
        $data = [
            "title" => "Roles",
            "rol" => $rolInfo
        ];
        $this->render('rol/editRol.php', $data);
    }

    public function updateRol() {
        if (isset($_POST['txtId']) && isset($_POST['txtNombre'])) {
            $id = $_POST['txtId'] ?? null;
            $nombre = $_POST['txtNombre'] ?? null;
            
            $rolObj = new RolModel();
            $respuesta = $rolObj->editRol($id, $nombre);
        }
        header("location: /rol/view");
    }

    public function deleteRol($id) {   // Render Vista deleteRol.php
        $rolObj = new RolModel();
        $rol = $rolObj->getRol($id);
        $data = [
            "title" => "Eliminar Rol",
            "rol" => $rol,
        ];
        $this->render('rol/deleteRol.php', $data);
    }

    public function removeRol()
    {
        if (isset($_POST['txtId'])) {   
            $id = $_POST['txtId'] ?? null;
            $rolObj = new RolModel();
            $rolObj->removeRol($id);
            $this->redirectTo("rol/view");
        }
    }
}