<?php
namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\RolModel;        // Importar la clase RolModel | // Importar la clase RolModel para el card icon user cerrar sesion
use App\Models\ImportacionModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/UsuarioModel.php";
require_once MAIN_APP_ROUTE."../models/RolModel.php";
require_once MAIN_APP_ROUTE . "../models/ImportacionModel.php";

class UsuarioController extends BaseController {
    
    public function __construct() {            // Para que nos cargue y nos renderize es con esta funcion.
        # Se define la plantilla para este controlador
        $this->layout = "admin_layout";
        // Llamamos al constructor del padre
        parent::__construct();
    }

    public function index() {
        echo "<br>CONTROLLER> UsuarioController";
        echo "<br>ACTION> index";
        $this->redirectTo("usuario/view");
    }

    public function view() {
        // Llamamos al modelo de Usuario
        $usuarioObj = new UsuarioModel();
        $usuarios = $usuarioObj->getAll();

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
            "title"     => "Usuarios",
            "usuarios" => $usuarios,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('usuario/viewUsuario.php', $data);
    }

    public function newUsuario() {
        // Lógica para capturar roles
        $rolObj = new RolModel();
        $roles = $rolObj->getAll();

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
            "title" => "Usuarios",
            "roles" => $roles,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('usuario/newUsuario.php', $data);
    }

    public function createUsuario() {
        if (isset($_POST['txtNombres']) && isset($_POST['txtApellidos']) && isset($_POST['txtDocumento']) && 
            isset($_POST['txtEmail']) && isset($_POST['txtPassword']) && isset($_POST['txtTelefono']) && 
            isset($_POST['txtTipoCoordinador']) && isset($_POST['txtGestor']) && isset($_POST['txtFkIdRol'])) {
            
            $nombres = $_POST['txtNombres'] ?? null;
            $apellidos = $_POST['txtApellidos'] ?? null;
            $documento = $_POST['txtDocumento'] ?? null;
            $email = $_POST['txtEmail'] ?? null;
            $password = $_POST['txtPassword'] ?? null;
            $telefono = $_POST['txtTelefono'] ?? null;
            $tipoCoordinador = $_POST['txtTipoCoordinador'] ?? null;
            $gestor = $_POST['txtGestor'] ?? null;
            $fkIdRol = $_POST['txtFkIdRol'] ?? null;

            // Creamos instancia del Modelo Usuario
            $usuarioObj = new UsuarioModel();
            
            // Se llama al método que guarda en la base de datos
            $usuarioObj->saveUsuario($nombres, $apellidos, $documento, $email, $password, $telefono, $tipoCoordinador, $gestor, $fkIdRol);
            $this->redirectTo("usuario/view");
        } else {
            echo "No se capturaron todos los datos del usuario";
        }
    }

    public function viewUsuario($id) {
        $usuarioObj = new UsuarioModel();
        $usuarioInfo = $usuarioObj->getUsuario($id);

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
            "title" => "Usuarios",
            'usuario' => $usuarioInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('usuario/viewOneUsuario.php', $data);
    }

    public function editUsuario($id) {
        $usuarioObj = new UsuarioModel();
        $usuarioInfo = $usuarioObj->getUsuario($id);
        $rolObj = new RolModel();
        $rolesInfo = $rolObj->getAll();

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
            "title" => "Usuarios",
            "usuario" => $usuarioInfo,
            "roles" => $rolesInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('usuario/editUsuario.php', $data);
    }

    public function updateUsuario() {
        if (isset($_POST['txtId']) && isset($_POST['txtNombres']) && isset($_POST['txtApellidos']) && 
            isset($_POST['txtDocumento']) && isset($_POST['txtEmail']) && isset($_POST['txtPassword']) && 
            isset($_POST['txtTelefono']) && isset($_POST['txtTipoCoordinador']) && isset($_POST['txtGestor']) && 
            isset($_POST['txtFkIdRol'])) {
            
            $id = $_POST['txtId'] ?? null;
            $nombres = $_POST['txtNombres'] ?? null;
            $apellidos = $_POST['txtApellidos'] ?? null;
            $documento = $_POST['txtDocumento'] ?? null;
            $email = $_POST['txtEmail'] ?? null;
            $password = $_POST['txtPassword'] ?? null;
            $telefono = $_POST['txtTelefono'] ?? null;
            $tipoCoordinador = $_POST['txtTipoCoordinador'] ?? null;
            $gestor = $_POST['txtGestor'] ?? null;
            $fkIdRol = $_POST['txtFkIdRol'] ?? null;

            $usuarioObj = new UsuarioModel();
            $respuesta = $usuarioObj->editUsuario($id, $nombres, $apellidos, $documento, $email, $password, $telefono, $tipoCoordinador, $gestor, $fkIdRol);
        }
        header("location: /usuario/view");
    }

    public function deleteUsuario($id) {
        $usuarioObj = new UsuarioModel();
        $usuarioEliminar  = $usuarioObj->getUsuario($id);

        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuarioSesion = $usuarioModel->getUsuario($_SESSION['id']);   // Este error: Antes era: $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuarioSesion->fkIdRol);    // Error Solucionado
            $rolNombre = $rol->nombre ?? "Usuario";
        }

        $data = [
            "title" => "Eliminar Usuario",
            "usuario" => $usuarioEliminar,        // Enviamos la clave usuario para deleteUsuario.dart ($usuario)
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('usuario/deleteUsuario.php', $data);
    }

    public function removeUsuario()
    {
        if (isset($_POST['txtId'])) {   
            $id = $_POST['txtId'] ?? null;
            $usuarioObj = new UsuarioModel();
            $usuarioObj->removeUsuario($id);
            $this->redirectTo("usuario/view");
        }
    }

    // Funcion para importar excel usuario
    public function importarExcel() {
        // Agregar logging para debug
        error_log("=== INICIANDO IMPORTACIÓN EXCEL USUARIO ===");
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
            $resultado = $importacionModel->procesarExcelUsuario($_FILES['archivo_excel']);
            
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
        
        error_log("=== FINALIZANDO IMPORTACIÓN EXCEL USUARIO ===");
    }
    
}