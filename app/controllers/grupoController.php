<?php
namespace App\Controllers;
use App\Models\GrupoModel;
use App\Models\ProgramaFormacionModel;     // Importar la clase ProgramaFormacionModel

use App\Models\RolModel;         // Importar la clase RolModel para el card icon user cerrar sesion
use App\Models\UsuarioModel;
use App\Models\ImportacionModel;  

require_once 'baseController.php';
require_once MAIN_APP_ROUTE."../models/GrupoModel.php";
require_once MAIN_APP_ROUTE."../models/ProgramaFormacionModel.php";
require_once MAIN_APP_ROUTE . "../models/RolModel.php";
require_once MAIN_APP_ROUTE . "../models/UsuarioModel.php";
require_once MAIN_APP_ROUTE . "../models/ImportacionModel.php";

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
        $grupos = $grupoObj->getAllWithPrograma();    // Llamamos funcion para capturar programa

        // Obtener información del usuario y rol para el card icon user cerrar sesion
        $rolNombre = "Usuario";
        $nombreUsuario = $_SESSION['nombre'] ?? "Usuario";

        if (isset($_SESSION['id'])) {
            // Obtener detalles del usuario
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($_SESSION['id']);
            
            // Obtener nombre del rol
            $rolModel = new RolModel();
            $rol = $rolModel->getRol($usuario->fkIdRols);
            $rolNombre = $rol->nombre ?? "Usuario";
        }
        
        // Llamamos a la vista
        $data = [
            "title"     => "Grupos",
            "grupos"    => $grupos,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario" => $rolNombre
        ];
        $this->render('grupo/viewGrupo.php', $data);
    }

    public function newGrupo() {
        // Lógica para capturar programas de formación
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
            "title"         => "Grupos",
            "programas"     => $programas,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario"    => $rolNombre
        ];
        $this->render('grupo/newGrupo.php', $data);
    }

    public function createGrupo() {
        if (isset($_POST['txtFicha']) && isset($_POST['txtInicioLectiva']) && isset($_POST['txtFinLectiva']) && 
            isset($_POST['txtInicioPractica']) && isset($_POST['txtFinPractica']) && isset($_POST['txtNombreGestor']) &&
            isset($_POST['txtJornada']) && isset($_POST['txtModalidad']) && isset($_POST['txtFkIdProgramaFormacion'])) {
            
            $ficha = $_POST['txtFicha'] ?? null;
            $inicioLectiva = $_POST['txtInicioLectiva'] ?? null;
            $finLectiva = $_POST['txtFinLectiva'] ?? null;
            $inicioPractica = $_POST['txtInicioPractica'] ?? null;
            $finPractica = $_POST['txtFinPractica'] ?? null;
            $nombreGestor = $_POST['txtNombreGestor'] ?? null;
            $jornada = $_POST['txtJornada'] ?? null;
            $modalidad = $_POST['txtModalidad'] ?? null;
            $fkIdProgramaFormacion = $_POST['txtFkIdProgramaFormacion'] ?? null;

            // Creamos instancia del Modelo Grupo
            $grupoObj = new GrupoModel();
            
            // Se llama al método que guarda en la base de datos
            $grupoObj->saveGrupo($ficha, $inicioLectiva, $finLectiva, $inicioPractica, $finPractica, $nombreGestor, $jornada, $modalidad, $fkIdProgramaFormacion);
            $this->redirectTo("grupo/view");
        } else {
            echo "No se capturaron todos los datos del grupo";
        }
    }

    public function viewGrupo($id) {
        $grupoObj = new GrupoModel();
        $grupoInfo = $grupoObj->getGrupo($id);

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
            "title"     => "Grupos",
            'grupo'     => $grupoInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario"    => $rolNombre
        ];
        $this->render('grupo/viewOneGrupo.php', $data);
    }

    public function editGrupo($id) {
        $grupoObj = new GrupoModel();
        $grupoInfo = $grupoObj->getGrupo($id);
        $programaObj = new ProgramaFormacionModel();
        $programasInfo = $programaObj->getAll();

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
            "title"     => "Grupos",
            "grupo"     => $grupoInfo,
            "programas" => $programasInfo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario"    => $rolNombre
        ];
        $this->render('grupo/editGrupo.php', $data);
    }

    public function updateGrupo() {
        if (isset($_POST['txtId']) && isset($_POST['txtFicha']) && isset($_POST['txtInicioLectiva']) && 
            isset($_POST['txtFinLectiva']) && isset($_POST['txtInicioPractica']) && isset($_POST['txtFinPractica']) && 
            isset($_POST['txtNombreGestor']) && isset($_POST['txtJornada']) && isset($_POST['txtModalidad']) && 
            isset($_POST['txtFkIdProgramaFormacion'])) {
            
            $id = $_POST['txtId'] ?? null;
            $ficha = $_POST['txtFicha'] ?? null;
            $inicioLectiva = $_POST['txtInicioLectiva'] ?? null;
            $finLectiva = $_POST['txtFinLectiva'] ?? null;
            $inicioPractica = $_POST['txtInicioPractica'] ?? null;
            $finPractica = $_POST['txtFinPractica'] ?? null;
            $nombreGestor = $_POST['txtNombreGestor'] ?? null;
            $jornada = $_POST['txtJornada'] ?? null;
            $modalidad = $_POST['txtModalidad'] ?? null;
            $fkIdProgramaFormacion = $_POST['txtFkIdProgramaFormacion'] ?? null;

            $grupoObj = new GrupoModel();
            $respuesta = $grupoObj->editGrupo($id, $ficha, $inicioLectiva, $finLectiva, $inicioPractica, $finPractica, $nombreGestor, $jornada, $modalidad, $fkIdProgramaFormacion);
        }
        header("location: /grupo/view");
    }

    public function deleteGrupo($id) {
        $grupoObj = new GrupoModel();
        $grupo = $grupoObj->getGrupo($id);

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
            "title" => "Eliminar Grupo",
            "grupo" => $grupo,
            "nombreUsuario" => $nombreUsuario,   // Enviamos datos para el card icon user cerrar sesion
            "rolUsuario"    => $rolNombre
        ];
        $this->render('grupo/deleteGrupo.php', $data);
    }

    public function removeGrupo()
    {
        if (isset($_POST['txtId'])) {   
            $id = $_POST['txtId'] ?? null;
            $grupoObj = new GrupoModel();
            $grupoObj->removeGrupo($id);
            $this->redirectTo("grupo/view");
        }
    }

    // Funcion para importar excel grupo
    public function importarExcel() {
        // Agregar logging para debug
        error_log("=== INICIANDO IMPORTACIÓN EXCEL GRUPO ===");
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
            $resultado = $importacionModel->procesarExcelGrupo($_FILES['archivo_excel']);
            
            error_log("Procesamiento completado con éxito");
            
            echo json_encode([
                'success' => true,
                'procesados' => $resultado['procesados'],
                'errores' => $resultado['errores'],
                'message' => 'Importación completada exitosamente'
            ]);
            
        } catch (\Exception $e) {
            error_log("ERROR en importarExcel (Grupo): " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
        
        error_log("=== FINALIZANDO IMPORTACIÓN EXCEL GRUPO ===");
    }
    
}