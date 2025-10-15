<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE."../models/BaseModel.php";

class CausaModel extends BaseModel {
    public function __construct(
        ?int $idCausa = null,
        ?string $causa = null,
        ?string $variables = null,
        ?string $fkIdCategoria = null
    ) {
        $this->table = "causes";  // Cambiado de "causa" a "causes" para PostgreSQL
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveCausa($causa, $variables, $fkIdCategoria) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL con nombres de columnas en inglés
            // Se incluyen createdAt y updatedAt que son NOT NULL en PostgreSQL
            $sql = "INSERT INTO $this->table (cause, variable, fkIdCategories, createdAt, updatedAt) 
                    VALUES (:cause, :variable, :fkIdCategories, NOW(), NOW())";
                    
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);
            // $causa = $this->causa ?? '';         // Estos datos es opcional
            // $variables = $this->variables ?? '';
            // $fkIdCategoria = $this->fkIdCategoria ?? '';

            // 2. BindParam para sanitizar los datos de entrada - NOMBRES ADAPTADOS
            $statement->bindParam('cause', $causa, PDO::PARAM_STR);
            $statement->bindParam('variable', $variables, PDO::PARAM_STR);
            $statement->bindParam('fkIdCategories', $fkIdCategoria, PDO::PARAM_INT);

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar la causa: ".$ex->getMessage();
            return false;
        }
    }

    public function getCausa($id) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de tablas y columnas actualizados
            $sql = "SELECT causes.*, categories.name AS nombreCategoria 
                    FROM causes 
                    INNER JOIN categories 
                    ON causes.fkIdCategories = categories.id 
                    WHERE causes.id = :id";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result[0]; 
        } catch (PDOException $ex) {
            echo "Error al obtener la causa: " . $ex->getMessage();
            return null;
        }
    }

    public function editCausa($id, $causa, $variables, $fkIdCategoria) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de columnas actualizados
            $sql = "UPDATE $this->table SET 
                        cause = :cause, 
                        variable = :variable, 
                        fkIdCategories = :fkIdCategories,
                        updatedAt = NOW() 
                    WHERE id = :id";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":cause", $causa, PDO::PARAM_STR);
            $statement->bindParam(":variable", $variables, PDO::PARAM_STR);
            $statement->bindParam(":fkIdCategories", $fkIdCategoria, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar la causa: ".$ex->getMessage();
            return false;
        }
    }

    public function removeCausa($id) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombre de columna cambiado
            $sql = "DELETE FROM $this->table WHERE id = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo eliminar la causa: ".$ex->getMessage();
            return false;
        }
    }

    public function getAll():array {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de tablas y columnas actualizados
            $sql = "SELECT causes.*, categories.name AS nombreCategoria 
                    FROM causes 
                    LEFT JOIN categories ON causes.fkIdCategories = categories.id";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener las causas: " . $ex->getMessage();
            return [];
        }
    }

    /**
     * Método para obtener causas por categoría
     * @param int $idCategoria ID de la categoría
     * @return array Array de causas de la categoría especificada
     */
    public function getCausasPorCategoria($idCategoria) {
        try {
            $sql = "SELECT causes.*, categories.name AS nombreCategoria 
                    FROM causes 
                    INNER JOIN categories ON causes.fkIdCategories = categories.id
                    WHERE causes.fkIdCategories = :idCategoria
                    ORDER BY causes.cause";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":idCategoria", $idCategoria, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al obtener causas por categoría: " . $ex->getMessage());
            return [];
        }
    }

    /**
     * Método para contar causas por categoría
     * @param int $idCategoria ID de la categoría
     * @return int Número de causas en la categoría
     */
    public function contarCausasPorCategoria($idCategoria) {
        try {
            $sql = "SELECT COUNT(*) as total FROM causes WHERE fkIdCategories = :idCategoria";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":idCategoria", $idCategoria, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_OBJ);
            return $result->total;
        } catch (PDOException $ex) {
            error_log("Error al contar causas por categoría: " . $ex->getMessage());
            return 0;
        }
    }

    /**
     * Método para buscar causas por texto
     * @param string $texto Texto a buscar en las causas
     * @return array Array de causas que coinciden con la búsqueda
     */
    public function buscarCausas($texto) {
        try {
            $sql = "SELECT causes.*, categories.name AS nombreCategoria 
                    FROM causes 
                    LEFT JOIN categories ON causes.fkIdCategories = categories.id
                    WHERE causes.cause ILIKE :texto OR causes.variable ILIKE :texto
                    ORDER BY causes.cause";
                    
            $statement = $this->dbConnection->prepare($sql);
            $textoBusqueda = "%$texto%";
            $statement->bindParam(":texto", $textoBusqueda, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al buscar causas: " . $ex->getMessage());
            return [];
        }
    }

    /**
     * Método para obtener causas más utilizadas en reportes
     * @param int $limite Límite de resultados (opcional, por defecto 10)
     * @return array Array de causas con conteo de uso
     */
    public function getCausasMasUtilizadas($limite = 10) {
        try {
            $sql = "SELECT c.*, COUNT(cr.fkIdCauses) as total_uso
                    FROM causes c
                    LEFT JOIN causes_reports cr ON c.id = cr.fkIdCauses
                    GROUP BY c.id
                    ORDER BY total_uso DESC
                    LIMIT :limite";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":limite", $limite, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al obtener causas más utilizadas: " . $ex->getMessage());
            return [];
        }
    }

}