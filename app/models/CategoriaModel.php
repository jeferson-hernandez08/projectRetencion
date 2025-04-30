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
        $this->table = "categoria";
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveCategoria($nombre, $descripcion, $direccionamiento) {
        try {
            $sql = "INSERT INTO $this->table (nombre, descripcion, direccionamiento) VALUES (:nombre, :descripcion, :direccionamiento)";
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);

            // 2. BindParam para sanitizar los datos de entrada
            $statement->bindParam('nombre', $nombre, PDO::PARAM_STR);
            $statement->bindParam('descripcion', $descripcion, PDO::PARAM_STR);
            $statement->bindParam('direccionamiento', $direccionamiento, PDO::PARAM_STR);

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
            $sql = "SELECT * FROM $this->table WHERE idCategoria=:id";
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
            $sql = "UPDATE $this->table SET nombre=:nombre, descripcion=:descripcion, direccionamiento=:direccionamiento WHERE idCategoria=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $statement->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $statement->bindParam(":direccionamiento", $direccionamiento, PDO::PARAM_STR);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar la categoría: ".$ex->getMessage();
            return false;
        }
    }

    public function removeCategoria($id) {
        try {
            $sql = "DELETE FROM $this->table WHERE idCategoria=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo eliminar la categoría: ".$ex->getMessage();
            return false;
        }
    }

}