<?php
namespace App\Controllers;
use App\Models\EstrategiasModel;
use App\Models\CategoriaModel;        // Importar la clase CategoriaModel

use App\Models\RolModel;         // Importar la clase RolModel para el card icon user cerrar sesion
use App\Models\UsuarioModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/EstrategiasModel.php";
require_once MAIN_APP_ROUTE."../models/CategoriaModel.php";
require_once MAIN_APP_ROUTE . "../models/RolModel.php";
require_once MAIN_APP_ROUTE . "../models/UsuarioModel.php";

class EstrategiasController extends BaseController {
    
    public function __construct() {            // Para que nos cargue y nos renderize es con esta funcion.
        # Se define la plantilla para este controlador
        $this->layout = "admin_layout";
        // Llamamos al constructor del padre
        parent::__construct();
    }

    public function index() {
        echo "<br>CONTROLLER> EstrategiasController";
        echo "<br>ACTION> index";
        $this->redirectTo("estrategias/view");
    }

    public function view() {
        // Llamamos al modelo de Estrategias
        $estrategiasObj = new EstrategiasModel();
        $estrategias = $estrategiasObj->getAll();

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
            "title"     => "Estrategias",
            "estrategias" => $estrategias,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre

        ];
        $this->render('estrategias/viewEstrategias.php', $data);
    }

    public function newEstrategias() {
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
            "title" => "Estrategias",
            "categorias" => $categorias,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('estrategias/newEstrategias.php', $data);
    }

    public function createEstrategias() {
        if (isset($_POST['txtEstrategia']) && isset($_POST['txtFkIdCategoria'])) {
            
            $estrategia = $_POST['txtEstrategia'] ?? null;
            $fkIdCategoria = $_POST['txtFkIdCategoria'] ?? null;

            // Creamos instancia del Modelo Estrategias
            $estrategiasObj = new EstrategiasModel();
            
            // Se llama al método que guarda en la base de datos
            $estrategiasObj->saveEstrategias($estrategia, $fkIdCategoria);
            $this->redirectTo("estrategias/view");
        } else {
            echo "No se capturaron todos los datos de la estrategia";
        }
    }

    public function viewEstrategias($id) {
        $estrategiasObj = new EstrategiasModel();
        $estrategiaInfo = $estrategiasObj->getEstrategias($id);

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
            "title" => "Estrategias",
            'estrategia' => $estrategiaInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('estrategias/viewOneEstrategias.php', $data);
    }

    public function editEstrategias($id) {
        $estrategiasObj = new EstrategiasModel();
        $estrategiaInfo = $estrategiasObj->getEstrategias($id);
        $categoriaObj = new CategoriaModel();
        $categoriasInfo = $categoriaObj->getAll();

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
            "title" => "Estrategias",
            "estrategia" => $estrategiaInfo,
            "categorias" => $categoriasInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('estrategias/editEstrategias.php', $data);
    }

    public function updateEstrategias() {
        if (isset($_POST['txtId']) && isset($_POST['txtEstrategia']) && isset($_POST['txtFkIdCategoria'])) {
            
            $id = $_POST['txtId'] ?? null;
            $estrategia = $_POST['txtEstrategia'] ?? null;
            $fkIdCategoria = $_POST['txtFkIdCategoria'] ?? null;

            $estrategiasObj = new EstrategiasModel();
            $respuesta = $estrategiasObj->editEstrategias($id, $estrategia, $fkIdCategoria);
        }
        header("location: /estrategias/view");
    }

    public function deleteEstrategias($id) {
        $estrategiasObj = new EstrategiasModel();
        $estrategias = $estrategiasObj->getEstrategias($id);

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
            "title" => "Eliminar Estrategia",
            "estrategias" => $estrategias,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('estrategias/deleteEstrategias.php', $data);
    }

    public function removeEstrategias()
    {
        if (isset($_POST['txtId'])) {   
            $id = $_POST['txtId'] ?? null;
            $estrategiaObj = new EstrategiasModel();
            $estrategiaObj->removeEstrategias($id);
            $this->redirectTo("estrategias/view");
        }
    }
}