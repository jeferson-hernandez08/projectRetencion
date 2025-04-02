<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE."../models/BaseModel.php";

class AprendizModel extends BaseModel {
    public function __construct(
        ?int $idAprendiz = null,
        ?string $nombre = null,
        ?string $email = null,
        ?string $telefono = null,
        ?string $trimestre = null,
        ?string $fkIdGrupo = null,
        ?string $fkIdProgramaFormacion = null
    ) {
        $this->table = "aprendiz";
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveAprendiz($nombre, $email, $telefono, $trimestre, $fkIdGrupo, $fkIdProgramaFormacion) {
        try {
            $sql = "INSERT INTO $this->table (nombre, email, telefono, trimestre, fkIdGrupo, fkIdProgramaFormacion) 
                    VALUES (:nombre, :email, :telefono, :trimestre, :fkIdGrupo, :fkIdProgramaFormacion)";
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);
            // $nombre = $this->nombre ?? '';         // Estos datos es opcional
            // $email = $this->email ?? '';
            // $telefono = $this->telefono ?? '';
            // $trimestre = $this->trimestre ?? '';
            // $fkIdGrupo = $this->fkIdGrupo ?? '';
            // $fkIdProgramaFormacion = $this->fkIdProgramaFormacion ?? '';

            // 2. BindParam para sanitizar los datos de entrada
            $statement->bindParam('nombre', $nombre, PDO::PARAM_STR);
            $statement->bindParam('email', $email, PDO::PARAM_STR);
            $statement->bindParam('telefono', $telefono, PDO::PARAM_STR);
            $statement->bindParam('trimestre', $trimestre, PDO::PARAM_STR);
            $statement->bindParam('fkIdGrupo', $fkIdGrupo, PDO::PARAM_INT);
            $statement->bindParam('fkIdProgramaFormacion', $fkIdProgramaFormacion, PDO::PARAM_INT);

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar el aprendiz> ".$ex->getMessage();
        }
    }

    public function getAprendiz($id) {
        try {
            $sql = "SELECT aprendiz.*, grupo.ficha AS fichaGrupo, programaformacion.nombre AS nombrePrograma 
                    FROM aprendiz 
                    INNER JOIN grupo ON aprendiz.fkIdGrupo = grupo.idGrupo
                    INNER JOIN programaformacion ON aprendiz.fkIdProgramaFormacion = programaformacion.idProgramaFormacion
                    WHERE aprendiz.idAprendiz=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result[0]; 
        } catch (PDOException $ex) {
            echo "Error al obtener el aprendiz" . $ex->getMessage();
        }
    }

    public function editAprendiz($id, $nombre, $email, $telefono, $trimestre, $fkIdGrupo, $fkIdProgramaFormacion) {
        try {
            $sql = "UPDATE $this->table SET 
                        nombre=:nombre, 
                        email=:email, 
                        telefono=:telefono, 
                        trimestre=:trimestre, 
                        fkIdGrupo=:fkIdGrupo, 
                        fkIdProgramaFormacion=:fkIdProgramaFormacion 
                    WHERE idAprendiz=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $statement->bindParam(":email", $email, PDO::PARAM_STR);
            $statement->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $statement->bindParam(":trimestre", $trimestre, PDO::PARAM_STR);
            $statement->bindParam(":fkIdGrupo", $fkIdGrupo, PDO::PARAM_INT);
            $statement->bindParam(":fkIdProgramaFormacion", $fkIdProgramaFormacion, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar el aprendiz".$ex->getMessage();
        }
    }

    public function deleteAprendiz($id) {
        try {
            $sql = "DELETE FROM $this->table WHERE idAprendiz=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo eliminar el aprendiz".$ex->getMessage();
        }
    }
}