<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE."../models/BaseModel.php";

class AprendizModel extends BaseModel {
    public function __construct(
        ?int $idAprendiz = null,
        ?string $tipoDocumento = null,
        ?string $documento = null,
        ?string $nombres = null,
        ?string $apellidos = null,
        ?string $telefono = null,
        ?string $email = null,
        ?string $estado = null,
        ?string $trimestre = null,
        ?string $fkIdGrupo = null
    ) {
        $this->table = "aprendiz";
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveAprendiz($tipoDocumento, $documento, $nombres, $apellidos, $telefono, $email, $estado, $trimestre, $fkIdGrupo) {
        try {
            $sql = "INSERT INTO $this->table (tipoDocumento, documento, nombres, apellidos, telefono, email, estado, trimestre, fkIdGrupo) 
                    VALUES (:tipoDocumento, :documento, :nombres, :apellidos, :telefono, :email, :estado, :trimestre, :fkIdGrupo)";
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);

            // 2. BindParam para sanitizar los datos de entrada
            $statement->bindParam('tipoDocumento', $tipoDocumento, PDO::PARAM_STR);
            $statement->bindParam('documento', $documento, PDO::PARAM_STR);
            $statement->bindParam('nombres', $nombres, PDO::PARAM_STR);
            $statement->bindParam('apellidos', $apellidos, PDO::PARAM_STR);
            $statement->bindParam('telefono', $telefono, PDO::PARAM_STR);
            $statement->bindParam('email', $email, PDO::PARAM_STR);
            $statement->bindParam('estado', $estado, PDO::PARAM_STR);
            $statement->bindParam('trimestre', $trimestre, PDO::PARAM_STR);
            $statement->bindParam('fkIdGrupo', $fkIdGrupo, PDO::PARAM_INT);

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar el aprendiz> ".$ex->getMessage();
        }
    }

    // Método para obtener todos los aprendices con información del grupo y programa de formación
    public function getAllWithGrupo() {
        try {
            $sql = "SELECT aprendiz.*, grupo.ficha AS fichaGrupo, programaformacion.nombre AS nombrePrograma 
                    FROM aprendiz 
                    INNER JOIN grupo ON aprendiz.fkIdGrupo = grupo.idGrupo
                    INNER JOIN programaformacion ON grupo.fkIdProgramaFormacion = programaformacion.idProgramaFormacion";
            $statement = $this->dbConnection->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (PDOException $ex) {
            echo "Error al obtener los aprendices con grupo: " . $ex->getMessage();
            return [];
        }
    }

    public function getAprendiz($id) {
        try {
            $sql = "SELECT aprendiz.*, grupo.ficha AS fichaGrupo, programaformacion.nombre AS nombrePrograma 
                    FROM aprendiz 
                    INNER JOIN grupo ON aprendiz.fkIdGrupo = grupo.idGrupo
                    INNER JOIN programaformacion ON grupo.fkIdProgramaFormacion = programaformacion.idProgramaFormacion
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

    public function editAprendiz($id, $tipoDocumento, $documento, $nombres, $apellidos, $telefono, $email, $estado, $trimestre, $fkIdGrupo) {
        try {
            $sql = "UPDATE $this->table SET 
                        tipoDocumento=:tipoDocumento, 
                        documento=:documento, 
                        nombres=:nombres, 
                        apellidos=:apellidos, 
                        telefono=:telefono, 
                        email=:email, 
                        estado=:estado, 
                        trimestre=:trimestre, 
                        fkIdGrupo=:fkIdGrupo 
                    WHERE idAprendiz=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":tipoDocumento", $tipoDocumento, PDO::PARAM_STR);
            $statement->bindParam(":documento", $documento, PDO::PARAM_STR);
            $statement->bindParam(":nombres", $nombres, PDO::PARAM_STR);
            $statement->bindParam(":apellidos", $apellidos, PDO::PARAM_STR);
            $statement->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $statement->bindParam(":email", $email, PDO::PARAM_STR);
            $statement->bindParam(":estado", $estado, PDO::PARAM_STR);
            $statement->bindParam(":trimestre", $trimestre, PDO::PARAM_STR);
            $statement->bindParam(":fkIdGrupo", $fkIdGrupo, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar el aprendiz".$ex->getMessage();
        }
    }

    public function removeAprendiz($id) {
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

    // Funcion para verificar importacion excel que no este repetido
    public function getAprendizPorDocumento($documento) {
        try {
            $sql = "SELECT * FROM aprendiz WHERE documento = ? LIMIT 1";
            $stmt = $this->dbConnection->prepare($sql);
            $stmt->execute([$documento]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log("Error en getAprendizPorDocumento: " . $e->getMessage());
            return false;
        }
    }


}