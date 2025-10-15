<?php

namespace App\Controllers;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE . "../models/RolModel.php";
require_once MAIN_APP_ROUTE . "../models/UsuarioModel.php";

use App\Models\RolModel;
use App\Models\UsuarioModel;

class MainController extends BaseController {
    public function __construct() {
        $this->layout = "admin_layout";
        parent::__construct();
    }

    public function view() {
        // Obtener información del usuario y rol
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";
        
        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);

            // VERIFICAR SI EL USUARIO EXISTE ANTES DE ACCEDER A SUS PROPIEDADES
            if ($usuario !== null) {
                // Obtener nombre del rol - USANDO EL NOMBRE CORRECTO DE LA COLUMNA
                $rolModel = new RolModel();
                
                // Acceder a la propiedad usando la sintaxis correcta para PostgreSQL
                $idRol = $usuario->{"fkIdRols"};
                $rol = $rolModel->getRol($idRol);
                
                // Usar el nombre correcto de la propiedad del rol
                $rolNombre = ($rol !== null && isset($rol->name)) ? $rol->name : "Usuario";
            } else {
                // Manejar el caso cuando el usuario no existe
                error_log("Usuario con ID {$_SESSION['id']} no encontrado en la base de datos");
                $rolNombre = "Usuario";
            }
            
            // Obtener nombre del rol
            // $rolModel = new RolModel();
            // $rol = $rolModel->getRol($usuario->fkIdRol);
            // $rolNombre = $rol->nombre ?? "Usuario";
        }

        $data = [
            "title" => "Página Principal",
            "nombreUsuario" => $nombreUsuario,
            "rolUsuario" => $rolNombre
        ];
        $this->render('main/welcome.php', $data);
    }
}