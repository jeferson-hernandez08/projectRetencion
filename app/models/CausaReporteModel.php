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
        $this->table = "causa_reporte";
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveCausaReporte($fkIdReporte, $fkIdCausa) {
        try {
            $sql = "INSERT INTO $this->table (fkIdReporte, fkIdCausa) 
                    VALUES (:fkIdReporte, :fkIdCausa)";
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);
            // $fkIdReporte = $this->fkIdReporte ?? '';         // Estos datos es opcional
            // $fkIdCausa = $this->fkIdCausa ?? '';

            // 2. BindParam para sanitizar los datos de entrada
            $statement->bindParam('fkIdReporte', $fkIdReporte, PDO::PARAM_INT);
            $statement->bindParam('fkIdCausa', $fkIdCausa, PDO::PARAM_INT);

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar la causa reporte> ".$ex->getMessage();
        }
    }

    public function getCausaReporte($fkIdReporte, $fkIdCausa) {
        try {
            $sql = "SELECT causa_reporte.*, causa.causa AS nombreCausa, reporte.descripcion AS descripcionReporte
                    FROM causa_reporte 
                    INNER JOIN causa ON causa_reporte.fkIdCausa = causa.idCausa
                    INNER JOIN reporte ON causa_reporte.fkIdReporte = reporte.idReporte
                    WHERE causa_reporte.fkIdReporte=:fkIdReporte AND causa_reporte.fkIdCausa=:fkIdCausa";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":fkIdReporte", $fkIdReporte, PDO::PARAM_INT);
            $statement->bindParam(":fkIdCausa", $fkIdCausa, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result[0] ?? null; 
        } catch (PDOException $ex) {
            echo "Error al obtener la causa reporte" . $ex->getMessage();
        }
    }

    public function editCausaReporte($oldFkIdReporte, $oldFkIdCausa, $newFkIdReporte, $newFkIdCausa) {
        try {
            $sql = "UPDATE $this->table SET 
                        fkIdReporte=:newFkIdReporte, 
                        fkIdCausa=:newFkIdCausa 
                    WHERE fkIdReporte=:oldFkIdReporte AND fkIdCausa=:oldFkIdCausa";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":oldFkIdReporte", $oldFkIdReporte, PDO::PARAM_INT);
            $statement->bindParam(":oldFkIdCausa", $oldFkIdCausa, PDO::PARAM_INT);
            $statement->bindParam(":newFkIdReporte", $newFkIdReporte, PDO::PARAM_INT);
            $statement->bindParam(":newFkIdCausa", $newFkIdCausa, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar la causa reporte".$ex->getMessage();
        }
    }

    public function deleteCausaReporte($fkIdReporte, $fkIdCausa) {
        try {
            $sql = "DELETE FROM $this->table WHERE fkIdReporte=:fkIdReporte AND fkIdCausa=:fkIdCausa";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":fkIdReporte", $fkIdReporte, PDO::PARAM_INT);
            $statement->bindParam(":fkIdCausa", $fkIdCausa, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo eliminar la causa reporte".$ex->getMessage();
        }
    }

    // Método adicional para obtener todas las causas de un reporte específico
    public function getCausasByReporte($fkIdReporte) {
        try {
            $sql = "SELECT causa.* 
                    FROM causa_reporte 
                    INNER JOIN causa ON causa_reporte.fkIdCausa = causa.idCausa
                    WHERE causa_reporte.fkIdReporte=:fkIdReporte";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":fkIdReporte", $fkIdReporte, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (PDOException $ex) {
            echo "Error al obtener las causas del reporte" . $ex->getMessage();
        }
    }
}

// public function getAllRelaciones() {
//     try {
//         $sql = "SELECT cr.*, 
//                 r.descripcion AS descripcion_reporte, 
//                 c.causa AS nombre_causa
//                 FROM causa_reporte cr
//                 JOIN reporte r ON cr.fkIdReporte = r.idReporte
//                 JOIN causa c ON cr.fkIdCausa = c.idCausa
//                 ORDER BY cr.fkIdReporte";
        
//         $statement = $this->dbConnection->prepare($sql);
//         $statement->execute();
        
//         return $statement->fetchAll(PDO::FETCH_OBJ);
//     } catch (PDOException $ex) {
//         error_log("Error al obtener todas las relaciones causa-reporte: " . $ex->getMessage());
//         return [];
//     }
// }