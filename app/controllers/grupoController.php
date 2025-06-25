<?php
namespace App\Controllers;
use App\Models\GrupoModel;
use App\Models\ProgramaFormacionModel;     // Importar la clase ProgramaFormacionModel

use App\Models\RolModel;         // Importar la clase RolModel para el card icon user cerrar sesion
use App\Models\UsuarioModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/GrupoModel.php";
require_once MAIN_APP_ROUTE."../models/ProgramaFormacionModel.php";
require_once MAIN_APP_ROUTE . "../models/RolModel.php";
require_once MAIN_APP_ROUTE . "../models/UsuarioModel.php";

class GrupoController extends BaseController {
    
    public function __construct() {            // Para que nos cargue y nos renderize es con esta funcion.
        # Se define la plantilla para este controlador
        $this->layout = "admin_layout";
        // Llamamos al constructor del padre
        parent::__construct();
    }

    public function index() {
        echo "<br>CONTROLLER> GrupoController";
        echo "<br>ACTION> index";
        $this->redirectTo("grupo/view");
    }

    public function view() {
        // Llamamos al modelo de Grupo
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
            "title"     => "Grupos",
            "grupos"    => $grupos,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('grupo/viewGrupo.php', $data);
    }

    public function newGrupo() {
        // Lógica para capturar programas de formación
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
            "title"         => "Grupos",
            "programas"     => $programas,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario"    => $rolNombre
        ];
        $this->render('grupo/newGrupo.php', $data);
    }

    public function createGrupo() {
        if (isset($_POST['txtFicha']) && isset($_POST['txtJornada']) && isset($_POST['txtModalidad']) && 
            isset($_POST['txtFkIdProgramaFormacion'])) {
            
            $ficha = $_POST['txtFicha'] ?? null;
            $jornada = $_POST['txtJornada'] ?? null;
            $modalidad = $_POST['txtModalidad'] ?? null;
            $fkIdProgramaFormacion = $_POST['txtFkIdProgramaFormacion'] ?? null;

            // Creamos instancia del Modelo Grupo
            $grupoObj = new GrupoModel();
            
            // Se llama al método que guarda en la base de datos
            $grupoObj->saveGrupo($ficha, $jornada, $modalidad, $fkIdProgramaFormacion);
            $this->redirectTo("grupo/view");
        } else {
            echo "No se capturaron todos los datos del grupo";
        }
    }

    public function viewGrupo($id) {
        $grupoObj = new GrupoModel();
        $grupoInfo = $grupoObj->getGrupo($id);

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
            "title"     => "Grupos",
            'grupo'     => $grupoInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario"    => $rolNombre
        ];
        $this->render('grupo/viewOneGrupo.php', $data);
    }

    public function editGrupo($id) {
        $grupoObj = new GrupoModel();
        $grupoInfo = $grupoObj->getGrupo($id);
        $programaObj = new ProgramaFormacionModel();
        $programasInfo = $programaObj->getAll();

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
            "title"     => "Grupos",
            "grupo"     => $grupoInfo,
            "programas" => $programasInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario"    => $rolNombre
        ];
        $this->render('grupo/editGrupo.php', $data);
    }

    public function updateGrupo() {
        if (isset($_POST['txtId']) && isset($_POST['txtFicha']) && isset($_POST['txtJornada']) && 
            isset($_POST['txtModalidad']) && isset($_POST['txtFkIdProgramaFormacion'])) {
            
            $id = $_POST['txtId'] ?? null;
            $ficha = $_POST['txtFicha'] ?? null;
            $jornada = $_POST['txtJornada'] ?? null;
            $modalidad = $_POST['txtModalidad'] ?? null;
            $fkIdProgramaFormacion = $_POST['txtFkIdProgramaFormacion'] ?? null;

            $grupoObj = new GrupoModel();
            $respuesta = $grupoObj->editGrupo($id, $ficha, $jornada, $modalidad, $fkIdProgramaFormacion);
        }
        header("location: /grupo/view");
    }

    public function deleteGrupo($id) {
        $grupoObj = new GrupoModel();
        $grupo = $grupoObj->getGrupo($id);

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
            "title" => "Eliminar Grupo",
            "grupo" => $grupo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario"    => $rolNombre
        ];
        $this->render('grupo/deleteGrupo.php', $data);
    }

    public function removeGrupo()
    {
        if (isset($_POST['txtId'])) {   
            $id = $_POST['txtId'] ?? null;
            $grupoObj = new GrupoModel();
            $grupoObj->removeGrupo($id);
            $this->redirectTo("grupo/view");
        }
    }
}