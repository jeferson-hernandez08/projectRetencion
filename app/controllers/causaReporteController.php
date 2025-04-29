<?php
namespace App\Controllers;
use App\Models\CausaReporteModel;
use App\Models\CausaModel;
use App\Models\ReporteModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/CausaReporteModel.php";
require_once MAIN_APP_ROUTE."../models/CausaModel.php";
require_once MAIN_APP_ROUTE."../models/ReporteModel.php";

class CausaReporteController extends BaseController {
    
    public function __construct() {
        # Se define la plantilla para este controlador
        $this->layout = "admin_layout";
        // Llamamos al constructor del padre
        parent::__construct();
    }

    public function index() {
        echo "<br>CONTROLLER> CausaReporteController";
        echo "<br>ACTION> index";
        $this->redirectTo("causaReporte/view");
    }

    public function view() {
        // Llamamos al modelo de CausaReporte
        $causaReporteObj = new CausaReporteModel();
        // Necesitamos una forma de listar todas las relaciones causa-reporte
        // Podemos usar un método personalizado o JOINs complejos
        //$causasReportes = []; // Implementar lógica para obtener todas las relaciones
        $causasReportes = $causaReporteObj->getAllRelaciones();
        
        // Llamamos a la vista
        $data = [
            "title" => "Relaciones Causa-Reporte",
            "causasReportes" => $causasReportes
        ];
        $this->render('causaReporte/viewCausaReporte.php', $data);
    }

    public function newCausaReporte() {
        // Lógica para capturar causas y reportes disponibles
        $causaObj = new CausaModel();
        $causas = $causaObj->getAll();
        
        $reporteObj = new ReporteModel();
        $reportes = $reporteObj->getAll();
        
        // Llamamos a la vista
        $data = [
            "title" => "Relaciones Causa-Reporte",
            "causas" => $causas,
            "reportes" => $reportes
        ];
        $this->render('causaReporte/newCausaReporte.php', $data);    // causaReporte/newCausaReporte.php
    }

    public function createCausaReporte() {
        if (isset($_POST['txtFkIdReporte']) && isset($_POST['txtFkIdCausa'])) {
            
            // $fkIdReporte = $_POST['txtFkIdReporte'] ?? null;
            // $fkIdCausa = $_POST['txtFkIdCausa'] ?? null;

            $fkIdReporte = (int)$_POST['txtFkIdReporte'];
            $fkIdCausa = (int)$_POST['txtFkIdCausa'];

            // Creamos instancia del Modelo CausaReporte
            $causaReporteObj = new CausaReporteModel();

            // Verificar si la relación ya existe
            if ($causaReporteObj->exists($fkIdReporte, $fkIdCausa)) {
                $_SESSION['message'] = "Esta relación ya existe";
                $_SESSION['message_type'] = "warning";
                $this->redirectTo("causaReporte/new");
                return;
            }
            
            // Se llama al método que guarda en la base de datos
            //$causaReporteObj->saveCausaReporte($fkIdReporte, $fkIdCausa);
            if ($causaReporteObj->saveCausaReporte($fkIdReporte, $fkIdCausa)) {
                $_SESSION['message'] = "Relación creada correctamente";
                $_SESSION['message_type'] = "success";
            } else {
                $_SESSION['message'] = "Error al crear la relación";
                $_SESSION['message_type'] = "danger";
            }

            $this->redirectTo("causaReporte/view");
        } else {
            $_SESSION['message'] = "Datos incompletos";
            $_SESSION['message_type'] = "danger";
            $this->redirectTo("causaReporte/new");
            //echo "No se capturaron todos los datos de la relación causa-reporte";
        }
    }

