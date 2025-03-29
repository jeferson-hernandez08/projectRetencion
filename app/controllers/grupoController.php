<?php
namespace App\Controllers;
use App\Models\GrupoModel;
use App\Models\ProgramaFormacionModel;     // Importar la clase ProgramaFormacionModel

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/GrupoModel.php";
require_once MAIN_APP_ROUTE."../models/ProgramaFormacionModel.php";

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
        
        // Llamamos a la vista
        $data = [
            "title"     => "Grupos",
            "grupos"    => $grupos
        ];
        $this->render('grupo/viewGrupo.php', $data);
    }

    public function newGrupo() {
        // Lógica para capturar programas de formación
        $programaObj = new ProgramaFormacionModel();
        $programas = $programaObj->getAll();
        
        // Llamamos a la vista
        $data = [
            "title"         => "Grupos",
            "programas"     => $programas
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
        $data = [
            "title"     => "Grupos",
            'grupo'     => $grupoInfo
        ];
        $this->render('grupo/viewOneGrupo.php', $data);
    }

    public function editGrupo($id) {
        $grupoObj = new GrupoModel();
        $grupoInfo = $grupoObj->getGrupo($id);
        $programaObj = new ProgramaFormacionModel();
        $programasInfo = $programaObj->getAll();
        $data = [
            "title"     => "Grupos",
            "grupo"     => $grupoInfo,
            "programas" => $programasInfo
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
        $grupoObj->deleteGrupo($id);
        $this->redirectTo("grupo/view");
    }
}