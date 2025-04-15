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
        $causasReportes = []; // Implementar lógica para obtener todas las relaciones
        
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
        $this->render('causaReporte/newCausaReporte.php', $data);
    }

    public function createCausaReporte() {
        if (isset($_POST['txtFkIdReporte']) && isset($_POST['txtFkIdCausa'])) {
            
            $fkIdReporte = $_POST['txtFkIdReporte'] ?? null;
            $fkIdCausa = $_POST['txtFkIdCausa'] ?? null;

            // Creamos instancia del Modelo CausaReporte
            $causaReporteObj = new CausaReporteModel();
            
            // Se llama al método que guarda en la base de datos
            $causaReporteObj->saveCausaReporte($fkIdReporte, $fkIdCausa);
            $this->redirectTo("causaReporte/view");
        } else {
            echo "No se capturaron todos los datos de la relación causa-reporte";
        }
    }

    public function viewCausaReporte($fkIdReporte, $fkIdCausa) {
        $causaReporteObj = new CausaReporteModel();
        $causaReporteInfo = $causaReporteObj->getCausaReporte($fkIdReporte, $fkIdCausa);
        $data = [
            "title" => "Relación Causa-Reporte",
            'causaReporte' => $causaReporteInfo
        ];
        $this->render('causaReporte/viewOneCausaReporte.php', $data);
    }

    public function editCausaReporte($fkIdReporte, $fkIdCausa) {
        $causaReporteObj = new CausaReporteModel();
        $causaReporteInfo = $causaReporteObj->getCausaReporte($fkIdReporte, $fkIdCausa);
        
        $causaObj = new CausaModel();
        $causasInfo = $causaObj->getAll();
        
        $reporteObj = new ReporteModel();
        $reportesInfo = $reporteObj->getAll();
        
        $data = [
            "title" => "Editar Relación Causa-Reporte",
            "causaReporte" => $causaReporteInfo,
            "causas" => $causasInfo,
            "reportes" => $reportesInfo
        ];
        $this->render('causaReporte/editCausaReporte.php', $data);
    }

    public function updateCausaReporte() {
        if (isset($_POST['txtOldFkIdReporte']) && isset($_POST['txtOldFkIdCausa']) && 
            isset($_POST['txtNewFkIdReporte']) && isset($_POST['txtNewFkIdCausa'])) {
            
            $oldFkIdReporte = $_POST['txtOldFkIdReporte'] ?? null;
            $oldFkIdCausa = $_POST['txtOldFkIdCausa'] ?? null;
            $newFkIdReporte = $_POST['txtNewFkIdReporte'] ?? null;
            $newFkIdCausa = $_POST['txtNewFkIdCausa'] ?? null;

            $causaReporteObj = new CausaReporteModel();
            $respuesta = $causaReporteObj->editCausaReporte(
                $oldFkIdReporte, 
                $oldFkIdCausa, 
                $newFkIdReporte, 
                $newFkIdCausa
            );
        }
        header("location: /causaReporte/view");
    }

    public function deleteCausaReporte($fkIdReporte, $fkIdCausa) {
        $causaReporteObj = new CausaReporteModel();
        $causaReporteObj->deleteCausaReporte($fkIdReporte, $fkIdCausa);
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