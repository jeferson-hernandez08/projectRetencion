<?php
namespace App\Controllers;
use App\Models\CausaModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/CausaModel.php";

class CausaController extends BaseController {
    
    public function __construct() {            // Para que nos cargue y nos renderize es con esta funcion.
        # Se define la plantilla para este controlador
        $this->layout = "admin_layout";
        // Llamamos al constructor del padre
        parent::__construct();
    }

    public function index() {
        echo "<br>CONTROLLER> CausaController";
        echo "<br>ACTION> index";
        $this->redirectTo("causa/view");
    }

    public function view() {
        // Llamamos al modelo de Causa
        $causaObj = new CausaModel();
        $causas = $causaObj->getAll();
        
        // Llamamos a la vista
        $data = [
            "title"     => "Causas",
            "causas" => $causas
        ];
        $this->render('causa/viewCausa.php', $data);
    }

    public function newCausa() {
        // No se necesita modelo adicional como en el caso de Usuario-Rol
        // Llamamos directamente a la vista
        $data = [
            "title" => "Causas"
        ];
        $this->render('causa/newCausa.php', $data);
    }

    public function createCausa() {
        if (isset($_POST['txtCausa']) && isset($_POST['txtVariables'])) {
            
            $causa = $_POST['txtCausa'] ?? null;
            $variables = $_POST['txtVariables'] ?? null;

            // Creamos instancia del Modelo Causa
            $causaObj = new CausaModel();
            
            // Se llama al método que guarda en la base de datos
            $causaObj->saveCausa($causa, $variables);
            $this->redirectTo("causa/view");
        } else {
            echo "No se capturaron todos los datos de la causa";
        }
    }

    public function viewCausa($id) {
        $causaObj = new CausaModel();
        $causaInfo = $causaObj->getCausa($id);
        $data = [
            "title" => "Causas",
            'causa' => $causaInfo
        ];
        $this->render('causa/viewOneCausa.php', $data);
    }

    public function editCausa($id) {
        $causaObj = new CausaModel();
        $causaInfo = $causaObj->getCausa($id);
        $data = [
            "title" => "Causas",
            "causa" => $causaInfo
        ];
        $this->render('causa/editCausa.php', $data);
    }

    public function updateCausa() {
        if (isset($_POST['txtId']) && isset($_POST['txtCausa']) && isset($_POST['txtVariables'])) {
            
            $id = $_POST['txtId'] ?? null;
            $causa = $_POST['txtCausa'] ?? null;
            $variables = $_POST['txtVariables'] ?? null;

            $causaObj = new CausaModel();
            $respuesta = $causaObj->editCausa($id, $causa, $variables);
        }
        header("location: /causa/view");
    }

    public function deleteCausa($id) {
        $causaObj = new CausaModel();
        $causa = $causaObj->getCausa($id);
        $data = [
            "title" => "Eliminar Causa",
            "causa" => $causa,
        ];
        $this->render('causa/deleteCausa.php', $data);
    }

    public function removeCausa()
    {
        if (isset($_POST['txtId'])) {   
            $id = $_POST['txtId'] ?? null;
            $causaObj = new CausaModel();
            $causaObj->removeCausa($id);
            $this->redirectTo("causa/view");
        }
    }
}