<?php
namespace App\Controllers;
use App\Models\EstrategiasModel;
use App\Models\CategoriaModel;        // Importar la clase CategoriaModel

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/EstrategiasModel.php";
require_once MAIN_APP_ROUTE."../models/CategoriaModel.php";

class EstrategiasController extends BaseController {
    
    public function __construct() {            // Para que nos cargue y nos renderize es con esta funcion.
        # Se define la plantilla para este controlador
        $this->layout = "admin_layout";
        // Llamamos al constructor del padre
        parent::__construct();
    }

    public function index() {
        echo "<br>CONTROLLER> EstrategiasController";
        echo "<br>ACTION> index";
        $this->redirectTo("estrategias/view");
    }

    public function view() {
        // Llamamos al modelo de Estrategias
        $estrategiasObj = new EstrategiasModel();
        $estrategias = $estrategiasObj->getAll();
        
        // Llamamos a la vista
        $data = [
            "title"     => "Estrategias",
            "estrategias" => $estrategias
        ];
        $this->render('estrategias/viewEstrategias.php', $data);
    }

    public function newEstrategias() {
        // Lógica para capturar categorías
        $categoriaObj = new CategoriaModel();
        $categorias = $categoriaObj->getAll();
        
        // Llamamos a la vista
        $data = [
            "title" => "Estrategias",
            "categorias" => $categorias
        ];
        $this->render('estrategias/newEstrategias.php', $data);
    }

    public function createEstrategias() {
        if (isset($_POST['txtEstrategia']) && isset($_POST['txtFkIdCategoria'])) {
            
            $estrategia = $_POST['txtEstrategia'] ?? null;
            $fkIdCategoria = $_POST['txtFkIdCategoria'] ?? null;

            // Creamos instancia del Modelo Estrategias
            $estrategiasObj = new EstrategiasModel();
            
            // Se llama al método que guarda en la base de datos
            $estrategiasObj->saveEstrategias($estrategia, $fkIdCategoria);
            $this->redirectTo("estrategias/view");
        } else {
            echo "No se capturaron todos los datos de la estrategia";
        }
    }

    public function viewEstrategias($id) {
        $estrategiasObj = new EstrategiasModel();
        $estrategiaInfo = $estrategiasObj->getEstrategias($id);
        $data = [
            "title" => "Estrategias",
            'estrategia' => $estrategiaInfo
        ];
        $this->render('estrategias/viewOneEstrategias.php', $data);
    }

    public function editEstrategias($id) {
        $estrategiasObj = new EstrategiasModel();
        $estrategiaInfo = $estrategiasObj->getEstrategias($id);
        $categoriaObj = new CategoriaModel();
        $categoriasInfo = $categoriaObj->getAll();
        $data = [
            "title" => "Estrategias",
            "estrategia" => $estrategiaInfo,
            "categorias" => $categoriasInfo
        ];
        $this->render('estrategias/editEstrategias.php', $data);
    }

    public function updateEstrategias() {
        if (isset($_POST['txtId']) && isset($_POST['txtEstrategia']) && isset($_POST['txtFkIdCategoria'])) {
            
            $id = $_POST['txtId'] ?? null;
            $estrategia = $_POST['txtEstrategia'] ?? null;
            $fkIdCategoria = $_POST['txtFkIdCategoria'] ?? null;

            $estrategiasObj = new EstrategiasModel();
            $respuesta = $estrategiasObj->editEstrategias($id, $estrategia, $fkIdCategoria);
        }
        header("location: /estrategias/view");
    }

    public function deleteEstrategias($id) {
        $estrategiasObj = new EstrategiasModel();
        $estrategiasObj->deleteEstrategias($id);
        $this->redirectTo("estrategias/view");
    }
}