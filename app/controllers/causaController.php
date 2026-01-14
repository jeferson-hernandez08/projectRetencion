<?php
namespace App\Controllers;
use App\Models\CausaModel;
use App\Models\CategoriaModel;     // Importar la clase CategoriaModel

use App\Models\RolModel;         // Importar la clase RolModel para el card icon user cerrar sesion
use App\Models\UsuarioModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/CausaModel.php";
require_once MAIN_APP_ROUTE."../models/CategoriaModel.php";
require_once MAIN_APP_ROUTE . "../models/RolModel.php";
require_once MAIN_APP_ROUTE . "../models/UsuarioModel.php";

class CausaController extends BaseController {
    
    public function __construct() {            // Para que nos cargue y nos renderize es con esta funcion.
        # Se define la plantilla para este controlador
        $this->layout = "admin_layout";
        // Llamamos al constructor del padre
        parent::__construct();
    }

    public function index() {
        echo "<br>CONTROLLER> CausaController";
        echo "<br>ACTION> index";
        $this->redirectTo("causa/view");
    }

    public function view() {
        // Llamamos al modelo de Causa
        $causaObj = new CausaModel();
        $causas = $causaObj->getAll();

        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuario->{"fkIdRols"});
            $rolNombre = $rol->nombre ?? "Usuario";
        }
        
        // Llamamos a la vista
        $data = [
            "title"     => "Causas",
            "causas"    => $causas,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('causa/viewCausa.php', $data);
    }

    public function newCausa() {
        // Lógica para capturar categorías
        $categoriaObj = new CategoriaModel();
        $categorias = $categoriaObj->getAll();

        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuario->{"fkIdRols"});
            $rolNombre = $rol->nombre ?? "Usuario";
        }
        
        // Llamamos a la vista
        $data = [
            "title"         => "Crear Causa",
            "categorias"   => $categorias,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('causa/newCausa.php', $data);
    }

    public function createCausa() {
        if (isset($_POST['txtCausa']) && isset($_POST['txtVariables']) && isset($_POST['txtFkIdCategoria'])) {
            
            $causa = $_POST['txtCausa'] ?? null;
            $variables = $_POST['txtVariables'] ?? null;
            $fkIdCategoria = $_POST['txtFkIdCategoria'] ?? null;

            // Creamos instancia del Modelo Causa
            $causaObj = new CausaModel();
            
            // Se llama al método que guarda en la base de datos
            $causaObj->saveCausa($causa, $variables, $fkIdCategoria);
            $this->redirectTo("causa/view");
        } else {
            echo "No se capturaron todos los datos de la causa";
        }
    }

    public function viewCausa($id) {
        $causaObj = new CausaModel();
        $causaInfo = $causaObj->getCausa($id);

        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuario->{"fkIdRols"});
            $rolNombre = $rol->nombre ?? "Usuario";
        }
        
        $data = [
            "title"     => "Detalle de la Causa",
            'causa'     => $causaInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('causa/viewOneCausa.php', $data);
    }

    public function editCausa($id) {
        $causaObj = new CausaModel();
        $causaInfo = $causaObj->getCausa($id);
        $categoriaObj = new CategoriaModel();
        $categorias = $categoriaObj->getAll();

        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuario->{"fkIdRols"});
            $rolNombre = $rol->nombre ?? "Usuario";
        }
        
        $data = [
            "title"       => "Editar Causa",
            "causa"      => $causaInfo,
            "categorias" => $categorias,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('causa/editCausa.php', $data);
    }

    public function updateCausa() {
        if (isset($_POST['txtId']) && isset($_POST['txtCausa']) && isset($_POST['txtVariables']) && isset($_POST['txtFkIdCategoria'])) {
            
            $id = $_POST['txtId'] ?? null;
            $causa = $_POST['txtCausa'] ?? null;
            $variables = $_POST['txtVariables'] ?? null;
            $fkIdCategoria = $_POST['txtFkIdCategoria'] ?? null;

            $causaObj = new CausaModel();
            $respuesta = $causaObj->editCausa($id, $causa, $variables, $fkIdCategoria);
        }
        header("location: /causa/view");
    }

    public function deleteCausa($id) {
        $causaObj = new CausaModel();
        $causa = $causaObj->getCausa($id);

        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuario->{"fkIdRols"});
            $rolNombre = $rol->nombre ?? "Usuario";
        }
        
        $data = [
            "title" => "Eliminar Causa",
            "causa" => $causa,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('causa/deleteCausa.php', $data);
    }

    public function removeCausa() {
        if (isset($_POST['txtId'])) {   
            $id = $_POST['txtId'] ?? null;
            $causaObj = new CausaModel();
            $causaObj->removeCausa($id);
            $this->redirectTo("causa/view");
        }
    }
}