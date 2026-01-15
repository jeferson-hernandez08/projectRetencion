<?php
namespace App\Controllers;
use App\Models\IntervencionModel;
use App\Models\EstrategiasModel;
use App\Models\ReporteModel;
use App\Models\UsuarioModel;

use App\Models\RolModel;         // Importar la clase RolModel para el card icon user cerrar sesion

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/IntervencionModel.php";
require_once MAIN_APP_ROUTE."../models/EstrategiasModel.php";
require_once MAIN_APP_ROUTE."../models/ReporteModel.php";
require_once MAIN_APP_ROUTE."../models/UsuarioModel.php";
require_once MAIN_APP_ROUTE . "../models/RolModel.php";

class IntervencionController extends BaseController {
    
    public function __construct() {
        # Se define la plantilla para este controlador
        $this->layout = "admin_layout";
        // Llamamos al constructor del padre
        parent::__construct();
    }

    public function index() {
        echo "<br>CONTROLLER> IntervencionController";
        echo "<br>ACTION> index";
        $this->redirectTo("intervencion/view");
    }

    public function view() {
        // Llamamos al modelo de Intervencion
        $intervencionObj = new IntervencionModel();
        $intervenciones = $intervencionObj->getAll();

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
            "title" => "Intervenciones",
            "intervenciones" => $intervenciones,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('intervencion/viewIntervencion.php', $data);
    }

    public function newIntervencion() {
        // Lógica para capturar datos relacionados
        $estrategiaObj = new EstrategiasModel();
        $reporteObj = new ReporteModel();
        //$usuarioObj = new UsuarioModel();     // Ya no necesitamos cargar los usuarios para generacion de usuario automatico
        
        $estrategias = $estrategiaObj->getAll();
        $reportes = $reporteObj->getAll();
        //$usuarios = $usuarioObj->getAll();

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
            "title" => "Crear Intervención",
            "estrategias" => $estrategias,
            "reportes" => $reportes,
            //"usuarios" => $usuarios,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre,
            "reporteId" => $_GET['reporteId'] ?? null // Agregar esta línea
        ];
        $this->render('intervencion/newIntervencion.php', $data);
    }

    public function createIntervencion() {
        if (isset($_POST['txtDescripcion']) && 
            isset($_POST['txtFkIdEstrategias']) && isset($_POST['txtFkIdReporte'])) {     
                                        // Se quita campo isset($_POST['txtFechaCreacion']) por que la fecha de creacion se geneara atomaticamente.
                                        // Se quita campo usuario isset($_POST['txtFkIdUsuario']) para la generacion automatica de usuario responsable. 

            // Obtener ID de usuario de la sesión para la generacion automatica
            $fkIdUsuario = $_SESSION['id'] ?? null;
            if (!$fkIdUsuario) {
                echo "Error: No se pudo identificar al usuario";
                return;
            }
            
            //$fechaCreacion = $_POST['txtFechaCreacion'] ?? null;
            $descripcion = $_POST['txtDescripcion'] ?? null;
            $fkIdEstrategias = $_POST['txtFkIdEstrategias'] ?? null;
            $fkIdReporte = $_POST['txtFkIdReporte'] ?? null;
            //$fkIdUsuario = $_POST['txtFkIdUsuario'] ?? null;

            // Creamos instancia del Modelo Intervencion
            $intervencionObj = new IntervencionModel();
            
            // Se llama al método que guarda en la base de datos | Sin $fechaCreacion, ya que se genera automáticamente
            $intervencionObj->saveIntervencion($descripcion, $fkIdEstrategias, $fkIdReporte, $fkIdUsuario); 
            $this->redirectTo("intervencion/view");
        } else {
            echo "No se capturaron todos los datos de la intervención";
        }
    }

    public function viewIntervencion($id) {
        $intervencionObj = new IntervencionModel();
        $intervencionInfo = $intervencionObj->getIntervencion($id);

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
            "title" => "Detalle de la Intervención",
            'intervencion' => $intervencionInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('intervencion/viewOneIntervencion.php', $data);
    }

    public function editIntervencion($id) {
        $intervencionObj = new IntervencionModel();
        $intervencionInfo = $intervencionObj->getIntervencion($id);
        
        $estrategiaObj = new EstrategiasModel();
        $reporteObj = new ReporteModel();
        //$usuarioObj = new UsuarioModel();     // Eliminamos la carga de todos los usuarios para que no se edite el usuario si no isemore sea el rol ingresado al sistema
        
        $estrategias = $estrategiaObj->getAll();
        $reportes = $reporteObj->getAll();
        //$usuarios = $usuarioObj->getAll();

        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        // Obtener la información del usuario actual que esta en sistema
        $usuarioActual = null; // Inicializamos usuario actual ingresado al sistema

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            $usuarioActual = $usuarioModel->getUsuario($_SESSION['id']); // Capturamos usuario actual aquí
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuario->{"fkIdRols"});
            $rolNombre = $rol->nombre ?? "Usuario";
        }
        
        $data = [
            "title" => "Editar Intervención",
            "intervencion" => $intervencionInfo,
            "estrategias" => $estrategias,
            "reportes" => $reportes,
            //"usuarios" => $usuarios,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre,
            "usuarioActual" => $usuarioActual   // Pasamos el usuario actual que esta en el sistema ingresado
        ];
        $this->render('intervencion/editIntervencion.php', $data);
    }

    public function updateIntervencion() {
        if (isset($_POST['txtId']) && 
            isset($_POST['txtDescripcion']) && isset($_POST['txtFkIdEstrategias']) && 
            isset($_POST['txtFkIdReporte']) && isset($_POST['txtFkIdUsuario'])) {  // Se elimina isset($_POST['txtFechaCreacion']) por que se genera automaticamente la fecha de creación
            
            $id = $_POST['txtId'] ?? null;
            //$fechaCreacion = $_POST['txtFechaCreacion'] ?? null;
            $descripcion = $_POST['txtDescripcion'] ?? null;
            $fkIdEstrategias = $_POST['txtFkIdEstrategias'] ?? null;
            $fkIdReporte = $_POST['txtFkIdReporte'] ?? null;
            $fkIdUsuario = $_POST['txtFkIdUsuario'] ?? null;

            $intervencionObj = new IntervencionModel();
            $respuesta = $intervencionObj->editIntervencion($id, $descripcion, $fkIdEstrategias, $fkIdReporte, $fkIdUsuario);   // // Quitamos $fechaCreacion, por generacion automatica.
        }
        header("location: /intervencion/view");
    }

    public function deleteIntervencion($id) {
        $intervencionObj = new IntervencionModel();
        $intervencion = $intervencionObj->getIntervencion($id);

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
            "title" => "Eliminar Intervención",
            "intervencion" => $intervencion,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('intervencion/deleteIntervencion.php', $data);
    }

    public function removeIntervencion()
    {
        if (isset($_POST['txtId'])) {   
            $id = $_POST['txtId'] ?? null;
            $intervencionObj = new IntervencionModel();
            $intervencionObj->removeIntervencion($id);
            $this->redirectTo("intervencion/view");
        }
    }
}