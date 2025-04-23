<?php
namespace App\Controllers;
use App\Models\ProgramaFormacionModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/ProgramaFormacionModel.php";

class ProgramaFormacionController extends BaseController {
    
    public function __construct() {            // Para que nos cargue y nos renderize es con esta funcion.
        # Se define la plantilla para este controlador
        $this->layout = "admin_layout";
        // Llamamos al constructor del padre
        parent::__construct();
    }

    public function index() {
        echo "<br>CONTROLLER> ProgramaFormacionController";
        echo "<br>ACTION> index";
        $this->redirectTo("programaFormacion/view");
    }

    public function view() {

        // Llamamos al modelo de ProgramaFormacion
        $programaObj = new ProgramaFormacionModel();
        $programas = $programaObj->getAll();
        
        // Llamamos a la vista
        $data = [
            "title" => "Programas de Formación",
            "programas" => $programas
        ];
        $this->render('programaFormacion/viewProgramaFormacion.php', $data);
    }

    public function newProgramaFormacion() {
        
        // Llamamos a la vista
        $data = [
            "title" => "Programas de Formación"
        ];
        $this->render('programaFormacion/newProgramaFormacion.php', $data);     // Renderiza o muestra el formulario
    }

    public function createProgramaFormacion() {
        if (isset($_POST['txtNombre'])) {
            $nombre = $_POST['txtNombre'] ?? null;
            
            // Creamos instancia del Modelo ProgramaFormacion
            $programaObj = new ProgramaFormacionModel();
            
            // Se llama al método que guarda en la base de datos
            $programaObj->saveProgramaFormacion($nombre);
            $this->redirectTo("programaFormacion/view");
        } else {
            echo "No se capturó el nombre del programa de formación";
        }
    }

    public function viewProgramaFormacion($id) {
        $programaObj = new ProgramaFormacionModel();
        $programaInfo = $programaObj->getProgramaFormacion($id);
        
        $data = [
            "title" => "Programas de Formación",
            'programa' => $programaInfo
        ];
        $this->render('programaFormacion/viewOneProgramaFormacion.php', $data);    // Llamamos a la vista, renderizamos la vista y enviamos los datos. 
    }

    public function editProgramaFormacion($id) {
        $programaObj = new ProgramaFormacionModel();
        $programaInfo = $programaObj->getProgramaFormacion($id);
        
        $data = [
            "title" => "Programas de Formación",
            "programa" => $programaInfo
        ];
        $this->render('programaFormacion/editProgramaFormacion.php', $data);
    }

    public function updateProgramaFormacion() {
        if (isset($_POST['txtId']) && isset($_POST['txtNombre'])) {
            $id = $_POST['txtId'] ?? null;
            $nombre = $_POST['txtNombre'] ?? null;
            
            $programaObj = new ProgramaFormacionModel();
            $respuesta = $programaObj->editProgramaFormacion($id, $nombre);
        }
        header("location: /programaFormacion/view");
    }

    public function deleteProgramaFormacion($id) {
        $programaFormacionObj = new ProgramaFormacionModel();
        $programaFormacion = $programaFormacionObj->getProgramaFormacion($id);
        $data = [
            "title" => "Eliminar Programa de Formación",
            "programaFormacion" => $programaFormacion,
        ];
        $this->render('programaFormacion/deleteProgramaFormacion.php', $data);
    }

    public function removeProgramaFormacion()
    {
        if (isset($_POST['txtId'])) {   
            $id = $_POST['txtId'] ?? null;
            $programaFormacionObj = new ProgramaFormacionModel();
            $programaFormacionObj->removeProgramaFormacion($id);
            $this->redirectTo("programaFormacion/view");
        }
    }
}