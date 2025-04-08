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
        $this->table = "estrategias";
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveEstrategias($estrategia, $fkIdCategoria) {
        try {
            $sql = "INSERT INTO $this->table (estrategia, fkIdCategoria) 
                    VALUES (:estrategia, :fkIdCategoria)";
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);
            // $estrategia = $this->estrategia ?? '';         // Estos datos es opcional
            // $fkIdCategoria = $this->fkIdCategoria ?? '';

            // 2. BindParam para sanitizar los datos de entrada
            $statement->bindParam('estrategia', $estrategia, PDO::PARAM_STR);
            $statement->bindParam('fkIdCategoria', $fkIdCategoria, PDO::PARAM_INT);

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar la estrategia> ".$ex->getMessage();
        }
    }

    public function getEstrategias($id) {
        try {
            $sql = "SELECT estrategias.*, categoria.nombre AS nombreCategoria 
                    FROM estrategias 
                    INNER JOIN categoria 
                    ON estrategias.fkIdCategoria = categoria.idCategoria 
                    WHERE estrategias.idEstrategias=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result[0]; 
        } catch (PDOException $ex) {
            echo "Error al obtener la estrategia" . $ex->getMessage();
        }
    }

    public function editEstrategias($id, $estrategia, $fkIdCategoria) {
        try {
            $sql = "UPDATE $this->table SET 
                        estrategia=:estrategia, 
                        fkIdCategoria=:fkIdCategoria 
                    WHERE idEstrategias=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":estrategia", $estrategia, PDO::PARAM_STR);
            $statement->bindParam(":fkIdCategoria", $fkIdCategoria, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar la estrategia".$ex->getMessage();
        }
    }

    public function deleteEstrategias($id) {
        try {
            $sql = "DELETE FROM $this->table WHERE idEstrategias=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo eliminar la estrategia".$ex->getMessage();
        }
    }
}