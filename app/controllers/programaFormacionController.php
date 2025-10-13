<?php
namespace App\Controllers;
use App\Models\ProgramaFormacionModel;

use App\Models\RolModel;         // Importar la clase RolModel para el card icon user cerrar sesion
use App\Models\UsuarioModel;
use App\Models\ImportacionModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/ProgramaFormacionModel.php";
require_once MAIN_APP_ROUTE . "../models/RolModel.php";
require_once MAIN_APP_ROUTE . "../models/UsuarioModel.php";
require_once MAIN_APP_ROUTE . "../models/ImportacionModel.php";

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

        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuario->fkIdRol);
            $rolNombre = $rol->nombre ?? "Usuario";
        }
        
        // Llamamos a la vista
        $data = [
            "title" => "Programas de Formación",
            "programas" => $programas,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('programaFormacion/viewProgramaFormacion.php', $data);
    }

    public function newProgramaFormacion() {
        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuario->fkIdRol);
            $rolNombre = $rol->nombre ?? "Usuario";
        }
        
        // Llamamos a la vista
        $data = [
            "title" => "Programas de Formación",
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('programaFormacion/newProgramaFormacion.php', $data);     // Renderiza o muestra el formulario
    }

    public function createProgramaFormacion() {
        if (isset($_POST['txtNombre'])) {
            $nombre = $_POST['txtNombre'] ?? null;
            $nivel = $_POST['txtNivel'] ?? null;
            $version = $_POST['txtVersion'] ?? null;
            
            // Creamos instancia del Modelo ProgramaFormacion
            $programaObj = new ProgramaFormacionModel();
            
            // Se llama al método que guarda en la base de datos
            $programaObj->saveProgramaFormacion($nombre, $nivel, $version);
            $this->redirectTo("programaFormacion/view");
        } else {
            echo "No se capturó el nombre del programa de formación";
        }
    }

    public function viewProgramaFormacion($id) {
        $programaObj = new ProgramaFormacionModel();
        $programaInfo = $programaObj->getProgramaFormacion($id);

        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuario->fkIdRol);
            $rolNombre = $rol->nombre ?? "Usuario";
        }
        
        $data = [
            "title" => "Programas de Formación",
            'programa' => $programaInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('programaFormacion/viewOneProgramaFormacion.php', $data);    // Llamamos a la vista, renderizamos la vista y enviamos los datos. 
    }

    public function editProgramaFormacion($id) {
        $programaObj = new ProgramaFormacionModel();
        $programaInfo = $programaObj->getProgramaFormacion($id);

        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuario->fkIdRol);
            $rolNombre = $rol->nombre ?? "Usuario";
        }
        
        $data = [
            "title" => "Programas de Formación",
            "programa" => $programaInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('programaFormacion/editProgramaFormacion.php', $data);
    }

    public function updateProgramaFormacion() {
        if (isset($_POST['txtId']) && isset($_POST['txtNombre'])) {
            $id = $_POST['txtId'] ?? null;
            $nombre = $_POST['txtNombre'] ?? null;
            $nivel = $_POST['txtNivel'] ?? null;
            $version = $_POST['txtVersion'] ?? null;
            
            $programaObj = new ProgramaFormacionModel();
            $respuesta = $programaObj->editProgramaFormacion($id, $nombre, $nivel, $version);
        }
        header("location: /programaFormacion/view");
    }

    public function deleteProgramaFormacion($id) {
        $programaFormacionObj = new ProgramaFormacionModel();
        $programaFormacion = $programaFormacionObj->getProgramaFormacion($id);

        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuario->fkIdRol);
            $rolNombre = $rol->nombre ?? "Usuario";
        }

        $data = [
            "title" => "Eliminar Programa de Formación",
            "programaFormacion" => $programaFormacion,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
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

    // Funcion para importar excel programa de formacion
    public function importarExcel() {
        // Agregar logging para debug
        error_log("=== INICIANDO IMPORTACIÓN EXCEL ===");
        error_log("Método: " . $_SERVER['REQUEST_METHOD']);
        error_log("Files: " . print_r($_FILES, true));
        
        header('Content-Type: application/json');
        
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new \Exception('Método no permitido. Se esperaba POST.');
            }
            
            if (!isset($_FILES['archivo_excel'])) {
                throw new \Exception('No se envió ningún archivo.');
            }
            
            if ($_FILES['archivo_excel']['error'] !== UPLOAD_ERR_OK) {
                $errorMessages = [
                    UPLOAD_ERR_INI_SIZE => 'El archivo excede el tamaño máximo permitido.',
                    UPLOAD_ERR_FORM_SIZE => 'El archivo excede el tamaño máximo del formulario.',
                    UPLOAD_ERR_PARTIAL => 'El archivo solo se subió parcialmente.',
                    UPLOAD_ERR_NO_FILE => 'No se subió ningún archivo.',
                    UPLOAD_ERR_NO_TMP_DIR => 'Falta la carpeta temporal.',
                    UPLOAD_ERR_CANT_WRITE => 'No se pudo escribir el archivo en el disco.',
                    UPLOAD_ERR_EXTENSION => 'Una extensión de PHP detuvo la subida del archivo.'
                ];
                $errorCode = $_FILES['archivo_excel']['error'];
                $errorMessage = $errorMessages[$errorCode] ?? 'Error desconocido en la subida del archivo. Código: ' . $errorCode;
                throw new \Exception($errorMessage);
            }
            
            // Validar tamaño del archivo (máximo 5MB)
            if ($_FILES['archivo_excel']['size'] > 5 * 1024 * 1024) {
                throw new \Exception('El archivo es demasiado grande. Tamaño máximo: 5MB');
            }
            
            // Validar extensión
            $allowedExtensions = ['xlsx', 'xls'];
            $extension = strtolower(pathinfo($_FILES['archivo_excel']['name'], PATHINFO_EXTENSION));
            if (!in_array($extension, $allowedExtensions)) {
                throw new \Exception('Formato de archivo no válido. Solo se permiten archivos Excel (.xlsx, .xls)');
            }
            
            error_log("Archivo validado, procediendo a procesar...");
            
            $importacionModel = new ImportacionModel();
            $resultado = $importacionModel->procesarExcelProgramaFormacion($_FILES['archivo_excel']);
            
            error_log("Procesamiento completado con éxito");
            
            echo json_encode([
                'success' => true,
                'procesados' => $resultado['procesados'],
                'errores' => $resultado['errores'],
                'message' => 'Importación completada exitosamente'
            ]);
            
        } catch (\Exception $e) {
            error_log("ERROR en importarExcel: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
        
        error_log("=== FINALIZANDO IMPORTACIÓN EXCEL ===");
    }

}