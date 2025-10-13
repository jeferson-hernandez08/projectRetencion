<?php
// app/models/ImportacionModel.php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE . "../models/ProgramaFormacionModel.php";
require_once MAIN_APP_ROUTE . "../models/GrupoModel.php";
require_once MAIN_APP_ROUTE . "../models/AprendizModel.php";
require_once MAIN_APP_ROUTE . "../models/UsuarioModel.php";
require_once MAIN_APP_ROUTE . "../libraries/ExcelReader.php";

class ImportacionModel {
    private $excelReader;
    
    public function __construct() {
        $this->excelReader = new \App\Libraries\ExcelReader();
    }

    public function procesarExcelProgramaFormacion($archivo) {
        try {
            // Validaciones del archivo
            if ($archivo['error'] !== UPLOAD_ERR_OK) {
                throw new \Exception("Error en la subida del archivo. Código: " . $archivo['error']);
            }
            
            // Validar extensión del archivo
            $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
            if (!in_array($extension, ['xlsx', 'xls'])) {
                throw new \Exception("Tipo de archivo no válido. Solo se permiten archivos Excel (.xlsx, .xls)");
            }
            
            error_log("Procesando archivo: " . $archivo['name']);
            
            $datos = $this->excelReader->leerArchivo($archivo['tmp_name']);
            
            if (empty($datos)) {
                throw new \Exception("El archivo está vacío o no se pudieron leer los datos");
            }
            
            error_log("Datos leídos: " . count($datos) . " filas");
            
            $registrosProcesados = 0;
            $errores = [];
            
            // Saltar encabezados (primera fila)
            for ($i = 1; $i < count($datos); $i++) {
                $fila = $datos[$i];
                
                // Saltar filas completamente vacías
                if (empty(array_filter($fila, function($value) { 
                    return $value !== null && $value !== ''; 
                }))) {
                    continue;
                }
                
                $nombre = trim($fila[0] ?? '');
                $nivel = trim($fila[1] ?? '');
                $version = trim($fila[2] ?? '');
                
                // Validar que al menos el nombre esté presente
                if (empty($nombre)) {
                    $errores[] = "Fila " . ($i + 1) . ": El nombre del programa es obligatorio";
                    continue;
                }
                
                try {
                    $programaModel = new ProgramaFormacionModel();
                    
                    // Verificar si el programa ya existe
                    $existe = $programaModel->getProgramaPorNombre($nombre);
                    if ($existe) {
                        $errores[] = "Fila " . ($i + 1) . ": El programa '{$nombre}' ya existe";
                        continue;
                    }
                    
                    // Guardar el programa
                    if ($programaModel->saveProgramaFormacion($nombre, $nivel, $version)) {
                        $registrosProcesados++;
                        error_log("Programa guardado: " . $nombre);
                    } else {
                        $errores[] = "Fila " . ($i + 1) . ": No se pudo guardar el programa '{$nombre}'";
                    }
                } catch (\Exception $e) {
                    $errores[] = "Fila " . ($i + 1) . ": " . $e->getMessage();
                    error_log("Error en fila " . ($i + 1) . ": " . $e->getMessage());
                }
            }
            
            error_log("Procesamiento completado: " . $registrosProcesados . " registros, " . count($errores) . " errores");
            
            return [
                'procesados' => $registrosProcesados,
                'errores' => $errores
            ];
            
        } catch (\Exception $e) {
            error_log("Error crítico en procesarExcelProgramaFormacion: " . $e->getMessage());
            throw $e;
        }
    }
    
