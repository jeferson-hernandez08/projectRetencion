<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE."../models/BaseModel.php";

class CausaModel extends BaseModel {
    public function __construct(
        ?int $idCausa = null,
        ?string $causa = null,
        ?string $variables = null,
        ?string $fkIdCategoria = null
    ) {
        $this->table = "causa";
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveCausa($causa, $variables, $fkIdCategoria) {
        try {
            $sql = "INSERT INTO $this->table (causa, variables, fkIdCategoria) 
                    VALUES (:causa, :variables, :fkIdCategoria)";
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);
            // $causa = $this->causa ?? '';         // Estos datos es opcional
            // $variables = $this->variables ?? '';
            // $fkIdCategoria = $this->fkIdCategoria ?? '';

            // 2. BindParam para sanitizar los datos de entrada
            $statement->bindParam('causa', $causa, PDO::PARAM_STR);
            $statement->bindParam('variables', $variables, PDO::PARAM_STR);
            $statement->bindParam('fkIdCategoria', $fkIdCategoria, PDO::PARAM_INT);

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar la causa: ".$ex->getMessage();
            return false;
        }
    }

    public function getCausa($id) {
        try {
            $sql = "SELECT causa.*, categoria.nombre AS nombreCategoria 
                    FROM causa 
                    INNER JOIN categoria 
                    ON causa.fkIdCategoria = categoria.idCategoria 
                    WHERE causa.idCausa=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result[0]; 
        } catch (PDOException $ex) {
            echo "Error al obtener la causa: " . $ex->getMessage();
            return null;
        }
    }

    public function editCausa($id, $causa, $variables, $fkIdCategoria) {
        try {
            $sql = "UPDATE $this->table SET 
                        causa=:causa, 
                        variables=:variables, 
                        fkIdCategoria=:fkIdCategoria 
                    WHERE idCausa=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":causa", $causa, PDO::PARAM_STR);
            $statement->bindParam(":variables", $variables, PDO::PARAM_STR);
            $statement->bindParam(":fkIdCategoria", $fkIdCategoria, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar la causa: ".$ex->getMessage();
            return false;
        }
    }

    public function removeCausa($id) {
        try {
            $sql = "DELETE FROM $this->table WHERE idCausa=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo eliminar la causa: ".$ex->getMessage();
            return false;
        }
    }

    public function getAll():array {
        try {
            $sql = "SELECT causa.*, categoria.nombre AS nombreCategoria 
                    FROM causa 
                    LEFT JOIN categoria ON causa.fkIdCategoria = categoria.idCategoria";
            $statement = $this->dbConnection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener las causas: " . $ex->getMessage();
            return [];
        }
    }
}