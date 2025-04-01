<?php
namespace App\Controllers;
use App\Models\ReporteModel;
use App\Models\UsuarioModel;        // Importar la clase UsuarioModel
use App\Models\AprendizModel;       // Importar la clase AprendizModel

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/ReporteModel.php";
require_once MAIN_APP_ROUTE."../models/UsuarioModel.php";
require_once MAIN_APP_ROUTE."../models/AprendizModel.php";

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
        
        // Llamamos a la vista
        $data = [
            "title"     => "Reportes",
            "reportes" => $reportes
        ];
        $this->render('reporte/viewReporte.php', $data);
    }

    public function newReporte() {
        // Lógica para capturar usuarios y aprendices
        $usuarioObj = new UsuarioModel();
        $usuarios = $usuarioObj->getAll();
        
        $aprendizObj = new AprendizModel();
        $aprendices = $aprendizObj->getAll();
        
        // Llamamos a la vista
        $data = [
            "title" => "Reportes",
            "usuarios" => $usuarios,
            "aprendices" => $aprendices
        ];
        $this->render('reporte/newReporte.php', $data);
    }

    public function createReporte() {
        if (isset($_POST['txtFechaCreacion']) && isset($_POST['txtDescripcion']) && isset($_POST['txtDireccionamiento']) && 
            isset($_POST['txtEstado']) && isset($_POST['txtFkIdAprendiz']) && isset($_POST['txtFkIdUsuario'])) {
            
            $fechaCreacion = date('Y-m-d H:i:s', strtotime($_POST['txtFechaCreacion']));      // Convertir el valor recibido al formato DATETIME de MySQL (Y-m-d H:i:s) y usé strtotime() para parsear correctamente la fecha+hora 
            $descripcion = $_POST['txtDescripcion'] ?? null;                                  // Convierte el valor recibido del formulario (datetime-local) al formato DATETIME de MySQL.
            $direccionamiento = $_POST['txtDireccionamiento'] ?? null;
            $estado = $_POST['txtEstado'] ?? null;
            $fkIdAprendiz = $_POST['txtFkIdAprendiz'] ?? null;
            $fkIdUsuario = $_POST['txtFkIdUsuario'] ?? null;

            // Creamos instancia del Modelo Reporte
            $reporteObj = new ReporteModel();
            
            // Se llama al método que guarda en la base de datos
            $reporteObj->saveReporte($fechaCreacion, $descripcion, $direccionamiento, $estado, $fkIdAprendiz, $fkIdUsuario);
            $this->redirectTo("reporte/view");
        } else {
            echo "No se capturaron todos los datos del reporte";
        }
    }

    public function viewReporte($id) {
        $reporteObj = new ReporteModel();
        $reporteInfo = $reporteObj->getReporte($id);
        $data = [
            "title" => "Reportes",
            'reporte' => $reporteInfo
        ];
        $this->render('reporte/viewOneReporte.php', $data);
    }

    public function editReporte($id) {
        $reporteObj = new ReporteModel();
        $reporteInfo = $reporteObj->getReporte($id);
        
        $usuarioObj = new UsuarioModel();
        $usuariosInfo = $usuarioObj->getAll();
        
        $aprendizObj = new AprendizModel();
        $aprendicesInfo = $aprendizObj->getAll();
        
        $data = [
            "title" => "Reportes",
            "reporte" => $reporteInfo,
            "usuarios" => $usuariosInfo,
            "aprendices" => $aprendicesInfo
        ];
        $this->render('reporte/editReporte.php', $data);
    }

    public function updateReporte() {
        if (isset($_POST['txtId']) && isset($_POST['txtFechaCreacion']) && isset($_POST['txtDescripcion']) && 
            isset($_POST['txtDireccionamiento']) && isset($_POST['txtEstado']) && isset($_POST['txtFkIdAprendiz']) && 
            isset($_POST['txtFkIdUsuario'])) {
            
            $id = $_POST['txtId'] ?? null;
            $fechaCreacion = $_POST['txtFechaCreacion'] ?? null;
            $descripcion = $_POST['txtDescripcion'] ?? null;
            $direccionamiento = $_POST['txtDireccionamiento'] ?? null;
            $estado = $_POST['txtEstado'] ?? null;
            $fkIdAprendiz = $_POST['txtFkIdAprendiz'] ?? null;
            $fkIdUsuario = $_POST['txtFkIdUsuario'] ?? null;

            $reporteObj = new ReporteModel();
            $respuesta = $reporteObj->editReporte($id, $fechaCreacion, $descripcion, $direccionamiento, $estado, $fkIdAprendiz, $fkIdUsuario);
        }
        header("location: /reporte/view");
    }

    public function deleteReporte($id) {
        $reporteObj = new ReporteModel();
        $reporteObj->deleteReporte($id);
        $this->redirectTo("reporte/view");
    }
}