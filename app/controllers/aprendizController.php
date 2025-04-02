<?php
namespace App\Controllers;
use App\Models\AprendizModel;
use App\Models\GrupoModel;
use App\Models\ProgramaFormacionModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/AprendizModel.php";
require_once MAIN_APP_ROUTE."../models/GrupoModel.php";
require_once MAIN_APP_ROUTE."../models/ProgramaFormacionModel.php";

class AprendizController extends BaseController {
    
    public function __construct() {
        # Se define la plantilla para este controlador
        $this->layout = "admin_layout";
        // Llamamos al constructor del padre
        parent::__construct();
    }

    public function index() {
        echo "<br>CONTROLLER> AprendizController";
        echo "<br>ACTION> index";
        $this->redirectTo("aprendiz/view");
    }

    public function view() {
        // Llamamos al modelo de Aprendiz
        $aprendizObj = new AprendizModel();
        $aprendices = $aprendizObj->getAll();
        
        // Llamamos a la vista
        $data = [
            "title"     => "Aprendices",
            "aprendices" => $aprendices
        ];
        $this->render('aprendiz/viewAprendiz.php', $data);
    }

    public function newAprendiz() {
        // Lógica para capturar grupos y programas de formación
        $grupoObj = new GrupoModel();
        $grupos = $grupoObj->getAll();
        
        $programaObj = new ProgramaFormacionModel();
        $programas = $programaObj->getAll();
        
        // Llamamos a la vista
        $data = [
            "title" => "Aprendices",
            "grupos" => $grupos,
            "programas" => $programas
        ];
        $this->render('aprendiz/newAprendiz.php', $data);
    }

    public function createAprendiz() {
        if (isset($_POST['txtNombre']) && isset($_POST['txtEmail']) && isset($_POST['txtTelefono']) && 
            isset($_POST['txtTrimestre']) && isset($_POST['txtFkIdGrupo']) && isset($_POST['txtFkIdProgramaFormacion'])) {
            
            $nombre = $_POST['txtNombre'] ?? null;
            $email = $_POST['txtEmail'] ?? null;
            $telefono = $_POST['txtTelefono'] ?? null;
            $trimestre = $_POST['txtTrimestre'] ?? null;
            $fkIdGrupo = $_POST['txtFkIdGrupo'] ?? null;
            $fkIdProgramaFormacion = $_POST['txtFkIdProgramaFormacion'] ?? null;

            // Creamos instancia del Modelo Aprendiz
            $aprendizObj = new AprendizModel();
            
            // Se llama al método que guarda en la base de datos
            $aprendizObj->saveAprendiz($nombre, $email, $telefono, $trimestre, $fkIdGrupo, $fkIdProgramaFormacion);
            $this->redirectTo("aprendiz/view");
        } else {
            echo "No se capturaron todos los datos del aprendiz";
        }
    }

    public function viewAprendiz($id) {
        $aprendizObj = new AprendizModel();
        $aprendizInfo = $aprendizObj->getAprendiz($id);
        $data = [
            "title" => "Aprendices",
            'aprendiz' => $aprendizInfo
        ];
        $this->render('aprendiz/viewOneAprendiz.php', $data);
    }

    public function editAprendiz($id) {
        $aprendizObj = new AprendizModel();
        $aprendizInfo = $aprendizObj->getAprendiz($id);
        
        $grupoObj = new GrupoModel();
        $grupos = $grupoObj->getAll();
        
        $programaObj = new ProgramaFormacionModel();
        $programas = $programaObj->getAll();
        
        $data = [
            "title" => "Aprendices",
            "aprendiz" => $aprendizInfo,
            "grupos" => $grupos,
            "programas" => $programas
        ];
        $this->render('aprendiz/editAprendiz.php', $data);
    }

    public function updateAprendiz() {
        if (isset($_POST['txtId']) && isset($_POST['txtNombre']) && isset($_POST['txtEmail']) && 
            isset($_POST['txtTelefono']) && isset($_POST['txtTrimestre']) && isset($_POST['txtFkIdGrupo']) && 
            isset($_POST['txtFkIdProgramaFormacion'])) {
            
            $id = $_POST['txtId'] ?? null;
            $nombre = $_POST['txtNombre'] ?? null;
            $email = $_POST['txtEmail'] ?? null;
            $telefono = $_POST['txtTelefono'] ?? null;
            $trimestre = $_POST['txtTrimestre'] ?? null;
            $fkIdGrupo = $_POST['txtFkIdGrupo'] ?? null;
            $fkIdProgramaFormacion = $_POST['txtFkIdProgramaFormacion'] ?? null;

            $aprendizObj = new AprendizModel();
            $respuesta = $aprendizObj->editAprendiz($id, $nombre, $email, $telefono, $trimestre, $fkIdGrupo, $fkIdProgramaFormacion);
        }
        header("location: /aprendiz/view");
    }

    public function deleteAprendiz($id) {
        $aprendizObj = new AprendizModel();
        $aprendizObj->deleteAprendiz($id);
        $this->redirectTo("aprendiz/view");
    }
}