    public function procesarExcelGrupo($archivo) {
        $datos = $this->excelReader->leerArchivo($archivo['tmp_name']);
        $registrosProcesados = 0;
        $errores = [];
        
        for ($i = 1; $i < count($datos); $i++) {
            $fila = $datos[$i];
            
            if (empty($fila[0])) continue;
            
            $grupo = [
                'ficha' => $fila[0] ?? '',
                'inicioLectiva' => $this->excelReader->formatearFechaExcel($fila[1] ?? ''),
                'finLectiva' => $this->excelReader->formatearFechaExcel($fila[2] ?? ''),
                'inicioPractica' => $this->excelReader->formatearFechaExcel($fila[3] ?? ''),
                'finPractica' => $this->excelReader->formatearFechaExcel($fila[4] ?? ''),
                'nombreGestor' => $fila[5] ?? '',
                'jornada' => $fila[6] ?? '',
                'modalidad' => $fila[7] ?? '',
                'fkIdProgramaFormacion' => $fila[8] ?? ''
            ];
            
            try {
                // Aquí necesitarás un método saveGrupo en tu GrupoModel
                $grupoModel = new GrupoModel();
                if ($grupoModel->saveGrupo(
                    $grupo['ficha'],
                    $grupo['inicioLectiva'],
                    $grupo['finLectiva'],
                    $grupo['inicioPractica'],
                    $grupo['finPractica'],
                    $grupo['nombreGestor'],
                    $grupo['jornada'],
                    $grupo['modalidad'],
                    $grupo['fkIdProgramaFormacion']
                )) {
                    $registrosProcesados++;
                }
            } catch (\Exception $e) {
                $errores[] = "Fila " . ($i + 1) . ": " . $e->getMessage();
            }
        }
        
        return [
            'procesados' => $registrosProcesados,
            'errores' => $errores
        ];
    }
    
    // Método para procesar Aprendices desde Excel
    public function procesarExcelAprendiz($archivo) {
        $datos = $this->excelReader->leerArchivo($archivo['tmp_name']);
        $registrosProcesados = 0;
        $errores = [];
        
        for ($i = 1; $i < count($datos); $i++) {
            $fila = $datos[$i];
            
            if (empty($fila[0])) continue;
            
            $aprendiz = [
                'tipoDocumento' => $fila[0] ?? '',
                'documento' => $fila[1] ?? '',
                'nombres' => $fila[2] ?? '',
                'apellidos' => $fila[3] ?? '',
                'email' => $fila[4] ?? '',
                'estado' => $fila[5] ?? 'En formación',
                'telefono' => $fila[6] ?? '',
                'trimestre' => $fila[7] ?? '',
                'fkIdGrupo' => $fila[8] ?? ''
            ];
            
            try {
                // Aquí necesitarás un método saveAprendiz en tu AprendizModel
                $aprendizModel = new AprendizModel();
                if ($aprendizModel->saveAprendiz(
                    $aprendiz['tipoDocumento'],
                    $aprendiz['documento'],
                    $aprendiz['nombres'],
                    $aprendiz['apellidos'],
                    $aprendiz['email'],
                    $aprendiz['estado'],
                    $aprendiz['telefono'],
                    $aprendiz['trimestre'],
                    $aprendiz['fkIdGrupo']
                )) {
                    $registrosProcesados++;
                }
            } catch (\Exception $e) {
                $errores[] = "Fila " . ($i + 1) . ": " . $e->getMessage();
            }
        }
        
        return [
            'procesados' => $registrosProcesados,
            'errores' => $errores
        ];
    }
    
    // Método para procesar Usuarios desde Excel
    public function procesarExcelUsuario($archivo) {
        $datos = $this->excelReader->leerArchivo($archivo['tmp_name']);
        $registrosProcesados = 0;
        $errores = [];
        
        for ($i = 1; $i < count($datos); $i++) {
            $fila = $datos[$i];
            
            if (empty($fila[0])) continue;
            
            $usuario = [
                'nombres' => $fila[0] ?? '',
                'apellidos' => $fila[1] ?? '',
                'documento' => $fila[2] ?? '',
                'email' => $fila[3] ?? '',
                'password' => password_hash($fila[4] ?? '123456', PASSWORD_DEFAULT),
                'telefono' => $fila[5] ?? '',
                'tipoCoordinador' => $fila[6] ?? 'No es coordinador',
                'gestor' => $fila[7] ?? 0,
                'fkIdRol' => $fila[8] ?? 4
            ];
            
            try {
                //Aquí necesitarás un método saveUsuario en tu UsuarioModel
                $usuarioModel = new UsuarioModel();
                if ($usuarioModel->saveUsuario(
                    $usuario['nombres'],
                    $usuario['apellidos'],
                    $usuario['documento'],
                    $usuario['email'],
                    $usuario['password'],
                    $usuario['telefono'],
                    $usuario['tipoCoordinador'],
                    $usuario['gestor'],
                    $usuario['fkIdRol']
                )) {
                    $registrosProcesados++;
                }
            } catch (\Exception $e) {
                $errores[] = "Fila " . ($i + 1) . ": " . $e->getMessage();
            }
        }
        
        return [
            'procesados' => $registrosProcesados,
            'errores' => $errores
        ];
    }
}
?>