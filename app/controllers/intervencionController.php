<?php
namespace App\Controllers;
use App\Models\IntervencionModel;
use App\Models\EstrategiasModel;
use App\Models\ReporteModel;
use App\Models\UsuarioModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/IntervencionModel.php";
require_once MAIN_APP_ROUTE."../models/EstrategiasModel.php";
require_once MAIN_APP_ROUTE."../models/ReporteModel.php";
require_once MAIN_APP_ROUTE."../models/UsuarioModel.php";

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
        
        // Llamamos a la vista
        $data = [
            "title" => "Intervenciones",
            "intervenciones" => $intervenciones
        ];
        $this->render('intervencion/viewIntervencion.php', $data);
    }

    public function newIntervencion() {
        // Lógica para capturar datos relacionados
        $estrategiaObj = new EstrategiasModel();
        $reporteObj = new ReporteModel();
        $usuarioObj = new UsuarioModel();
        
        $estrategias = $estrategiaObj->getAll();
        $reportes = $reporteObj->getAll();
        $usuarios = $usuarioObj->getAll();
        
        // Llamamos a la vista
        $data = [
            "title" => "Intervenciones",
            "estrategias" => $estrategias,
            "reportes" => $reportes,
            "usuarios" => $usuarios
        ];
        $this->render('intervencion/newIntervencion.php', $data);
    }

    public function createIntervencion() {
        if (isset($_POST['txtDescripcion']) && 
            isset($_POST['txtFkIdEstrategias']) && isset($_POST['txtFkIdReporte']) && 
            isset($_POST['txtFkIdUsuario'])) {     // Se quita campo isset($_POST['txtFechaCreacion']) por que la fecha de creacion se geneara atomaticamente.
            
            //$fechaCreacion = $_POST['txtFechaCreacion'] ?? null;
            $descripcion = $_POST['txtDescripcion'] ?? null;
            $fkIdEstrategias = $_POST['txtFkIdEstrategias'] ?? null;
            $fkIdReporte = $_POST['txtFkIdReporte'] ?? null;
            $fkIdUsuario = $_POST['txtFkIdUsuario'] ?? null;

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
        $data = [
            "title" => "Intervenciones",
            'intervencion' => $intervencionInfo
        ];
        $this->render('intervencion/viewOneIntervencion.php', $data);
    }

    public function editIntervencion($id) {
        $intervencionObj = new IntervencionModel();
        $intervencionInfo = $intervencionObj->getIntervencion($id);
        
        $estrategiaObj = new EstrategiasModel();
        $reporteObj = new ReporteModel();
        $usuarioObj = new UsuarioModel();
        
        $estrategias = $estrategiaObj->getAll();
        $reportes = $reporteObj->getAll();
        $usuarios = $usuarioObj->getAll();
        
        $data = [
            "title" => "Intervenciones",
            "intervencion" => $intervencionInfo,
            "estrategias" => $estrategias,
            "reportes" => $reportes,
            "usuarios" => $usuarios
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
        $data = [
            "title" => "Eliminar Intervencion",
            "intervencion" => $intervencion,
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