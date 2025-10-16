<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE."../models/BaseModel.php";

class RolModel extends BaseModel {
    public function __construct(
        ?int $idRol = null,
        ?string $nombre = null
    ) {
        $this->table = "rols";  // Cambiado de "rol" a "rols" para PostgreSQL
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveRol($nombre) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL con nombres de columnas en inglés
            // Se incluyen createdAt y updatedAt que son NOT NULL en PostgreSQL
            $sql = "INSERT INTO $this->table (name, \"createdAt\", \"updatedAt\") VALUES (:name, NOW(), NOW())";
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);

            // 2. BindParam para sanitizar los datos de entrada - NOMBRE ADAPTADO
            $statement->bindParam('name', $nombre, PDO::PARAM_STR);

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar el rol: ".$ex->getMessage();
            return false;
        }
    }

    public function getRol($id) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombre de columna cambiado
            $sql = "SELECT * FROM $this->table WHERE id = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            //print_r($result);
            //return $result[0];
            // VERIFICAR SI HAY RESULTADOS ANTES DE ACCEDER
            return count($result) > 0 ? $result[0] : null;
        } catch (PDOException $ex) {
            echo "Error al obtener el rol: " . $ex->getMessage();
            return null;
        }
    }

    public function editRol($id, $nombre) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de columnas actualizados
            $sql = "UPDATE $this->table SET name = :name, \"updatedAt\" = NOW() WHERE id = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":name", $nombre, PDO::PARAM_STR);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar el rol: ".$ex->getMessage();
            return false;
        }
    }

    public function removeRol($id) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombre de columna cambiado
            $sql = "DELETE FROM $this->table WHERE id = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo eliminar el rol: ".$ex->getMessage();
            return false;
        }
    }

    /**
     * Método para obtener todos los roles - Override del método getAll del BaseModel
     * @return array Array de objetos con todos los roles
     */
    public function getAll(): array {
        try {
            $sql = "SELECT * FROM $this->table ORDER BY name";
            $statement = $this->dbConnection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al obtener todos los roles: " . $ex->getMessage());
            return [];
        }
    }

    /**
     * Método para obtener rol por nombre
     * @param string $nombre Nombre del rol a buscar
     * @return mixed Objeto del rol si existe, null si no
     */
    public function getRolPorNombre($nombre) {
        try {
            $sql = "SELECT * FROM $this->table WHERE name = :name";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":name", $nombre, PDO::PARAM_STR);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return count($result) > 0 ? $result[0] : null;
        } catch (PDOException $ex) {
            error_log("Error al obtener rol por nombre: " . $ex->getMessage());
            return null;
        }
    }

}