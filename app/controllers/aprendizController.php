<?php
namespace App\Controllers;
use App\Models\AprendizModel;
use App\Models\GrupoModel;        // Importar la clase GrupoModel

use App\Models\RolModel;         // Importar la clase RolModel para el card icon user cerrar sesion
use App\Models\UsuarioModel;
use App\Models\ImportacionModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/AprendizModel.php";
require_once MAIN_APP_ROUTE."../models/GrupoModel.php";
require_once MAIN_APP_ROUTE . "../models/RolModel.php";
require_once MAIN_APP_ROUTE . "../models/UsuarioModel.php";
require_once MAIN_APP_ROUTE . "../models/ImportacionModel.php";

class AprendizController extends BaseController {
    
    public function __construct() {            // Para que nos cargue y nos renderize es con esta funcion.
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
        $aprendices = $aprendizObj->getAllWithGrupo();   // Llamamos funcion para capturar grupo

        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuario->{"fkIdRols"});
            $rolNombre = $rol->nombre ?? "Usuario";
        }
        
        // Llamamos a la vista
        $data = [
            "title"     => 'Aprendices',
            "aprendices" => $aprendices,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('aprendiz/viewAprendiz.php', $data);
    }

    public function newAprendiz() {
        // Lógica para capturar grupos
        $grupoObj = new GrupoModel();
        $grupos = $grupoObj->getAll();

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
            "title" => "Aprendices",
            "grupos" => $grupos,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('aprendiz/newAprendiz.php', $data);
    }

    public function createAprendiz() {
        if (isset($_POST['txtTipoDocumento']) && isset($_POST['txtDocumento']) && isset($_POST['txtNombres']) && 
            isset($_POST['txtApellidos']) && isset($_POST['txtTelefono']) && isset($_POST['txtEmail']) && 
            isset($_POST['txtEstado']) && isset($_POST['txtTrimestre']) && isset($_POST['txtFkIdGrupo'])) {
            
            $tipoDocumento = $_POST['txtTipoDocumento'] ?? null;
            $documento = $_POST['txtDocumento'] ?? null;
            $nombres = $_POST['txtNombres'] ?? null;
            $apellidos = $_POST['txtApellidos'] ?? null;
            $telefono = $_POST['txtTelefono'] ?? null;
            $email = $_POST['txtEmail'] ?? null;
            $estado = $_POST['txtEstado'] ?? null;
            $trimestre = $_POST['txtTrimestre'] ?? null;
            $fkIdGrupo = $_POST['txtFkIdGrupo'] ?? null;

            // Creamos instancia del Modelo Aprendiz
            $aprendizObj = new AprendizModel();
            
            // Se llama al método que guarda en la base de datos
            $aprendizObj->saveAprendiz($tipoDocumento, $documento, $nombres, $apellidos, $telefono, $email, $estado, $trimestre, $fkIdGrupo);
            $this->redirectTo("aprendiz/view");
        } else {
            echo "No se capturaron todos los datos del aprendiz";
        }
    }

    public function viewAprendiz($id) {
        $aprendizObj = new AprendizModel();
        $aprendizInfo = $aprendizObj->getAprendiz($id);

        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuario->{"fkIdRols"});
            $rolNombre = $rol->nombre ?? "Usuario";
        }

        $data = [
            "title" => "Aprendices",
            'aprendiz' => $aprendizInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('aprendiz/viewOneAprendiz.php', $data);
    }

    public function editAprendiz($id) {
        $aprendizObj = new AprendizModel();
        $aprendizInfo = $aprendizObj->getAprendiz($id);
        $grupoObj = new GrupoModel();
        $gruposInfo = $grupoObj->getAll();

        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuario->{"fkIdRol"});
            $rolNombre = $rol->nombre ?? "Usuario";
        }

        $data = [
            "title" => "Aprendices",
            "aprendiz" => $aprendizInfo,
            "grupos" => $gruposInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('aprendiz/editAprendiz.php', $data);
    }

    public function updateAprendiz() {
        if (isset($_POST['txtId']) && isset($_POST['txtTipoDocumento']) && isset($_POST['txtDocumento']) && 
            isset($_POST['txtNombres']) && isset($_POST['txtApellidos']) && isset($_POST['txtTelefono']) && 
            isset($_POST['txtEmail']) && isset($_POST['txtEstado']) && isset($_POST['txtTrimestre']) && 
            isset($_POST['txtFkIdGrupo'])) {
            
            $id = $_POST['txtId'] ?? null;
            $tipoDocumento = $_POST['txtTipoDocumento'] ?? null;
            $documento = $_POST['txtDocumento'] ?? null;
            $nombres = $_POST['txtNombres'] ?? null;
            $apellidos = $_POST['txtApellidos'] ?? null;
            $telefono = $_POST['txtTelefono'] ?? null;
            $email = $_POST['txtEmail'] ?? null;
            $estado = $_POST['txtEstado'] ?? null;
            $trimestre = $_POST['txtTrimestre'] ?? null;
            $fkIdGrupo = $_POST['txtFkIdGrupo'] ?? null;

            $aprendizObj = new AprendizModel();
            $respuesta = $aprendizObj->editAprendiz($id, $tipoDocumento, $documento, $nombres, $apellidos, $telefono, $email, $estado, $trimestre, $fkIdGrupo);
        }
        header("location: /aprendiz/view");
    }

    public function deleteAprendiz($id) {
        $aprendizObj = new AprendizModel();
        $aprendiz = $aprendizObj->getAprendiz($id);

        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuario->{"fkIdRol"});
            $rolNombre = $rol->nombre ?? "Usuario";
        }

        $data = [
            "title" => "Eliminar Aprendiz",
            "aprendiz" => $aprendiz,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user viewAprendiz
            "rolUsuario" => $rolNombre
        ];
        $this->render('aprendiz/deleteAprendiz.php', $data);
    }

    public function removeAprendiz()
    {
        if (isset($_POST['txtId'])) {   
            $id = $_POST['txtId'] ?? null;
            $aprendizObj = new AprendizModel();
            $aprendizObj->removeAprendiz($id);
            $this->redirectTo("aprendiz/view");
        }
    }

    // Funcion para importar excel aprendiz
    public function importarExcel() {
        // Agregar logging para debug
        error_log("=== INICIANDO IMPORTACIÓN EXCEL APRENDIZ ===");
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
            $resultado = $importacionModel->procesarExcelAprendiz($_FILES['archivo_excel']);
            
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
        
        error_log("=== FINALIZANDO IMPORTACIÓN EXCEL APRENDIZ ===");
    }

    
    
}