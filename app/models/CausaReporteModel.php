<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE."../models/BaseModel.php";

class CausaReporteModel extends BaseModel {
    public function __construct(
        ?int $fkIdReporte = null,
        ?int $fkIdCausa = null
    ) {
        $this->table = "causes_reports";  // Cambiado de "causa_reporte" a "causes_reports" para PostgreSQL
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveCausaReporte($fkIdReporte, $fkIdCausa) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL con nombres de columnas en inglés
            // Se incluyen createdAt y updatedAt que son NOT NULL en PostgreSQL
            $sql = "INSERT INTO $this->table (\"fkIdReports\", \"fkIdCauses\", \"createdAt\", \"updatedAt\") 
                    VALUES (:fkIdReports, :fkIdCauses, NOW(), NOW())";
                    
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);
            // $fkIdReporte = $this->fkIdReporte ?? '';         // Estos datos es opcional
            // $fkIdCausa = $this->fkIdCausa ?? '';

            // 2. BindParam para sanitizar los datos de entrada - NOMBRES ADAPTADOS
            $statement->bindParam('fkIdReports', $fkIdReporte, PDO::PARAM_INT);
            $statement->bindParam('fkIdCauses', $fkIdCausa, PDO::PARAM_INT);

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar la causa reporte: ".$ex->getMessage();
            return false;
        }
    }

    public function getCausaReporte($fkIdReporte, $fkIdCausa) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de tablas y columnas actualizados
            $sql = "SELECT cr.*, c.cause, r.description AS reporte_descripcion
                    FROM causes_reports cr
                    INNER JOIN causes c ON cr.\"fkIdCauses\" = c.id
                    INNER JOIN reports r ON cr.\"fkIdReports\" = r.id
                    WHERE cr.\"fkIdReports\" = :fkIdReports AND cr.\"fkIdCauses\" = :fkIdCauses";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":fkIdReports", $fkIdReporte, PDO::PARAM_INT);
            $statement->bindParam(":fkIdCauses", $fkIdCausa, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result[0] ?? null; 
        } catch (PDOException $ex) {
            echo "Error al obtener la causa reporte: " . $ex->getMessage();
            return null;
        }
    }

    // public function editCausaReporte($oldFkIdReporte, $oldFkIdCausa, $newFkIdReporte, $newFkIdCausa) {
    //     try {
    //         $sql = "UPDATE $this->table SET 
    //                     fkIdReports = :newFkIdReports, 
    //                     fkIdCauses = :newFkIdCauses,
    //                     updatedAt = NOW()
    //                 WHERE fkIdReports = :oldFkIdReports AND fkIdCauses = :oldFkIdCauses";
    //         $statement = $this->dbConnection->prepare($sql);
    //         $statement->bindParam(":oldFkIdReports", $oldFkIdReporte, PDO::PARAM_INT);
    //         $statement->bindParam(":oldFkIdCauses", $oldFkIdCausa, PDO::PARAM_INT);
    //         $statement->bindParam(":newFkIdReports", $newFkIdReporte, PDO::PARAM_INT);
    //         $statement->bindParam(":newFkIdCauses", $newFkIdCausa, PDO::PARAM_INT);
    //         $result = $statement->execute();
    //         return $result;
    //     } catch (PDOException $ex) {
    //         echo "No se pudo editar la causa reporte: ".$ex->getMessage();
    //         return false;
    //     }
    // }

    public function deleteCausaReporte($fkIdReporte, $fkIdCausa) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de columnas actualizados
            $sql = "DELETE FROM $this->table WHERE \"fkIdReports\" = :fkIdReports AND \"fkIdCauses\" = :fkIdCauses";

            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":fkIdReports", $fkIdReporte, PDO::PARAM_INT);
            $statement->bindParam(":fkIdCauses", $fkIdCausa, PDO::PARAM_INT);
            $result = $statement->execute();

            // Verificamos si se afectó alguna fila
            return $statement->rowCount() > 0;
            //return $result;
        } catch (PDOException $ex) {
            error_log("Error al eliminar causa_reporte: ".$ex->getMessage());
            //echo "No se pudo eliminar la causa reporte".$ex->getMessage();
            return false;
        }
    }

    // Método adicional para obtener todas las causas de un reporte específico
    public function getCausasByReporte($fkIdReporte) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de tablas y columnas actualizados
            $sql = "SELECT causes.* 
                    FROM causes_reports 
                    INNER JOIN causes ON causes_reports.\"fkIdCauses\" = causes.id
                    WHERE causes_reports.\"fkIdReports\" = :fkIdReports";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":fkIdReports", $fkIdReporte, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (PDOException $ex) {
            echo "Error al obtener las causas del reporte: " . $ex->getMessage();
            return [];
        }
    }

    public function getAllRelaciones() {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de tablas y columnas actualizados
            $sql = "SELECT cr.*, r.description AS reporte_descripcion, c.cause AS causa_nombre
                    FROM causes_reports cr
                    JOIN reports r ON cr.\"fkIdReports\" = r.id
                    JOIN causes c ON cr.\"fkIdCauses\" = c.id
                    ORDER BY cr.\"fkIdReports\"";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener todas las relaciones causa-reporte: " . $ex->getMessage();
            return [];
        }
    }

    public function getByReporte($idReporte) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de tablas y columnas actualizados
            $sql = "SELECT c.* FROM causes c
                    JOIN causes_reports cr ON c.id = cr.\"fkIdCauses\"
                    WHERE cr.\"fkIdReports\" = :idReporte";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(':idReporte', $idReporte, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener causas por reporte: " . $ex->getMessage();
            return [];
        }
    }
    
    public function exists($fkIdReporte, $fkIdCausa) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de columnas actualizados
            $sql = "SELECT COUNT(*) FROM $this->table 
                    WHERE \"fkIdReports\" = :fkIdReports AND \"fkIdCauses\" = :fkIdCauses";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(':fkIdReports', $fkIdReporte, PDO::PARAM_INT);
            $statement->bindParam(':fkIdCauses', $fkIdCausa, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchColumn() > 0;
        } catch (PDOException $ex) {
            echo "Error al verificar existencia: " . $ex->getMessage();
            return false;
        }
    }

    /**
     * Método para eliminar todas las causas de un reporte
     * @param int $idReporte ID del reporte
     * @return bool True si se eliminaron correctamente
     */
    public function deleteAllByReporte($idReporte) {
        try {
            $sql = "DELETE FROM $this->table WHERE fkIdReports = :fkIdReports";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":fkIdReports", $idReporte, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            error_log("Error al eliminar todas las causas del reporte: " . $ex->getMessage());
            return false;
        }
    }

    /**
     * Método para contar relaciones por causa
     * @param int $idCausa ID de la causa
     * @return int Número de reportes que usan esta causa
     */
    public function contarPorCausa($idCausa) {
        try {
            $sql = "SELECT COUNT(*) as total FROM $this->table WHERE fkIdCauses = :fkIdCauses";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":fkIdCauses", $idCausa, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_OBJ);
            return $result->total;
        } catch (PDOException $ex) {
            error_log("Error al contar relaciones por causa: " . $ex->getMessage());
            return 0;
        }
    }

    /**
     * Método para obtener reportes por causa
     * @param int $idCausa ID de la causa
     * @return array Array de reportes que tienen esta causa
     */
    public function getReportesPorCausa($idCausa) {
        try {
            $sql = "SELECT r.*, 
                    CONCAT(a.firtsName, ' ', a.lastName) AS nombreAprendiz
                    FROM causes_reports cr
                    JOIN reports r ON cr.fkIdReports = r.id
                    JOIN apprentices a ON r.fkIdApprentices = a.id
                    WHERE cr.fkIdCauses = :fkIdCauses
                    ORDER BY r.creationDate DESC";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":fkIdCauses", $idCausa, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al obtener reportes por causa: " . $ex->getMessage());
            return [];
        }
    }

}