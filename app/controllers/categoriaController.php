<?php
namespace App\Controllers;
use App\Models\CategoriaModel;

use App\Models\RolModel;         // Importar la clase RolModel para el card icon user cerrar sesion
use App\Models\UsuarioModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/CategoriaModel.php";
require_once MAIN_APP_ROUTE . "../models/RolModel.php";
require_once MAIN_APP_ROUTE . "../models/UsuarioModel.php";

class CategoriaController extends BaseController {
    
    public function __construct() {
        # Se define la plantilla para este controlador
        $this->layout = "admin_layout";
        // Llamamos al constructor del padre
        parent::__construct();
    }

    public function index() {
        echo "<br>CONTROLLER> CategoriaController";
        echo "<br>ACTION> index";
        $this->redirectTo("categoria/view");
    }

    public function view() {
        // Llamamos al modelo de Categoria
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
            "title" => "Categorías",
            "categorias" => $categorias,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre

        ];
        $this->render('categoria/viewCategoria.php', $data);
    }

    public function newCategoria() {
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
            "title" => "Nueva Categoría",
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('categoria/newCategoria.php', $data);     // Renderiza o muestra el formulario
    }

    public function createCategoria() {
        if (isset($_POST['txtNombre']) && isset($_POST['txtDescripcion']) && isset($_POST['txtDireccionamiento'])) {
            $nombre = $_POST['txtNombre'] ?? null;
            $descripcion = $_POST['txtDescripcion'] ?? null;
            $direccionamiento = $_POST['txtDireccionamiento'] ?? null;
            
            // Creamos instancia del Modelo Categoria
            $categoriaObj = new CategoriaModel();
            
            // Se llama al método que guarda en la base de datos
            $categoriaObj->saveCategoria($nombre, $descripcion, $direccionamiento);
            $this->redirectTo("categoria/view");
        } else {
            echo "No se capturaron todos los datos requeridos de la categoría";
        }
    }

    public function viewCategoria($id) {
        $categoriaObj = new CategoriaModel();
        $categoriaInfo = $categoriaObj->getCategoria($id);

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
            "title" => "Detalle de la Categoría",
            'categoria' => $categoriaInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre

        ];
        $this->render('categoria/viewOneCategoria.php', $data);    // Llamamos a la vista, renderizamos la vista y enviamos los datos. 
    }

    public function editCategoria($id) {
        $categoriaObj = new CategoriaModel();
        $categoriaInfo = $categoriaObj->getCategoria($id);

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
            "title" => "Editar Categoría",
            "categoria" => $categoriaInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('categoria/editCategoria.php', $data);
    }

    public function updateCategoria() {
        if (isset($_POST['txtId']) && isset($_POST['txtNombre']) && isset($_POST['txtDescripcion']) && isset($_POST['txtDireccionamiento'])) {
            $id = $_POST['txtId'] ?? null;
            $nombre = $_POST['txtNombre'] ?? null;
            $descripcion = $_POST['txtDescripcion'] ?? null;
            $direccionamiento = $_POST['txtDireccionamiento'] ?? null;
            
            $categoriaObj = new CategoriaModel();
            $respuesta = $categoriaObj->editCategoria($id, $nombre, $descripcion, $direccionamiento);
        }
        header("location: /categoria/view");
    }

    public function deleteCategoria($id) {
        $categoriaObj = new CategoriaModel();
        $categoria = $categoriaObj->getCategoria($id);

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
            "title" => "Eliminar Categoría",
            "categoria" => $categoria,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('categoria/deleteCategoria.php', $data);
    }

    public function removeCategoria()
    {
        if (isset($_POST['txtId'])) {   
            $id = $_POST['txtId'] ?? null;
            $categoriaObj = new CategoriaModel();
            $categoriaObj->removeCategoria($id);
            $this->redirectTo("categoria/view");
        }
    }
}