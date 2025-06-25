<?php
namespace App\Controllers;
use App\Models\ProgramaFormacionModel;

use App\Models\RolModel;         // Importar la clase RolModel para el card icon user cerrar sesion
use App\Models\UsuarioModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/ProgramaFormacionModel.php";
require_once MAIN_APP_ROUTE . "../models/RolModel.php";
require_once MAIN_APP_ROUTE . "../models/UsuarioModel.php";

class ProgramaFormacionController extends BaseController {
    
    public function __construct() {            // Para que nos cargue y nos renderize es con esta funcion.
        # Se define la plantilla para este controlador
        $this->layout = "admin_layout";
        // Llamamos al constructor del padre
        parent::__construct();
    }

    public function index() {
        echo "<br>CONTROLLER> ProgramaFormacionController";
        echo "<br>ACTION> index";
        $this->redirectTo("programaFormacion/view");
    }

    public function view() {

        // Llamamos al modelo de ProgramaFormacion
        $programaObj = new ProgramaFormacionModel();
        $programas = $programaObj->getAll();

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
            "title" => "Programas de Formación",
            "programas" => $programas,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('programaFormacion/viewProgramaFormacion.php', $data);
    }

    public function newProgramaFormacion() {
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
            "title" => "Programas de Formación",
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('programaFormacion/newProgramaFormacion.php', $data);     // Renderiza o muestra el formulario
    }

    public function createProgramaFormacion() {
        if (isset($_POST['txtNombre'])) {
            $nombre = $_POST['txtNombre'] ?? null;
            
            // Creamos instancia del Modelo ProgramaFormacion
            $programaObj = new ProgramaFormacionModel();
            
            // Se llama al método que guarda en la base de datos
            $programaObj->saveProgramaFormacion($nombre);
            $this->redirectTo("programaFormacion/view");
        } else {
            echo "No se capturó el nombre del programa de formación";
        }
    }

    public function viewProgramaFormacion($id) {
        $programaObj = new ProgramaFormacionModel();
        $programaInfo = $programaObj->getProgramaFormacion($id);

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
            "title" => "Programas de Formación",
            'programa' => $programaInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('programaFormacion/viewOneProgramaFormacion.php', $data);    // Llamamos a la vista, renderizamos la vista y enviamos los datos. 
    }

    public function editProgramaFormacion($id) {
        $programaObj = new ProgramaFormacionModel();
        $programaInfo = $programaObj->getProgramaFormacion($id);

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
            "title" => "Programas de Formación",
            "programa" => $programaInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('programaFormacion/editProgramaFormacion.php', $data);
    }

    public function updateProgramaFormacion() {
        if (isset($_POST['txtId']) && isset($_POST['txtNombre'])) {
            $id = $_POST['txtId'] ?? null;
            $nombre = $_POST['txtNombre'] ?? null;
            
            $programaObj = new ProgramaFormacionModel();
            $respuesta = $programaObj->editProgramaFormacion($id, $nombre);
        }
        header("location: /programaFormacion/view");
    }

    public function deleteProgramaFormacion($id) {
        $programaFormacionObj = new ProgramaFormacionModel();
        $programaFormacion = $programaFormacionObj->getProgramaFormacion($id);

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
            "title" => "Eliminar Programa de Formación",
            "programaFormacion" => $programaFormacion,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('programaFormacion/deleteProgramaFormacion.php', $data);
    }

    public function removeProgramaFormacion()
    {
        if (isset($_POST['txtId'])) {   
            $id = $_POST['txtId'] ?? null;
            $programaFormacionObj = new ProgramaFormacionModel();
            $programaFormacionObj->removeProgramaFormacion($id);
            $this->redirectTo("programaFormacion/view");
        }
    }
}