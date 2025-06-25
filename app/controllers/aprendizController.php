<?php
namespace App\Controllers;
use App\Models\AprendizModel;
use App\Models\GrupoModel;        // Importar la clase GrupoModel

use App\Models\RolModel;         // Importar la clase RolModel para el card icon user cerrar sesion
use App\Models\UsuarioModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/AprendizModel.php";
require_once MAIN_APP_ROUTE."../models/GrupoModel.php";
require_once MAIN_APP_ROUTE . "../models/RolModel.php";
require_once MAIN_APP_ROUTE . "../models/UsuarioModel.php";

class AprendizController extends BaseController {
    
    public function __construct() {            // Para que nos cargue y nos renderize es con esta funcion.
        # Se define la plantilla para este controlador
        $this->layout = "admin_layout";
        // Llamamos al constructor del padre
        parent::__construct();
    }

    public function index() {
        echo "<br>CONTROLLER> AprendizController";
        echo "<br>ACTION> index";
        $this->redirectTo("aprendiz/view");
    }

    public function view() {
        // Llamamos al modelo de Aprendiz
        $aprendizObj = new AprendizModel();
        $aprendices = $aprendizObj->getAll();

        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuario->fkIdRol);
            $rolNombre = $rol->nombre ?? "Usuario";
        }
        
        // Llamamos a la vista
        $data = [
            "title"     => "Aprendices",
            "aprendices" => $aprendices,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('aprendiz/viewAprendiz.php', $data);
    }

    public function newAprendiz() {
        // Lógica para capturar grupos
        $grupoObj = new GrupoModel();
        $grupos = $grupoObj->getAll();

        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuario->fkIdRol);
            $rolNombre = $rol->nombre ?? "Usuario";
        }
        
        // Llamamos a la vista
        $data = [
            "title" => "Aprendices",
            "grupos" => $grupos,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('aprendiz/newAprendiz.php', $data);
    }

    public function createAprendiz() {
        if (isset($_POST['txtNombre']) && isset($_POST['txtEmail']) && isset($_POST['txtTelefono']) && 
            isset($_POST['txtTrimestre']) && isset($_POST['txtFkIdGrupo'])) {
            
            $nombre = $_POST['txtNombre'] ?? null;
            $email = $_POST['txtEmail'] ?? null;
            $telefono = $_POST['txtTelefono'] ?? null;
            $trimestre = $_POST['txtTrimestre'] ?? null;
            $fkIdGrupo = $_POST['txtFkIdGrupo'] ?? null;

            // Creamos instancia del Modelo Aprendiz
            $aprendizObj = new AprendizModel();
            
            // Se llama al método que guarda en la base de datos
            $aprendizObj->saveAprendiz($nombre, $email, $telefono, $trimestre, $fkIdGrupo);
            $this->redirectTo("aprendiz/view");
        } else {
            echo "No se capturaron todos los datos del aprendiz";
        }
    }

    public function viewAprendiz($id) {
        $aprendizObj = new AprendizModel();
        $aprendizInfo = $aprendizObj->getAprendiz($id);

        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuario->fkIdRol);
            $rolNombre = $rol->nombre ?? "Usuario";
        }

        $data = [
            "title" => "Aprendices",
            'aprendiz' => $aprendizInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('aprendiz/viewOneAprendiz.php', $data);
    }

    public function editAprendiz($id) {
        $aprendizObj = new AprendizModel();
        $aprendizInfo = $aprendizObj->getAprendiz($id);
        $grupoObj = new GrupoModel();
        $gruposInfo = $grupoObj->getAll();

        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuario->fkIdRol);
            $rolNombre = $rol->nombre ?? "Usuario";
        }

        $data = [
            "title" => "Aprendices",
            "aprendiz" => $aprendizInfo,
            "grupos" => $gruposInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('aprendiz/editAprendiz.php', $data);
    }

    public function updateAprendiz() {
        if (isset($_POST['txtId']) && isset($_POST['txtNombre']) && isset($_POST['txtEmail']) && 
            isset($_POST['txtTelefono']) && isset($_POST['txtTrimestre']) && isset($_POST['txtFkIdGrupo'])) {
            
            $id = $_POST['txtId'] ?? null;
            $nombre = $_POST['txtNombre'] ?? null;
            $email = $_POST['txtEmail'] ?? null;
            $telefono = $_POST['txtTelefono'] ?? null;
            $trimestre = $_POST['txtTrimestre'] ?? null;
            $fkIdGrupo = $_POST['txtFkIdGrupo'] ?? null;

            $aprendizObj = new AprendizModel();
            $respuesta = $aprendizObj->editAprendiz($id, $nombre, $email, $telefono, $trimestre, $fkIdGrupo);
        }
        header("location: /aprendiz/view");
    }

    public function deleteAprendiz($id) {
        $aprendizObj = new AprendizModel();
        $aprendiz = $aprendizObj->getAprendiz($id);

        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuario->fkIdRol);
            $rolNombre = $rol->nombre ?? "Usuario";
        }

        $data = [
            "title" => "Eliminar Aprendiz",
            "aprendiz" => $aprendiz,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user viewAprendiz
            "rolUsuario" => $rolNombre
        ];
        $this->render('aprendiz/deleteAprendiz.php', $data);
    }

    public function removeAprendiz()
    {
        if (isset($_POST['txtId'])) {   
            $id = $_POST['txtId'] ?? null;
            $aprendizObj = new AprendizModel();
            $aprendizObj->removeAprendiz($id);
            $this->redirectTo("aprendiz/view");
        }
    }
}