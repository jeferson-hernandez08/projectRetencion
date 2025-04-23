<?php
namespace App\Controllers;
use App\Models\CategoriaModel;
use App\Models\CausaModel;        // Importar la clase CausaModel
use FFI\CType;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/CategoriaModel.php";
require_once MAIN_APP_ROUTE."../models/CausaModel.php";

class CategoriaController extends BaseController {
    
    public function __construct() {            // Para que nos cargue y nos renderize es con esta funcion.
        # Se define la plantilla para este controlador
        $this->layout = "admin_layout";
        // Llamamos al constructor del padre
        parent::__construct();
    }

    public function index() {
        echo "<br>CONTROLLER> CategoriaController";
        echo "<br>ACTION> index";
        $this->redirectTo("categoria/view");
    }

    public function view() {
        // Llamamos al modelo de Categoria
        $categoriaObj = new CategoriaModel();
        $categorias = $categoriaObj->getAll();
        
        // Llamamos a la vista
        $data = [
            "title"     => "Categorías",
            "categorias" => $categorias
        ];
        $this->render('categoria/viewCategoria.php', $data);
    }

    public function newCategoria() {
        // Lógica para capturar causas
        $causaObj = new CausaModel();
        $causas = $causaObj->getAll();
        
        // Llamamos a la vista
        $data = [
            "title" => "Categorías",
            "causas" => $causas
        ];
        $this->render('categoria/newCategoria.php', $data);
    }

    public function createCategoria() {
        if (isset($_POST['txtNombre']) && isset($_POST['txtDescripcion']) && isset($_POST['txtDireccionamiento']) && 
            isset($_POST['txtFkIdCausa'])) {
            
            $nombre = $_POST['txtNombre'] ?? null;
            $descripcion = $_POST['txtDescripcion'] ?? null;
            $direccionamiento = $_POST['txtDireccionamiento'] ?? null;
            $fkIdCausa = $_POST['txtFkIdCausa'] ?? null;

            // Creamos instancia del Modelo Categoria
            $categoriaObj = new CategoriaModel();
            
            // Se llama al método que guarda en la base de datos
            $categoriaObj->saveCategoria($nombre, $descripcion, $direccionamiento, $fkIdCausa);
            $this->redirectTo("categoria/view");
        } else {
            echo "No se capturaron todos los datos de la categoría";
        }
    }

    public function viewCategoria($id) {
        $categoriaObj = new CategoriaModel();
        $categoriaInfo = $categoriaObj->getCategoria($id);
        $data = [
            "title" => "Categorías",
            'categoria' => $categoriaInfo
        ];
        $this->render('categoria/viewOneCategoria.php', $data);
    }

    public function editCategoria($id) {
        $categoriaObj = new CategoriaModel();
        $categoriaInfo = $categoriaObj->getCategoria($id);
        $causaObj = new CausaModel();
        $causasInfo = $causaObj->getAll();
        $data = [
            "title" => "Categorías",
            "categoria" => $categoriaInfo,
            "causas" => $causasInfo
        ];
        $this->render('categoria/editCategoria.php', $data);
    }

    public function updateCategoria() {
        if (isset($_POST['txtId']) && isset($_POST['txtNombre']) && isset($_POST['txtDescripcion']) && 
            isset($_POST['txtDireccionamiento']) && isset($_POST['txtFkIdCausa'])) {
            
            $id = $_POST['txtId'] ?? null;
            $nombre = $_POST['txtNombre'] ?? null;
            $descripcion = $_POST['txtDescripcion'] ?? null;
            $direccionamiento = $_POST['txtDireccionamiento'] ?? null;
            $fkIdCausa = $_POST['txtFkIdCausa'] ?? null;

            $categoriaObj = new CategoriaModel();
            $respuesta = $categoriaObj->editCategoria($id, $nombre, $descripcion, $direccionamiento, $fkIdCausa);
        }
        header("location: /categoria/view");
    }

    public function deleteCategoria($id) {
        $categoriaObj = new CategoriaModel();
        $categoria = $categoriaObj->getCategoria($id);
        $data = [
            "title" => "Eliminar Usuario",
            "categoria" => $categoria,
        ];
        $this->render('categoria/deleteCategoria.php', $data);
    }

    public function removeCategoria()
    {
        if (isset($_POST['txtId'])) {   
            $id = $_POST['txtId'] ?? null;
            $categoriaObj = new CategoriaModel();
            $categoriaObj->removeCategoria($id);
            $this->redirectTo("categoria/view");
        }
    }
}