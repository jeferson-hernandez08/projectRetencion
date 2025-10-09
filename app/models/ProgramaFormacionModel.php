<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE."../models/BaseModel.php";

class ProgramaFormacionModel extends BaseModel {
    public function __construct(
        ?int $idProgramaFormacion = null,
        ?string $nombre = null,
        ?string $nivel = null,
        ?string $version = null
    ) {
        $this->table = "programaformacion";
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveProgramaFormacion($nombre, $nivel, $version) {
        try {
            $sql = "INSERT INTO $this->table (nombre, nivel, version) VALUES (:nombre, :nivel, :version)";
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);

            // 2. BindParam para sanitizar los datos de entrada
            $statement->bindParam('nombre', $nombre, PDO::PARAM_STR);
            $statement->bindParam('nivel', $nivel, PDO::PARAM_STR);
            $statement->bindParam('version', $version, PDO::PARAM_STR);

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar el programa de formación: ".$ex->getMessage();
            return false;
        }
    }

    public function getProgramaFormacion($id) {
        try {
            $sql = "SELECT * FROM $this->table WHERE idProgramaFormacion=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            //print_r($result);
            return $result[0];
        } catch (PDOException $ex) {
            echo "Error al obtener el programa de formación: " . $ex->getMessage();
            return null;
        }
    }

    public function editProgramaFormacion($id, $nombre, $nivel, $version) {
        try {
            $sql = "UPDATE $this->table SET nombre=:nombre, nivel=:nivel, version=:version WHERE idProgramaFormacion=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $statement->bindParam(":nivel", $nivel, PDO::PARAM_STR);
            $statement->bindParam(":version", $version, PDO::PARAM_STR);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar el programa de formación: ".$ex->getMessage();
            return false;
        }
    }

    public function removeProgramaFormacion($id) {
        try {
            $sql = "DELETE FROM $this->table WHERE idProgramaFormacion=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo eliminar el programa de formación: ".$ex->getMessage();
            return false;
        }
    }

}