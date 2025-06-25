<?php
namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\RolModel;        // Importar la clase RolModel | // Importar la clase RolModel para el card icon user cerrar sesion

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/UsuarioModel.php";
require_once MAIN_APP_ROUTE."../models/RolModel.php";

class UsuarioController extends BaseController {
    
    public function __construct() {            // Para que nos cargue y nos renderize es con esta funcion.
        # Se define la plantilla para este controlador
        $this->layout = "admin_layout";
        // Llamamos al constructor del padre
        parent::__construct();
    }

    public function index() {
        echo "<br>CONTROLLER> UsuarioController";
        echo "<br>ACTION> index";
        $this->redirectTo("usuario/view");
    }

    public function view() {
        // Llamamos al modelo de Usuario
        $usuarioObj = new UsuarioModel();
        $usuarios = $usuarioObj->getAll();

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
            "title"     => "Usuarios",
            "usuarios" => $usuarios,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('usuario/viewUsuario.php', $data);
    }

    public function newUsuario() {
        // Lógica para capturar roles
        $rolObj = new RolModel();
        $roles = $rolObj->getAll();

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
            "title" => "Usuarios",
            "roles" => $roles,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('usuario/newUsuario.php', $data);
    }

    public function createUsuario() {
        if (isset($_POST['txtNombre']) && isset($_POST['txtEmail']) && isset($_POST['txtPassword']) && 
            isset($_POST['txtTelefono']) && isset($_POST['txtTipoCoordinador']) && isset($_POST['txtGestor']) && 
            isset($_POST['txtFkIdRol'])) {
            
            $nombre = $_POST['txtNombre'] ?? null;
            $email = $_POST['txtEmail'] ?? null;
            $password = $_POST['txtPassword'] ?? null;
            $telefono = $_POST['txtTelefono'] ?? null;
            $tipoCoordinador = $_POST['txtTipoCoordinador'] ?? null;
            $gestor = $_POST['txtGestor'] ?? null;
            $fkIdRol = $_POST['txtFkIdRol'] ?? null;

            // Creamos instancia del Modelo Usuario
            $usuarioObj = new UsuarioModel();
            
            // Se llama al método que guarda en la base de datos
            $usuarioObj->saveUsuario($nombre, $email, $password, $telefono, $tipoCoordinador, $gestor, $fkIdRol);
            $this->redirectTo("usuario/view");
        } else {
            echo "No se capturaron todos los datos del usuario";
        }
    }

    public function viewUsuario($id) {
        $usuarioObj = new UsuarioModel();
        $usuarioInfo = $usuarioObj->getUsuario($id);

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
            "title" => "Usuarios",
            'usuario' => $usuarioInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('usuario/viewOneUsuario.php', $data);
    }

    public function editUsuario($id) {
        $usuarioObj = new UsuarioModel();
        $usuarioInfo = $usuarioObj->getUsuario($id);
        $rolObj = new RolModel();
        $rolesInfo = $rolObj->getAll();

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
            "title" => "Usuarios",
            "usuario" => $usuarioInfo,
            "roles" => $rolesInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('usuario/editUsuario.php', $data);
    }

    public function updateUsuario() {
        if (isset($_POST['txtId']) && isset($_POST['txtNombre']) && isset($_POST['txtEmail']) && 
            isset($_POST['txtPassword']) && isset($_POST['txtTelefono']) && isset($_POST['txtTipoCoordinador']) && 
            isset($_POST['txtGestor']) && isset($_POST['txtFkIdRol'])) {
            
            $id = $_POST['txtId'] ?? null;
            $nombre = $_POST['txtNombre'] ?? null;
            $email = $_POST['txtEmail'] ?? null;
            $password = $_POST['txtPassword'] ?? null;
            $telefono = $_POST['txtTelefono'] ?? null;
            $tipoCoordinador = $_POST['txtTipoCoordinador'] ?? null;
            $gestor = $_POST['txtGestor'] ?? null;
            $fkIdRol = $_POST['txtFkIdRol'] ?? null;

            $usuarioObj = new UsuarioModel();
            $respuesta = $usuarioObj->editUsuario($id, $nombre, $email, $password, $telefono, $tipoCoordinador, $gestor, $fkIdRol);
        }
        header("location: /usuario/view");
    }

    public function deleteUsuario($id) {
        $usuarioObj = new UsuarioModel();
        $usuario = $usuarioObj->getUsuario($id);

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
            "title" => "Eliminar Usuario",
            "usuario" => $usuario,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('usuario/deleteUsuario.php', $data);
    }

    public function removeUsuario()
    {
        if (isset($_POST['txtId'])) {   
            $id = $_POST['txtId'] ?? null;
            $usuarioObj = new UsuarioModel();
            $usuarioObj->removeUsuario($id);
            $this->redirectTo("usuario/view");
        }
    }
}