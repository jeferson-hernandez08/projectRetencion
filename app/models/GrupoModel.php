<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE."../models/BaseModel.php";

class GrupoModel extends BaseModel {
    public function __construct(
        ?int $idGrupo = null,
        ?string $ficha = null,
        ?string $jornada = null,
        ?string $modalidad = null,
        ?string $fkIdProgramaFormacion = null
    ) {
        $this->table = "grupo";
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveGrupo($ficha, $jornada, $modalidad, $fkIdProgramaFormacion) {
        try {
            $sql = "INSERT INTO $this->table (ficha, jornada, modalidad, fkIdProgramaFormacion) 
                    VALUES (:ficha, :jornada, :modalidad, :fkIdProgramaFormacion)";
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);
            // $ficha = $this->ficha ?? '';         // Estos datos es opcional
            // $jornada = $this->jornada ?? '';
            // $modalidad = $this->modalidad ?? '';
            // $fkIdProgramaFormacion = $this->fkIdProgramaFormacion ?? '';

            // 2. BindParam para sanitizar los datos de entrada
            $statement->bindParam('ficha', $ficha, PDO::PARAM_STR);
            $statement->bindParam('jornada', $jornada, PDO::PARAM_STR);
            $statement->bindParam('modalidad', $modalidad, PDO::PARAM_STR);
            $statement->bindParam('fkIdProgramaFormacion', $fkIdProgramaFormacion, PDO::PARAM_INT);

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar el grupo> ".$ex->getMessage();
        }
    }

    public function getGrupo($id) {
        try {
            $sql = "SELECT grupo.*, programaformacion.nombre AS nombrePrograma 
                    FROM grupo 
                    INNER JOIN programaformacion 
                    ON grupo.fkIdProgramaFormacion = programaformacion.idProgramaFormacion 
                    WHERE grupo.idGrupo=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result[0]; 
        } catch (PDOException $ex) {
            echo "Error al obtener el grupo" . $ex->getMessage();
        }
    }

    public function editGrupo($id, $ficha, $jornada, $modalidad, $fkIdProgramaFormacion) {
        try {
            $sql = "UPDATE $this->table SET 
                        ficha=:ficha, 
                        jornada=:jornada, 
                        modalidad=:modalidad, 
                        fkIdProgramaFormacion=:fkIdProgramaFormacion 
                    WHERE idGrupo=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":ficha", $ficha, PDO::PARAM_STR);
            $statement->bindParam(":jornada", $jornada, PDO::PARAM_STR);
            $statement->bindParam(":modalidad", $modalidad, PDO::PARAM_STR);
            $statement->bindParam(":fkIdProgramaFormacion", $fkIdProgramaFormacion, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar el grupo".$ex->getMessage();
        }
    }

    public function removeGrupo($id) {
        try {
            $sql = "DELETE FROM $this->table WHERE idGrupo=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo eliminar el grupo".$ex->getMessage();
        }
    }
}