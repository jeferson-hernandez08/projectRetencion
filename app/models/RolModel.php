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
        $this->table = "rol";
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveRol($nombre) {
        try {
            $sql = "INSERT INTO $this->table (nombre) VALUES (:nombre)";
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);

            // 2. BindParam para sanitizar los datos de entrada
            $statement->bindParam('nombre', $nombre, PDO::PARAM_STR);

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
            $sql = "SELECT * FROM $this->table WHERE idRol=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            //print_r($result);
            return $result[0];
        } catch (PDOException $ex) {
            echo "Error al obtener el rol: " . $ex->getMessage();
            return null;
        }
    }

    public function editRol($id, $nombre) {
        try {
            $sql = "UPDATE $this->table SET nombre=:nombre WHERE idRol=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar el rol: ".$ex->getMessage();
            return false;
        }
    }

    public function deleteRol($id) {
        try {
            $sql = "DELETE FROM $this->table WHERE idRol=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo eliminar el rol: ".$ex->getMessage();
            return false;
        }
    }

}