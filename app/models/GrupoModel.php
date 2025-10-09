<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE."../models/BaseModel.php";

class GrupoModel extends BaseModel {
    public function __construct(
        ?int $idGrupo = null,
        ?string $ficha = null,
        ?string $inicioLectiva = null,
        ?string $finLectiva = null,
        ?string $inicioPractica = null,
        ?string $finPractica = null,
        ?string $nombreGestor = null,
        ?string $jornada = null,
        ?string $modalidad = null,
        ?string $fkIdProgramaFormacion = null
    ) {
        $this->table = "grupo";
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveGrupo($ficha, $inicioLectiva, $finLectiva, $inicioPractica, $finPractica, $nombreGestor, $jornada, $modalidad, $fkIdProgramaFormacion) {
        try {
            $sql = "INSERT INTO $this->table (ficha, inicioLectiva, finLectiva, inicioPractica, finPractica, nombreGestor, jornada, modalidad, fkIdProgramaFormacion) 
                    VALUES (:ficha, :inicioLectiva, :finLectiva, :inicioPractica, :finPractica, :nombreGestor, :jornada, :modalidad, :fkIdProgramaFormacion)";
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);

            // 2. BindParam para sanitizar los datos de entrada
            $statement->bindParam('ficha', $ficha, PDO::PARAM_STR);
            $statement->bindParam('inicioLectiva', $inicioLectiva, PDO::PARAM_STR);
            $statement->bindParam('finLectiva', $finLectiva, PDO::PARAM_STR);
            $statement->bindParam('inicioPractica', $inicioPractica, PDO::PARAM_STR);
            $statement->bindParam('finPractica', $finPractica, PDO::PARAM_STR);
            $statement->bindParam('nombreGestor', $nombreGestor, PDO::PARAM_STR);
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

    // Método para obtener todos los grupos con información del programa de formación
    public function getAllWithPrograma() {
        try {
            $sql = "SELECT grupo.*, programaformacion.nombre AS nombrePrograma 
                    FROM grupo 
                    INNER JOIN programaformacion 
                    ON grupo.fkIdProgramaFormacion = programaformacion.idProgramaFormacion";
            $statement = $this->dbConnection->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (PDOException $ex) {
            echo "Error al obtener los grupos con programa: " . $ex->getMessage();
            return [];
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

    public function editGrupo($id, $ficha, $inicioLectiva, $finLectiva, $inicioPractica, $finPractica, $nombreGestor, $jornada, $modalidad, $fkIdProgramaFormacion) {
        try {
            $sql = "UPDATE $this->table SET 
                        ficha=:ficha, 
                        inicioLectiva=:inicioLectiva,
                        finLectiva=:finLectiva,
                        inicioPractica=:inicioPractica,
                        finPractica=:finPractica,
                        nombreGestor=:nombreGestor,
                        jornada=:jornada, 
                        modalidad=:modalidad, 
                        fkIdProgramaFormacion=:fkIdProgramaFormacion 
                    WHERE idGrupo=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":ficha", $ficha, PDO::PARAM_STR);
            $statement->bindParam(":inicioLectiva", $inicioLectiva, PDO::PARAM_STR);
            $statement->bindParam(":finLectiva", $finLectiva, PDO::PARAM_STR);
            $statement->bindParam(":inicioPractica", $inicioPractica, PDO::PARAM_STR);
            $statement->bindParam(":finPractica", $finPractica, PDO::PARAM_STR);
            $statement->bindParam(":nombreGestor", $nombreGestor, PDO::PARAM_STR);
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