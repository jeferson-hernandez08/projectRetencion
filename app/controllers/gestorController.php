<?php
namespace App\Controllers;
use App\Models\GestorModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE . "../models/GestorModel.php";

class GestorController extends BaseController {

    public function __construct() {
        # Se define la plantilla para este controlador
        $this->layout = "admin_layout";
        // Llamamos al constructor del padre
        parent::__construct();
    }

    public function index() {
        echo "<br>CONTROLLER> GestorController";
        echo "<br>ACTION> index";
        $this->redirectTo("gestor/view");
    }

    public function view() {

        // Llamamos al modelo de Gestor
        $gestorObj = new GestorModel();
        $gestores = $gestorObj->getAll();

        // Llamamos a la vista
        $data = [
            "title"    => "Gestores", // Título de la página
            "gestores" => $gestores  // Lista de gestores
        ];
        $this->render('gestor/viewGestor.php', $data); // Renderiza la vista con los datos
    }

    public function newGestor() {
        
        // Llamamos a la vista
        $data = [
            "title" => "Nuevo Gestor"
        ];
        $this->render('gestor/newGestor.php', $data); // Renderiza la vista con los datos
    }

    public function createGestor() {
        if (isset($_POST['txtNombreCompleto']) && isset($_POST['txtCentroAcademico']) && isset($_POST['txtEmail']) && 
            isset($_POST['txtTelefono']) && isset($_POST['txtCompetencias'])) {
            
            $nombreCompleto = $_POST['txtNombreCompleto'] ?? null;
            $centroAcademico = $_POST['txtCentroAcademico'] ?? null;
            $email = $_POST['txtEmail'] ?? null;
            $telefono = $_POST['txtTelefono'] ?? null;
            $competencias = $_POST['txtCompetencias'] ?? null;

            // Creamos instancia del Modelo Gestor
            $gestorObj = new GestorModel();
            // Se llama al método que guarda en la base de datos
            $gestorObj->saveGestor($nombreCompleto, $centroAcademico, $email, $telefono, $competencias);
            $this->redirectTo("gestor/view");
        } else {
            echo "No se capturaron todos los datos del formulario.";
        }
    }

    public function viewGestor($idGestor) {
        $gestorObj = new GestorModel();
        $gestorInfo = $gestorObj->getGestor($idGestor);

        $data = [
            "title"   => "Detalles del Gestor",
            "gestor" => $gestorInfo // Información del gestor
        ];
        $this->render('gestor/viewOneGestor.php', $data); // Renderiza la vista con los datos
    }

    public function editGestor($idGestor) {
        $gestorObj = new GestorModel();
        $gestorInfo = $gestorObj->getGestor($idGestor);

        $data = [
            "title"      => "Editar Gestor",
            "gestor"    => $gestorInfo // Información del gestor
        ];
        $this->render('gestor/editGestor.php', $data); // Renderiza la vista con los datos
    }

    public function updateGestor() {
        if (isset($_POST['txtIdGestor']) && isset($_POST['txtNombreCompleto']) && isset($_POST['txtCentroAcademico']) && 
            isset($_POST['txtEmail']) && isset($_POST['txtTelefono']) && isset($_POST['txtCompetencias'])) {
            
            $idGestor = $_POST['txtIdGestor'] ?? null;
            $nombreCompleto = $_POST['txtNombreCompleto'] ?? null;
            $centroAcademico = $_POST['txtCentroAcademico'] ?? null;
            $email = $_POST['txtEmail'] ?? null;
            $telefono = $_POST['txtTelefono'] ?? null;
            $competencias = $_POST['txtCompetencias'] ?? null;

            $gestorObj = new GestorModel();
            $respuesta = $gestorObj->editGestor($idGestor, $nombreCompleto, $centroAcademico, $email, $telefono, $competencias);
        }
        header("Location: /gestor/view");
    }

    public function deleteGestor($idGestor) {
        $gestorObj = new GestorModel();
        $gestorObj->deleteGestor($idGestor);
        $this->redirectTo("gestor/view");
    }
}