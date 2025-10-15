<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE."../models/BaseModel.php";

class EstrategiasModel extends BaseModel {
    public function __construct(
        ?int $idEstrategias = null,
        ?string $estrategia = null,
        ?string $fkIdCategoria = null
    ) {
        $this->table = "strategies";  // Cambiado de "estrategias" a "strategies" para PostgreSQL
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveEstrategias($estrategia, $fkIdCategoria) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL con nombres de columnas en inglés
            // Se incluyen createdAt y updatedAt que son NOT NULL en PostgreSQL
            $sql = "INSERT INTO $this->table (strategy, fkIdCategories, createdAt, updatedAt) 
                    VALUES (:strategy, :fkIdCategories, NOW(), NOW())";
                    
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);
            // $estrategia = $this->estrategia ?? '';         // Estos datos es opcional
            // $fkIdCategoria = $this->fkIdCategoria ?? '';

            // 2. BindParam para sanitizar los datos de entrada - NOMBRES ADAPTADOS
            $statement->bindParam('strategy', $estrategia, PDO::PARAM_STR);
            $statement->bindParam('fkIdCategories', $fkIdCategoria, PDO::PARAM_INT);

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar la estrategia: ".$ex->getMessage();
            return false;
        }
    }

    public function getEstrategias($id) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de tablas y columnas actualizados
            $sql = "SELECT strategies.*, categories.name AS nombreCategoria 
                    FROM strategies 
                    INNER JOIN categories 
                    ON strategies.fkIdCategories = categories.id 
                    WHERE strategies.id = :id";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result[0]; 
        } catch (PDOException $ex) {
            echo "Error al obtener la estrategia: " . $ex->getMessage();
            return null;
        }
    }

    public function editEstrategias($id, $estrategia, $fkIdCategoria) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de columnas actualizados
            $sql = "UPDATE $this->table SET 
                        strategy = :strategy, 
                        fkIdCategories = :fkIdCategories,
                        updatedAt = NOW() 
                    WHERE id = :id";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":strategy", $estrategia, PDO::PARAM_STR);
            $statement->bindParam(":fkIdCategories", $fkIdCategoria, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar la estrategia: ".$ex->getMessage();
            return false;
        }
    }

    public function removeEstrategias($id) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombre de columna cambiado
            $sql = "DELETE FROM $this->table WHERE id = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo eliminar la estrategia: ".$ex->getMessage();
            return false;
        }
    }

    public function getAll():array {      // Mandar a cards nombreCategoria en viewCategorias.php
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de tablas y columnas actualizados
            $sql = "SELECT strategies.*, categories.name AS nombreCategoria 
                    FROM strategies 
                    LEFT JOIN categories ON strategies.fkIdCategories = categories.id";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener las estrategias: " . $ex->getMessage();
            return [];
        }
    }

    /**
     * Método para obtener estrategias por categoría
     * @param int $idCategoria ID de la categoría
     * @return array Array de estrategias de la categoría especificada
     */
    public function getEstrategiasPorCategoria($idCategoria) {
        try {
            $sql = "SELECT strategies.*, categories.name AS nombreCategoria 
                    FROM strategies 
                    INNER JOIN categories ON strategies.fkIdCategories = categories.id
                    WHERE strategies.fkIdCategories = :idCategoria
                    ORDER BY strategies.strategy";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":idCategoria", $idCategoria, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al obtener estrategias por categoría: " . $ex->getMessage());
            return [];
        }
    }

    /**
     * Método para contar estrategias por categoría
     * @param int $idCategoria ID de la categoría
     * @return int Número de estrategias en la categoría
     */
    public function contarEstrategiasPorCategoria($idCategoria) {
        try {
            $sql = "SELECT COUNT(*) as total FROM strategies WHERE fkIdCategories = :idCategoria";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":idCategoria", $idCategoria, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_OBJ);
            return $result->total;
        } catch (PDOException $ex) {
            error_log("Error al contar estrategias por categoría: " . $ex->getMessage());
            return 0;
        }
    }

    /**
     * Método para buscar estrategias por texto
     * @param string $texto Texto a buscar en las estrategias
     * @return array Array de estrategias que coinciden con la búsqueda
     */
    public function buscarEstrategias($texto) {
        try {
            $sql = "SELECT strategies.*, categories.name AS nombreCategoria 
                    FROM strategies 
                    LEFT JOIN categories ON strategies.fkIdCategories = categories.id
                    WHERE strategies.strategy ILIKE :texto
                    ORDER BY strategies.strategy";
                    
            $statement = $this->dbConnection->prepare($sql);
            $textoBusqueda = "%$texto%";
            $statement->bindParam(":texto", $textoBusqueda, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al buscar estrategias: " . $ex->getMessage());
            return [];
        }
    }

}