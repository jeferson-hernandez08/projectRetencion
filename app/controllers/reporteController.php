<?php
namespace App\Controllers;
use App\Models\ReporteModel;
use App\Models\UsuarioModel;        // Importar la clase UsuarioModel
use App\Models\AprendizModel;       // Importar la clase AprendizModel

use App\Models\CategoriaModel;       // Importar la clase CategoriaModel  | Capturas datos para tabla causa_reporte
use App\Models\CausaModel;           // Importar la clase CausaModel

use App\Models\RolModel;             // Importar la clase RolModel para el card icon user cerrar sesion

use App\Models\IntervencionModel;    // Importar la clase IntervencionModel para ver las intervenciones de un reporte en especifico.
// use App\Models\NotificacionModel;    // Importar la clase NotificacionModel para crear notificaciones

use App\Libraries\Mailer; // Importar la clase Mailer

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/ReporteModel.php";
require_once MAIN_APP_ROUTE."../models/UsuarioModel.php";
require_once MAIN_APP_ROUTE."../models/AprendizModel.php";

require_once MAIN_APP_ROUTE."../models/CategoriaModel.php";    // Impoprtar para relacion tabla causa_reporte
require_once MAIN_APP_ROUTE."../models/CausaModel.php";
require_once MAIN_APP_ROUTE . "../models/RolModel.php";
require_once MAIN_APP_ROUTE."../models/IntervencionModel.php";  
// require_once MAIN_APP_ROUTE."../models/NotificacionModel.php";  // Requerir el archivo del modelo Notificacion

require_once MAIN_APP_ROUTE . '../libraries/Mailer.php'; // Requerir el archivo de la clase Mailer

class ReporteController extends BaseController {
    
    public function __construct() {            // Para que nos cargue y nos renderize es con esta funcion.
        # Se define la plantilla para este controlador
        $this->layout = "admin_layout";
        // Llamamos al constructor del padre
        parent::__construct();
    }

    public function index() {
        echo "<br>CONTROLLER> ReporteController";
        echo "<br>ACTION> index";
        $this->redirectTo("reporte/view");
    }

