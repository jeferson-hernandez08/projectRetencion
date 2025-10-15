<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE."../models/BaseModel.php";

class CategoriaModel extends BaseModel {
    public function __construct(
        ?int $idCategoria = null,
        ?string $nombre = null,
        ?string $descripcion = null,
        ?string $direccionamiento = null
    ) {
        $this->table = "categories";  // Cambiado de "categoria" a "categories" para PostgreSQL
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveCategoria($nombre, $descripcion, $direccionamiento) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL con nombres de columnas en inglés
            // Se incluyen createdAt y updatedAt que son NOT NULL en PostgreSQL
            $sql = "INSERT INTO $this->table (name, description, addressing, createdAt, updatedAt) 
                    VALUES (:name, :description, :addressing, NOW(), NOW())";
                    
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);

            // 2. BindParam para sanitizar los datos de entrada - NOMBRES ADAPTADOS
            $statement->bindParam('name', $nombre, PDO::PARAM_STR);
            $statement->bindParam('description', $descripcion, PDO::PARAM_STR);
            $statement->bindParam('addressing', $direccionamiento, PDO::PARAM_STR);

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar la categoría: ".$ex->getMessage();
            return false;
        }
    }

    public function getCategoria($id) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombre de columna cambiado
            $sql = "SELECT * FROM $this->table WHERE id = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            //print_r($result);
            return $result[0];
        } catch (PDOException $ex) {
            echo "Error al obtener la categoría: " . $ex->getMessage();
            return null;
        }
    }

    public function editCategoria($id, $nombre, $descripcion, $direccionamiento) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de columnas actualizados
            $sql = "UPDATE $this->table SET name = :name, description = :description, addressing = :addressing, updatedAt = NOW() WHERE id = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":name", $nombre, PDO::PARAM_STR);
            $statement->bindParam(":description", $descripcion, PDO::PARAM_STR);
            $statement->bindParam(":addressing", $direccionamiento, PDO::PARAM_STR);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar la categoría: ".$ex->getMessage();
            return false;
        }
    }

    public function removeCategoria($id) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombre de columna cambiado
            $sql = "DELETE FROM $this->table WHERE id = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo eliminar la categoría: ".$ex->getMessage();
            return false;
        }
    }

    /**
     * Método para obtener todas las categorías - Override del método getAll del BaseModel
     * @return array Array de objetos con todas las categorías
     */
    public function getAll(): array {
        try {
            $sql = "SELECT * FROM $this->table ORDER BY name";
            $statement = $this->dbConnection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al obtener todas las categorías: " . $ex->getMessage());
            return [];
        }
    }

    /**
     * Método para obtener categorías por direccionamiento
     * @param string $direccionamiento Tipo de direccionamiento (Coordinador de formación, Coordinador académico, etc.)
     * @return array Array de categorías del direccionamiento especificado
     */
    public function getCategoriasPorDireccionamiento($direccionamiento) {
        try {
            $sql = "SELECT * FROM $this->table WHERE addressing = :addressing ORDER BY name";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":addressing", $direccionamiento, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al obtener categorías por direccionamiento: " . $ex->getMessage());
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
     * Método para buscar categorías por texto
     * @param string $texto Texto a buscar en nombre o descripción
     * @return array Array de categorías que coinciden con la búsqueda
     */
    public function buscarCategorias($texto) {
        try {
            $sql = "SELECT * FROM $this->table 
                    WHERE name ILIKE :texto OR description ILIKE :texto 
                    ORDER BY name";
                    
            $statement = $this->dbConnection->prepare($sql);
            $textoBusqueda = "%$texto%";
            $statement->bindParam(":texto", $textoBusqueda, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al buscar categorías: " . $ex->getMessage());
            return [];
        }
    }

    /**
     * Método para obtener categorías con estadísticas de uso
     * @return array Array de categorías con conteo de causas y estrategias
     */
    public function getCategoriasConEstadisticas() {
        try {
            $sql = "SELECT c.*, 
                    COUNT(DISTINCT ca.id) as total_causas,
                    COUNT(DISTINCT s.id) as total_estrategias
                    FROM categories c
                    LEFT JOIN causes ca ON c.id = ca.fkIdCategories
                    LEFT JOIN strategies s ON c.id = s.fkIdCategories
                    GROUP BY c.id
                    ORDER BY c.name";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al obtener categorías con estadísticas: " . $ex->getMessage());
            return [];
        }
    }

}