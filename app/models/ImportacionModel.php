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
                
                //======= Aquí para validar que dato es obligatorio Excel ======//
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
        try {
            // Validaciones del archivo
            if ($archivo['error'] !== UPLOAD_ERR_OK) {
                throw new \Exception("Error en la subida del archivo: " . $archivo['error']);
            }
            
            // Validar extensión del archivo
            $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
            if (!in_array($extension, ['xlsx', 'xls'])) {
                throw new \Exception("Tipo de archivo no válido. Solo se permiten archivos Excel (.xlsx, .xls)");
            }
            
            error_log("Procesando archivo grupo: " . $archivo['name']);
            
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
                
                $ficha = trim($fila[0] ?? '');
                $inicioLectiva = trim($fila[1] ?? '');
                $finLectiva = trim($fila[2] ?? '');
                $inicioPractica = trim($fila[3] ?? '');
                $finPractica = trim($fila[4] ?? '');
                $nombreGestor = trim($fila[5] ?? '');
                $jornada = trim($fila[6] ?? '');
                $modalidad = trim($fila[7] ?? '');
                $fkIdProgramaFormacion = trim($fila[8] ?? '');
                
                //======= Aquí para validar que dato es obligatorio Excel ======//
                // Validar que al menos la ficha esté presente
                if (empty($ficha)) {
                    $errores[] = "Fila " . ($i + 1) . ": La ficha del grupo es obligatoria";
                    continue;
                }
                
                
                // Validar que el programa de formación exista solo si se proporcionó
                // if (!empty($fkIdProgramaFormacion)) {
                //     $programaModel = new ProgramaFormacionModel();
                //     $programaExiste = $programaModel->getProgramaFormacion($fkIdProgramaFormacion);
                //     if (!$programaExiste) {
                //         $errores[] = "Fila " . ($i + 1) . ": El programa de formación con ID '{$fkIdProgramaFormacion}' no existe";
                //         continue;
                //     }
                // } else {
                //     // Si está vacío, lo dejamos en NULL para el insert
                //     $fkIdProgramaFormacion = null;
                // }

                // Validar que el programa de formación exista
                if (empty($fkIdProgramaFormacion)) {
                    $errores[] = "Fila " . ($i + 1) . ": El ID del programa de formación es obligatorio";
                    continue;
                }
                
                try {
                    $grupoModel = new GrupoModel();
                    
                    // Verificar si el grupo ya existe por ficha
                    $existe = $grupoModel->getGrupoPorFicha($ficha);
                    if ($existe) {
                        $errores[] = "Fila " . ($i + 1) . ": El grupo con ficha '{$ficha}' ya existe";
                        continue;
                    }
                    
                    // Convertir fechas si es necesario
                    $inicioLectiva = $this->excelReader->formatearFechaExcel($inicioLectiva);
                    $finLectiva = $this->excelReader->formatearFechaExcel($finLectiva);
                    $inicioPractica = $this->excelReader->formatearFechaExcel($inicioPractica);
                    $finPractica = $this->excelReader->formatearFechaExcel($finPractica);
                    
                    // Validar que el programa de formación exista en la base de datos
                    $programaModel = new ProgramaFormacionModel();
                    $programaExiste = $programaModel->getProgramaFormacion($fkIdProgramaFormacion);
                    if (!$programaExiste) {
                        $errores[] = "Fila " . ($i + 1) . ": El programa de formación con ID '{$fkIdProgramaFormacion}' no existe";
                        continue;
                    }
                    
                    // Guardar el grupo
                    if ($grupoModel->saveGrupo($ficha, $inicioLectiva, $finLectiva, $inicioPractica, $finPractica, $nombreGestor, $jornada, $modalidad, $fkIdProgramaFormacion)) {
                        $registrosProcesados++;
                        error_log("Grupo guardado: " . $ficha);
                    } else {
                        $errores[] = "Fila " . ($i + 1) . ": No se pudo guardar el grupo '{$ficha}'";
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
            error_log("Error crítico en procesarExcelGrupo: " . $e->getMessage());
            throw $e;
        }
    }
    
    // Método para procesar Aprendices desde Excel
    public function procesarExcelAprendiz($archivo) {
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
            
            error_log("Procesando archivo aprendiz: " . $archivo['name']);
            
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
                
                $tipoDocumento = trim($fila[0] ?? '');
                $documento = trim($fila[1] ?? '');
                $nombres = trim($fila[2] ?? '');
                $apellidos = trim($fila[3] ?? '');
                $email = trim($fila[4] ?? '');
                $estado = trim($fila[5] ?? 'En formación');
                $telefono = trim($fila[6] ?? '');
                $trimestre = trim($fila[7] ?? '');
                $fkIdGrupo = trim($fila[8] ?? '');
                
                //======= Aquí para validar que dato es obligatorio Excel ======//
                // Validar que al menos el tipo documento esté presente
                if (empty($tipoDocumento)) {
                    $errores[] = "Fila " . ($i + 1) . ": El tipo de documento es obligatorio";
                    continue;
                }

                // Validar que al menos el documento esté presente
                if (empty($documento)) {
                    $errores[] = "Fila " . ($i + 1) . ": El documento del aprendiz es obligatorio";
                    continue;
                }

                // Validar que al menos el nombre esté presente
                if (empty($nombres)) {
                    $errores[] = "Fila " . ($i + 1) . ": El nombre del aprendiz es obligatorio";
                    continue;
                }

                // Validar que al menos el apellido esté presente
                if (empty($apellidos)) {
                    $errores[] = "Fila " . ($i + 1) . ": El apellido del aprendiz es obligatorio";
                    continue;
                }
                
                // Validar que el grupo exista
                if (empty($fkIdGrupo)) {
                    $errores[] = "Fila " . ($i + 1) . ": El ID del grupo es obligatorio";
                    continue;
                }
                
                try {
                    $aprendizModel = new AprendizModel();
                    
                    // Verificar si el aprendiz ya existe por documento
                    $existe = $aprendizModel->getAprendizPorDocumento($documento);
                    if ($existe) {
                        $errores[] = "Fila " . ($i + 1) . ": El aprendiz con documento '{$documento}' ya existe";
                        continue;
                    }
                    
                    // Validar que el grupo exista en la base de datos
                    $grupoModel = new GrupoModel();
                    $grupoExiste = $grupoModel->getGrupo($fkIdGrupo);
                    if (!$grupoExiste) {
                        $errores[] = "Fila " . ($i + 1) . ": El grupo con ID '{$fkIdGrupo}' no existe";
                        continue;
                    }
                    
                    // Guardar el aprendiz
                    if ($aprendizModel->saveAprendiz($tipoDocumento, $documento, $nombres, $apellidos, $telefono, $email, $estado, $trimestre, $fkIdGrupo)) {
                        $registrosProcesados++;
                        error_log("Aprendiz guardado: " . $documento);
                    } else {
                        $errores[] = "Fila " . ($i + 1) . ": No se pudo guardar el aprendiz '{$documento}'";
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
            error_log("Error crítico en procesarExcelAprendiz: " . $e->getMessage());
            throw $e;
        }
    }
    
    // Método para procesar Usuarios desde Excel
    public function procesarExcelUsuario($archivo) {
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
            
            error_log("Procesando archivo usuario: " . $archivo['name']);
            
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
                
                $nombres = trim($fila[0] ?? '');
                $apellidos = trim($fila[1] ?? '');
                $documento = trim($fila[2] ?? '');
                $email = trim($fila[3] ?? '');
                $password = trim($fila[4] ?? '123456');
                $telefono = trim($fila[5] ?? '');
                $tipoCoordinador = trim($fila[6] ?? 'No es coordinador');
                $gestor = trim($fila[7] ?? '');
                $fkIdRol = trim($fila[8] ?? 4);
                
                //======= Aquí para validar que dato es obligatorio Excel ======//
                // Validar que al menos el nombre esté presente
                if (empty($nombres)) {
                    $errores[] = "Fila " . ($i + 1) . ": El nombre del usuario es obligatorio";
                    continue;
                }

                // Validar que al menos el apellido esté presente
                if (empty($apellidos)) {
                    $errores[] = "Fila " . ($i + 1) . ": El apellido del usuario es obligatorio";
                    continue;
                }

                // Validar que el email esté presente
                if (empty($email)) {
                    $errores[] = "Fila " . ($i + 1) . ": El email del usuario es obligatorio";
                    continue;
                }
                
                // Validar que el rol esté presente
                if (empty($fkIdRol)) {
                    $errores[] = "Fila " . ($i + 1) . ": El ID del rol es obligatorio";
                    continue;
                }
                
                try {
                    $usuarioModel = new UsuarioModel();
                    
                    // Verificar si el usuario ya existe por email
                    $existe = $usuarioModel->getUsuarioPorEmail($email);
                    if ($existe) {
                        $errores[] = "Fila " . ($i + 1) . ": El usuario con email '{$email}' ya existe";
                        continue;
                    }
                    
                    // Validar que el rol exista en la base de datos
                    $rolModel = new RolModel();
                    $rolExiste = $rolModel->getRol($fkIdRol);
                    if (!$rolExiste) {
                        $errores[] = "Fila " . ($i + 1) . ": El rol con ID '{$fkIdRol}' no existe";
                        continue;
                    }
                    
                    // Convertir gestor a booleano/entero
                    if ($gestor === '' || is_null($gestor)) {
                        $gestor = null;
                    } else {
                        $gestor = ($gestor === '1' || $gestor === 1 || strtolower($gestor) === 'true' || strtolower($gestor) === 'si') ? 1 : 0;
                    }

                    // Hashear la contraseña
                    //$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    
                    // Guardar el usuario | Enviamos la contraseña normalmente en estexto - EL MODELO SE ENCARGA DEL HASH
                    if ($usuarioModel->saveUsuario($nombres, $apellidos, $documento, $email, $password, $telefono, $tipoCoordinador, $gestor, $fkIdRol)) {
                        $registrosProcesados++;
                        error_log("Usuario guardado: " . $email);
                    } else {
                        $errores[] = "Fila " . ($i + 1) . ": No se pudo guardar el usuario '{$email}'";
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
            error_log("Error crítico en procesarExcelUsuario: " . $e->getMessage());
            throw $e;
        }
    }
    
}
?>