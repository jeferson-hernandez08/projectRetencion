<?php
namespace App\Controllers;
use App\Models\ReporteModel;
use App\Models\UsuarioModel;        // Importar la clase UsuarioModel
use App\Models\AprendizModel;       // Importar la clase AprendizModel

use App\Models\CategoriaModel;       // Importar la clase CategoriaModel  | Capturas datos para tabla causa_reporte
use App\Models\CausaModel;           // Importar la clase CausaModel

use App\Models\RolModel;             // Importar la clase RolModel para el card icon user cerrar sesion

use App\Models\IntervencionModel;    // Importar la clase IntervencionModel para ver las intervenciones de un reporte en especifico.

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/ReporteModel.php";
require_once MAIN_APP_ROUTE."../models/UsuarioModel.php";
require_once MAIN_APP_ROUTE."../models/AprendizModel.php";

require_once MAIN_APP_ROUTE."../models/CategoriaModel.php";    // Impoprtar para relacion tabla causa_reporte
require_once MAIN_APP_ROUTE."../models/CausaModel.php";
require_once MAIN_APP_ROUTE . "../models/RolModel.php";
require_once MAIN_APP_ROUTE."../models/IntervencionModel.php";  

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
            isset($_POST['relacionesCausaReporte'])) { // Capturamos el valor de la relación causa_reporte
                // SE CAMBIA ESTO                      // Se quita campo isset($_POST['txtFechaCreacion']) por que la fecha de creacion se geneara atomaticamente.
                                                       // Se quita el campo isset($_POST['txtEstado']) para generar estado en atomatico "Registrado"
                                                       // Se quita el campo isset($_POST['txtFkIdUsuario']) para generar el usuario automatico dependiendo del usuario que ingrese al sistema.
                                                       
            // Obtener ID de usuario de la sesión para la generación de campo usaurio automatica
            $fkIdUsuario = $_SESSION['id'] ?? null;
            if (!$fkIdUsuario) {
                echo "Error: No se pudo identificar al usuario";
                return;
            }
            
            // Estado fijo como "Registrado"
            $estado = "Registrado"; // <-- Valor fijo del campo registrado, usuario mayor interactividad.
            
            //$fechaCreacion = date('Y-m-d H:i:s', strtotime($_POST['txtFechaCreacion']));      // Convertir el valor recibido al formato DATETIME de MySQL (Y-m-d H:i:s) y usé strtotime() para parsear correctamente la fecha+hora  |  // Eliminado txtFechaCreacion
            $descripcion = $_POST['txtDescripcion'] ?? null;                                  // Convierte el valor recibido del formulario (datetime-local) al formato DATETIME de MySQL.
            $direccionamiento = $_POST['txtDireccionamiento'] ?? null;
            //$estado = $_POST['txtEstado'] ?? null;
            $fkIdAprendiz = $_POST['txtFkIdAprendiz'] ?? null;
            //$fkIdUsuario = $_POST['txtFkIdUsuario'] ?? null;

            // SE CAMBIA ESTO
            $relacionesCausaReporte = json_decode($_POST['relacionesCausaReporte'], true); // Decodificamos el JSON recibido del formulario

            // Creamos instancia del Modelo Reporte
            $reporteObj = new ReporteModel();
            
            // Se llama al método que guarda en la base de datos | Sin $fechaCreacion,
            $result = $reporteObj->saveReporte($descripcion, $direccionamiento, $estado, $fkIdAprendiz, $fkIdUsuario);
            
            // SE CAMBIA ESTO
            if ($result) {
                // Obtenemos el ID del reporte recién creado
                $idReporte = $reporteObj->getLastInsertId();     // Método para obtener el último ID insertado en la tabla reporte  
                 // Guardar relaciones usando el método del modelo
                $relaciones = json_decode($_POST['relacionesCausaReporte'], true);
                $reporteObj->guardarRelacionesCausa($idReporte, $relaciones);
                
                $this->redirectTo("reporte/view");
            } else {
                echo "Error al guardar el reporte";
            }


            //$this->redirectTo("reporte/view");  // SE CAMBIA ESTO
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
        
        // $usuarioObj = new UsuarioModel();      // Eliminamos la carga de todos los usuarios para que no se edite el usuario si no isemore sea el rol ingresado al sistema
        // $usuariosInfo = $usuarioObj->getAll();
        
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
            //"usuarios" => $usuariosInfo,
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
            isset($_POST['txtFkIdAprendiz'])) {    // Se elimina isset($_POST['txtFechaCreacion']) por que se genera automaticamente la fecha de creación
                                                   // Se elimina isset($_POST['txtFkIdUsuario']) por que se genera el usuario de manera automatica segun rol o usuario ingresado
            $id = $_POST['txtId'] ?? null;
            //$fechaCreacion = $_POST['txtFechaCreacion'] ?? null;
            $descripcion = $_POST['txtDescripcion'] ?? null;
            $direccionamiento = $_POST['txtDireccionamiento'] ?? null;
            $estado = $_POST['txtEstado'] ?? null;
            $fkIdAprendiz = $_POST['txtFkIdAprendiz'] ?? null;
            //$fkIdUsuario = $_POST['txtFkIdUsuario'] ?? null;

            // Obtener ID de usuario de la sesión | Para la generacion de usuario por defecto sugun usuario ingresado al sistema
            $fkIdUsuario = $_SESSION['id'] ?? null;
            if (!$fkIdUsuario) {
                echo "Error: No se pudo identificar al usuario";
                return;
            }

            $reporteObj = new ReporteModel();
            $respuesta = $reporteObj->editReporte($id, $descripcion, $direccionamiento, $estado, $fkIdAprendiz, $fkIdUsuario);   // Quitamos $fechaCreacion, por generacion automatica.
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