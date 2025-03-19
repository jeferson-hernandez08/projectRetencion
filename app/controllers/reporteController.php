<?php
namespace App\Controllers;
use App\Models\ReporteModel;
// use App\Models\AprendizModel; // Importar la clase AprendizModel
// use App\Models\GestorModel;   // Importar la clase GestorModel

require_once 'baseController.php';
require_once MAIN_APP_ROUTE . "../models/ReporteModel.php";
// require_once MAIN_APP_ROUTE . "../models/AprendizModel.php";
// require_once MAIN_APP_ROUTE . "../models/GestorModel.php";

class ReporteController extends BaseController {

    public function __construct() {
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

        // Llamamos a la vista
        $data = [
            "title"    => "Reportes", // Título de la página
            "reportes" => $reportes  // Lista de reportes
        ];
        $this->render('reporte/viewReporte.php', $data); // Renderiza la vista con los datos
    }

    public function newReporte() {

        // Lógica para capturar aprendices y gestores
        // $aprendizObj = new AprendizModel();
        // $aprendices = $aprendizObj->getAll();

        // $gestorObj = new GestorModel();
        // $gestores = $gestorObj->getAll();

        // Llamamos a la vista
        $data = [
            "title"     => "Nuevo Reporte",
            // "aprendices" => $aprendices, // Lista de aprendices
            // "gestores"   => $gestores    // Lista de gestores
        ];
        $this->render('reporte/newReporte.php', $data); // Renderiza la vista con los datos
    }

    public function createReporte() {
        if (isset($_POST['txtFechaCreacion']) && isset($_POST['txtTipoReporte']) && isset($_POST['txtDescripcion']) && 
            isset($_POST['txtConclusiones']) && isset($_POST['txtFkIdAprendiz']) && isset($_POST['txtFkIdGestor'])) {
            
            $fechaCreacion = $_POST['txtFechaCreacion'] ?? null;
            $tipoReporte   = $_POST['txtTipoReporte'] ?? null;
            $descripcion   = $_POST['txtDescripcion'] ?? null;
            $conclusiones  = $_POST['txtConclusiones'] ?? null;
            $fkIdAprendiz  = $_POST['txtFkIdAprendiz'] ?? null;
            $fkIdGestor    = $_POST['txtFkIdGestor'] ?? null;

            // Creamos instancia del Modelo Reporte
            $reporteObj = new ReporteModel();
            // Se llama al método que guarda en la base de datos
            $reporteObj->saveReporte($fechaCreacion, $tipoReporte, $descripcion, $conclusiones, $fkIdAprendiz, $fkIdGestor);
            $this->redirectTo("reporte/view");
        } else {
            echo "No se capturaron todos los datos del formulario.";
        }
    }

    public function viewReporte($idReporte) {
        $reporteObj = new ReporteModel();
        $reporteInfo = $reporteObj->getReporte($idReporte);

        $data = [
            "title"   => "Detalles del Reporte",
            "reporte" => $reporteInfo // Información del reporte
        ];
        $this->render('reporte/viewOneReporte.php', $data); // Renderiza la vista con los datos
    }

    public function editReporte($idReporte) {
        $reporteObj = new ReporteModel();
        $reporteInfo = $reporteObj->getReporte($idReporte);

        // Lógica para capturar aprendices y gestores
        // $aprendizObj = new AprendizModel();
        // $aprendices = $aprendizObj->getAll();

        // $gestorObj = new GestorModel();
        // $gestores = $gestorObj->getAll();

        $data = [
            "title"      => "Editar Reporte",
            "reporte"    => $reporteInfo, // Información del reporte
            // "aprendices" => $aprendices,  // Lista de aprendices
            // "gestores"   => $gestores     // Lista de gestores
        ];
        $this->render('reporte/editReporte.php', $data); // Renderiza la vista con los datos
    }

    public function updateReporte() {
        if (isset($_POST['txtIdReporte']) && isset($_POST['txtFechaCreacion']) && isset($_POST['txtTipoReporte']) && 
            isset($_POST['txtDescripcion']) && isset($_POST['txtConclusiones']) && isset($_POST['txtFkIdAprendiz']) && 
            isset($_POST['txtFkIdGestor'])) {
            
            $idReporte     = $_POST['txtIdReporte'] ?? null;
            $fechaCreacion = $_POST['txtFechaCreacion'] ?? null;
            $tipoReporte   = $_POST['txtTipoReporte'] ?? null;
            $descripcion   = $_POST['txtDescripcion'] ?? null;
            $conclusiones  = $_POST['txtConclusiones'] ?? null;
            $fkIdAprendiz  = $_POST['txtFkIdAprendiz'] ?? null;
            $fkIdGestor    = $_POST['txtFkIdGestor'] ?? null;

            $reporteObj = new ReporteModel();
            $respuesta = $reporteObj->editReporte($idReporte, $fechaCreacion, $tipoReporte, $descripcion, $conclusiones, $fkIdAprendiz, $fkIdGestor);
        }
        header("Location: /reporte/view");
    }

    public function deleteReporte($idReporte) {
        $reporteObj = new ReporteModel();
        $reporteObj->deleteReporte($idReporte);
        $this->redirectTo("reporte/view");
    }
}