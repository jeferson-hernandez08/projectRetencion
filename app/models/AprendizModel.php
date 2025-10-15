<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE."../models/BaseModel.php";

class AprendizModel extends BaseModel {
    public function __construct(
        ?int $idAprendiz = null,
        ?string $tipoDocumento = null,
        ?string $documento = null,
        ?string $nombres = null,
        ?string $apellidos = null,
        ?string $telefono = null,
        ?string $email = null,
        ?string $estado = null,
        ?string $trimestre = null,
        ?string $fkIdGrupo = null
    ) {
        $this->table = "apprentices";  // Cambiado de "aprendiz" a "apprentices" para PostgreSQL
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveAprendiz($tipoDocumento, $documento, $nombres, $apellidos, $telefono, $email, $estado, $trimestre, $fkIdGrupo) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL con nombres de columnas en inglés
            // Se incluyen createdAt y updatedAt que son NOT NULL en PostgreSQL
            $sql = "INSERT INTO $this->table (documentType, document, firtsName, lastName, phone, email, status, quarter, fkIdGroups, createdAt, updatedAt) 
                    VALUES (:documentType, :document, :firtsName, :lastName, :phone, :email, :status, :quarter, :fkIdGroups, NOW(), NOW())";
                    
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);

            // 2. BindParam para sanitizar los datos de entrada - NOMBRES ADAPTADOS
            $statement->bindParam('documentType', $tipoDocumento, PDO::PARAM_STR);
            $statement->bindParam('document', $documento, PDO::PARAM_STR);
            $statement->bindParam('firtsName', $nombres, PDO::PARAM_STR);  // OJO: typo en BD es "firtsName"
            $statement->bindParam('lastName', $apellidos, PDO::PARAM_STR);
            $statement->bindParam('phone', $telefono, PDO::PARAM_STR);
            $statement->bindParam('email', $email, PDO::PARAM_STR);
            $statement->bindParam('status', $estado, PDO::PARAM_STR);
            $statement->bindParam('quarter', $trimestre, PDO::PARAM_STR);
            $statement->bindParam('fkIdGroups', $fkIdGrupo, PDO::PARAM_INT);

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar el aprendiz: ".$ex->getMessage();
            return false;
        }
    }

    // Método para obtener todos los aprendices con información del grupo y programa de formación
    public function getAllWithGrupo() {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de tablas y columnas actualizados
            $sql = "SELECT apprentices.*, groups.file AS fichaGrupo, training_programs.name AS nombrePrograma 
                    FROM apprentices 
                    INNER JOIN groups ON apprentices.fkIdGroups = groups.id
                    INNER JOIN training_programs ON groups.fkIdTrainingPrograms = training_programs.id";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (PDOException $ex) {
            echo "Error al obtener los aprendices con grupo: " . $ex->getMessage();
            return [];
        }
    }

    public function getAprendiz($id) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de tablas y columnas actualizados
            $sql = "SELECT apprentices.*, groups.file AS fichaGrupo, training_programs.name AS nombrePrograma 
                    FROM apprentices 
                    INNER JOIN groups ON apprentices.fkIdGroups = groups.id
                    INNER JOIN training_programs ON groups.fkIdTrainingPrograms = training_programs.id
                    WHERE apprentices.id = :id";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result[0]; 
        } catch (PDOException $ex) {
            echo "Error al obtener el aprendiz: " . $ex->getMessage();
            return null;
        }
    }

    public function editAprendiz($id, $tipoDocumento, $documento, $nombres, $apellidos, $telefono, $email, $estado, $trimestre, $fkIdGrupo) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de columnas actualizados
            $sql = "UPDATE $this->table SET 
                        documentType = :documentType, 
                        document = :document, 
                        firtsName = :firtsName, 
                        lastName = :lastName, 
                        phone = :phone, 
                        email = :email, 
                        status = :status, 
                        quarter = :quarter, 
                        fkIdGroups = :fkIdGroups,
                        updatedAt = NOW() 
                    WHERE id = :id";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":documentType", $tipoDocumento, PDO::PARAM_STR);
            $statement->bindParam(":document", $documento, PDO::PARAM_STR);
            $statement->bindParam(":firtsName", $nombres, PDO::PARAM_STR);  // OJO: typo en BD es "firtsName"
            $statement->bindParam(":lastName", $apellidos, PDO::PARAM_STR);
            $statement->bindParam(":phone", $telefono, PDO::PARAM_STR);
            $statement->bindParam(":email", $email, PDO::PARAM_STR);
            $statement->bindParam(":status", $estado, PDO::PARAM_STR);
            $statement->bindParam(":quarter", $trimestre, PDO::PARAM_STR);
            $statement->bindParam(":fkIdGroups", $fkIdGrupo, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar el aprendiz: ".$ex->getMessage();
            return false;
        }
    }

    public function removeAprendiz($id) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombre de columna cambiado
            $sql = "DELETE FROM $this->table WHERE id = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo eliminar el aprendiz: ".$ex->getMessage();
            return false;
        }
    }

    // Funcion para verificar importacion excel que no este repetido
    public function getAprendizPorDocumento($documento) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de tabla y columna actualizados
            $sql = "SELECT * FROM apprentices WHERE document = ? LIMIT 1";
            $stmt = $this->dbConnection->prepare($sql);
            $stmt->execute([$documento]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log("Error en getAprendizPorDocumento: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Método para obtener aprendices por grupo
     * @param int $idGrupo ID del grupo
     * @return array Array de aprendices del grupo especificado
     */
    public function getAprendicesPorGrupo($idGrupo) {
        try {
            $sql = "SELECT apprentices.*, groups.file AS fichaGrupo 
                    FROM apprentices 
                    INNER JOIN groups ON apprentices.fkIdGroups = groups.id
                    WHERE apprentices.fkIdGroups = :idGrupo
                    ORDER BY apprentices.firtsName, apprentices.lastName";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":idGrupo", $idGrupo, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al obtener aprendices por grupo: " . $ex->getMessage());
            return [];
        }
    }

    /**
     * Método para obtener aprendices por estado
     * @param string $estado Estado del aprendiz (En formación, Retenido, etc.)
     * @return array Array de aprendices con el estado especificado
     */
    public function getAprendicesPorEstado($estado) {
        try {
            $sql = "SELECT apprentices.*, groups.file AS fichaGrupo, training_programs.name AS nombrePrograma 
                    FROM apprentices 
                    INNER JOIN groups ON apprentices.fkIdGroups = groups.id
                    INNER JOIN training_programs ON groups.fkIdTrainingPrograms = training_programs.id
                    WHERE apprentices.status = :estado
                    ORDER BY apprentices.firtsName, apprentices.lastName";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":estado", $estado, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al obtener aprendices por estado: " . $ex->getMessage());
            return [];
        }
    }

    /**
     * Método para contar aprendices por grupo
     * @param int $idGrupo ID del grupo
     * @return int Número de aprendices en el grupo
     */
    public function contarAprendicesPorGrupo($idGrupo) {
        try {
            $sql = "SELECT COUNT(*) as total FROM apprentices WHERE fkIdGroups = :idGrupo";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":idGrupo", $idGrupo, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_OBJ);
            return $result->total;
        } catch (PDOException $ex) {
            error_log("Error al contar aprendices por grupo: " . $ex->getMessage());
            return 0;
        }
    }

    /**
     * Método para contar aprendices por estado
     * @param string $estado Estado del aprendiz
     * @return int Número de aprendices con el estado especificado
     */
    public function contarAprendicesPorEstado($estado) {
        try {
            $sql = "SELECT COUNT(*) as total FROM apprentices WHERE status = :estado";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":estado", $estado, PDO::PARAM_STR);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_OBJ);
            return $result->total;
        } catch (PDOException $ex) {
            error_log("Error al contar aprendices por estado: " . $ex->getMessage());
            return 0;
        }
    }

    /**
     * Método para buscar aprendices por texto
     * @param string $texto Texto a buscar en nombres, apellidos o documento
     * @return array Array de aprendices que coinciden con la búsqueda
     */
    public function buscarAprendices($texto) {
        try {
            $sql = "SELECT apprentices.*, groups.file AS fichaGrupo, training_programs.name AS nombrePrograma 
                    FROM apprentices 
                    INNER JOIN groups ON apprentices.fkIdGroups = groups.id
                    INNER JOIN training_programs ON groups.fkIdTrainingPrograms = training_programs.id
                    WHERE apprentices.firtsName ILIKE :texto 
                       OR apprentices.lastName ILIKE :texto 
                       OR apprentices.document ILIKE :texto
                    ORDER BY apprentices.firtsName, apprentices.lastName";
                    
            $statement = $this->dbConnection->prepare($sql);
            $textoBusqueda = "%$texto%";
            $statement->bindParam(":texto", $textoBusqueda, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al buscar aprendices: " . $ex->getMessage());
            return [];
        }
    }

    /**
     * Método para obtener aprendices con reportes
     * @return array Array de aprendices que tienen reportes
     */
    public function getAprendicesConReportes() {
        try {
            $sql = "SELECT DISTINCT a.*, g.file AS fichaGrupo, tp.name AS nombrePrograma
                    FROM apprentices a
                    INNER JOIN groups g ON a.fkIdGroups = g.id
                    INNER JOIN training_programs tp ON g.fkIdTrainingPrograms = tp.id
                    INNER JOIN reports r ON a.id = r.fkIdApprentices
                    ORDER BY a.firtsName, a.lastName";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al obtener aprendices con reportes: " . $ex->getMessage());
            return [];
        }
    }

}