    public function view() {
        // Llamamos al modelo de Reporte
        $reporteObj = new ReporteModel();
        $reportes = $reporteObj->getAll();

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
            "title"     => "Reportes",
            "reportes" => $reportes,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre  
        ];
        $this->render('reporte/viewReporte.php', $data);
    }

    public function newReporte() {
        // Lógica para capturar usuarios y aprendices
        //$usuarioObj = new UsuarioModel();     // Ya no necesitamos cargar los usuarios en el campo usuarios | Será en automatico
        //$usuarios = $usuarioObj->getAll();
        
        $aprendizObj = new AprendizModel();
        $aprendices = $aprendizObj->getAll();

        // Lógica para capturar categorias y causas disponibles | Para relacioanr tabla causa_reporte desde newReporte.php
        $categoriaObj = new CategoriaModel();
        $categorias = $categoriaObj->getAll();

        $causaObj = new CausaModel();
        $causas = $causaObj->getAll();
        
        // $reporteObj = new ReporteModel();
        // $reportes = $reporteObj->getAll();

        // Llamamos al modelo de CausaReporte  | Aqui el view tiene que venir en newReporte.php
        //$causaReporteObj = new CausaReporteModel();
        //$causasReportes = $causaReporteObj->getAllRelaciones();

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
            "title" => "Reportes",
            // "usuarios" => $usuarios,      // Ya no necesitamos cargar los usuarios
            "aprendices" => $aprendices,

            "categorias" => $categorias,     // Capturamos los datos de CategoriaModel y CausaModel para rendenrizar y relacionar datos en newReporte.php
            "causas" => $causas,             // QUEDE AQUI ******   

            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre

            //"causasReportes" => $causasReportes    // Capturamos los datos de CausaReporteModel para mostrar el viewCausaReporte
        ];
        $this->render('reporte/newReporte.php', $data);
    }

    public function createReporte() {
        if (isset($_POST['txtDescripcion']) && isset($_POST['txtDireccionamiento']) && 
            isset($_POST['txtFkIdAprendiz']) &&
            isset($_POST['relacionesCausaReporte'])) { 
                                                       
            // Obtener ID de usuario de la sesión para la generación de campo usaurio automatica
            $fkIdUsuario = $_SESSION['id'] ?? null;
            if (!$fkIdUsuario) {
                echo "Error: No se pudo identificar al usuario";
                return;
            }
            
            // Estado fijo como "Registrado"
            $estado = "Registrado"; 
            
            $descripcion = $_POST['txtDescripcion'] ?? null;                                  
            $direccionamiento = $_POST['txtDireccionamiento'] ?? null;
            $fkIdAprendiz = $_POST['txtFkIdAprendiz'] ?? null;

            $relacionesCausaReporte = json_decode($_POST['relacionesCausaReporte'], true); 

            // Creamos instancia del Modelo Reporte
            $reporteObj = new ReporteModel();
            
            // Se llama al método que guarda en la base de datos
            $result = $reporteObj->saveReporte($descripcion, $direccionamiento, $estado, $fkIdAprendiz, $fkIdUsuario);
            
            if ($result) {
                // Obtenemos el ID del reporte recién creado
                $idReporte = $reporteObj->getLastInsertId();     
                 // Guardar relaciones usando el método del modelo
                $relaciones = json_decode($_POST['relacionesCausaReporte'], true);
                $reporteObj->guardarRelacionesCausa($idReporte, $relaciones);

                // Obtener la descripción completa del reporte y el nombre del aprendiz
                $reporteCompleto = $reporteObj->getReporte($idReporte);
                $reporteDescripcion = $reporteCompleto->descripcion;
                $aprendizNombre = $reporteCompleto->nombreAprendiz;

                // Obtener todos los usuarios para enviarles el correo
                $usuarioModel = new UsuarioModel();
                $allUsers = $usuarioModel->getAll(); // Asumiendo que getAll() devuelve todos los usuarios con email y nombre

                // Enviar correo a todos los usuarios
                $mailer = new Mailer();
                $mailer->sendNewReportNotification($allUsers, $reporteDescripcion, $aprendizNombre);
                
                $this->redirectTo("reporte/view");
            } else {
                echo "Error al guardar el reporte";
            }
        } else {
            echo "No se capturaron todos los datos del reporte";
        }
    }

    public function viewReporte($id) {
        $reporteObj = new ReporteModel();
        $reporteInfo = $reporteObj->getReporte($id);

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
            "title" => "Reportes",
            'reporte' => $reporteInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('reporte/viewOneReporte.php', $data);
    }

    public function editReporte($id) {
        $reporteObj = new ReporteModel();
        $reporteInfo = $reporteObj->getReporte($id);
        
        $aprendizObj = new AprendizModel();
        $aprendicesInfo = $aprendizObj->getAll();

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
            $rol = $rolModel->getRol($usuario->fkIdRol);
            $rolNombre = $rol->nombre ?? "Usuario";
        }
        
        $data = [
            "title" => "Reportes",
            "reporte" => $reporteInfo,
            "aprendices" => $aprendicesInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre,
            "usuarioActual" => $usuarioActual   // Pasamos el usuario actual que esta en el sistema ingresado
        ];
        $this->render('reporte/editReporte.php', $data);
    }

    public function updateReporte() {
        if (isset($_POST['txtId']) && isset($_POST['txtDescripcion']) && 
            isset($_POST['txtDireccionamiento']) && isset($_POST['txtEstado']) && 
            isset($_POST['txtFkIdAprendiz'])) {    
                                                   
            $id = $_POST['txtId'] ?? null;
            $descripcion = $_POST['txtDescripcion'] ?? null;
            $direccionamiento = $_POST['txtDireccionamiento'] ?? null;
            $estado = $_POST['txtEstado'] ?? null;
            $fkIdAprendiz = $_POST['txtFkIdAprendiz'] ?? null;

            // Obtener ID de usuario de la sesión | Para la generacion de usuario por defecto sugun usuario ingresado al sistema
            $fkIdUsuario = $_SESSION['id'] ?? null;
            if (!$fkIdUsuario) {
                echo "Error: No se pudo identificar al usuario";
                return;
            }

            $reporteObj = new ReporteModel();
            $respuesta = $reporteObj->editReporte($id, $descripcion, $direccionamiento, $estado, $fkIdAprendiz, $fkIdUsuario);   
        }
        header("location: /reporte/view");
    }

    public function deleteReporte($id) {
        $reporteObj = new ReporteModel();
        $reporte = $reporteObj->getReporte($id);

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
            "title" => "Eliminar Reporte",
            "reporte" => $reporte,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('reporte/deleteReporte.php', $data);
    }

    public function removeReporte()
    {
        if (isset($_POST['txtId'])) {   
            $id = $_POST['txtId'] ?? null;
            $reporteObj = new ReporteModel();
            $reporteObj->removeReporte($id);
            $this->redirectTo("reporte/view");
        }
    }

    // Funcion para ver intervencion de dicho reporte o aprendiz
    public function intervenciones($idReporte) {
        // Obtener el reporte
        $reporteModel = new ReporteModel();
        $reporte = $reporteModel->getReporte($idReporte);
        
        // Obtener las intervenciones de este reporte
        $intervencionModel = new IntervencionModel();
        $intervenciones = $intervencionModel->getByReporteId($idReporte);

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
            "title" => "Intervenciones del Reporte",
            "reporte" => $reporte,
            "intervenciones" => $intervenciones,
            "nombreUsuario" => $nombreUsuario,
            "rolUsuario" => $rolNombre
        ];
        $this->render('reporte/viewIntervencionesReporte.php', $data);
    }

    // Funcion para cambio de estado del aprendiz en viewReporte
    public function updateEstado($id) {
        // Verificar si es petición AJAX
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            
            if (isset($data['estado'])) {
                $reporteModel = new ReporteModel();
                
                // Obtener estado actual para revertir si falla
                $reporteActual = $reporteModel->getReporte($id);
                $oldEstado = $reporteActual->estado;
                
                // Actualizar solo el estado
                $result = $reporteModel->updateEstado($id, $data['estado']);
                
                if ($result) {
                    echo json_encode(['success' => true]);
                    exit;
                } else {
                    echo json_encode(['success' => false, 'oldEstado' => $oldEstado]);
                    exit;
                }
            }
        }
        
        echo json_encode(['success' => false]);
        exit;
    }
}