    public function viewCausaReporte($params) {      //$fkIdReporte, $fkIdCausa
        if (count($params) < 2) {
            $this->redirectTo("causaReporte/view");
            return;
        }
        
        $fkIdReporte = (int)$params[0];
        $fkIdCausa = (int)$params[1];
        
        $causaReporteObj = new CausaReporteModel();
        $causaReporteInfo = $causaReporteObj->getCausaReporte($fkIdReporte, $fkIdCausa);
        
        if (!$causaReporteInfo) {
            $_SESSION['message'] = "Relación no encontrada";
            $_SESSION['message_type'] = "warning";
            $this->redirectTo("causaReporte/view");
            return;
        }
        
        $data = [
            "title" => "Detalle Relación Causa-Reporte",
            'causaReporte' => $causaReporteInfo
        ];
        $this->render('causaReporte/viewOneCausaReporte.php', $data);

        // Codigo anterior comentado
        // $causaReporteObj = new CausaReporteModel();
        // $causaReporteInfo = $causaReporteObj->getCausaReporte($fkIdReporte, $fkIdCausa);
        // $data = [
        //     "title" => "Relación Causa-Reporte",
        //     'causaReporte' => $causaReporteInfo
        // ];
        // $this->render('causaReporte/viewOneCausaReporte.php', $data);
    }

    // public function editCausaReporte($fkIdReporte, $fkIdCausa) {
    //     $causaReporteObj = new CausaReporteModel();
    //     $causaReporteInfo = $causaReporteObj->getCausaReporte($fkIdReporte, $fkIdCausa);
        
    //     $causaObj = new CausaModel();
    //     $causasInfo = $causaObj->getAll();
        
    //     $reporteObj = new ReporteModel();
    //     $reportesInfo = $reporteObj->getAll();
        
    //     $data = [
    //         "title" => "Editar Relación Causa-Reporte",
    //         "causaReporte" => $causaReporteInfo,
    //         "causas" => $causasInfo,
    //         "reportes" => $reportesInfo
    //     ];
    //     $this->render('causaReporte/editCausaReporte.php', $data);
    // }

    // public function updateCausaReporte() {
    //     if (isset($_POST['txtOldFkIdReporte']) && isset($_POST['txtOldFkIdCausa']) && 
    //         isset($_POST['txtNewFkIdReporte']) && isset($_POST['txtNewFkIdCausa'])) {
            
    //         $oldFkIdReporte = $_POST['txtOldFkIdReporte'] ?? null;
    //         $oldFkIdCausa = $_POST['txtOldFkIdCausa'] ?? null;
    //         $newFkIdReporte = $_POST['txtNewFkIdReporte'] ?? null;
    //         $newFkIdCausa = $_POST['txtNewFkIdCausa'] ?? null;

    //         $causaReporteObj = new CausaReporteModel();
    //         $respuesta = $causaReporteObj->editCausaReporte(
    //             $oldFkIdReporte, 
    //             $oldFkIdCausa, 
    //             $newFkIdReporte, 
    //             $newFkIdCausa
    //         );
    //     }
    //     header("location: /causaReporte/view");
    // }

    public function deleteCausaReporte($fkIdReporte, $fkIdCausa) {
        // Validación básica
        if (!is_numeric($fkIdReporte) || !is_numeric($fkIdCausa)) {
            $_SESSION['message'] = "IDs no válidos";
            $_SESSION['message_type'] = "danger";
            $this->redirectTo("causaReporte/view");
            return;
        }

        // Convertir parámetros a enteros
        $fkIdReporte = (int)$fkIdReporte;
        $fkIdCausa = (int)$fkIdCausa;
        
        $causaReporteObj = new CausaReporteModel();
        $resultado = $causaReporteObj->deleteCausaReporte($fkIdReporte, $fkIdCausa);
        if ($resultado === true) {
            $_SESSION['message'] = "Relación eliminada correctamente";
            $_SESSION['message_type'] = "success";
        } else {
            error_log("Error al eliminar: Reporte $fkIdReporte, Causa $fkIdCausa");
            $_SESSION['message'] = "Error al eliminar la relación";
            $_SESSION['message_type'] = "danger";
        }
        
        $this->redirectTo("causaReporte/view");
    }

    // Método adicional para ver causas de un reporte específico
    public function viewCausasByReporte($fkIdReporte) {
        $causaReporteObj = new CausaReporteModel();
        $causas = $causaReporteObj->getCausasByReporte($fkIdReporte);
        
        $reporteObj = new ReporteModel();
        $reporte = $reporteObj->getReporte($fkIdReporte);
        
        $data = [
            "title" => "Causas del Reporte",
            "causas" => $causas,
            "reporte" => $reporte
        ];
        $this->render('causaReporte/viewCausasByReporte.php', $data);
    }
}