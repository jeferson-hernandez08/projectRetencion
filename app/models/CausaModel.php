<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE."../models/BaseModel.php";

class CausaModel extends BaseModel {
    public function __construct(
        ?int $idCausa = null,
        ?string $causa = null,
        ?string $variables = null
    ) {
        $this->table = "causa";
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveCausa($causa, $variables) {
        try {
            $sql = "INSERT INTO $this->table (causa, variables) 
                    VALUES (:causa, :variables)";
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);
            // $causa = $this->causa ?? '';         // Estos datos es opcional
            // $variables = $this->variables ?? '';

            // 2. BindParam para sanitizar los datos de entrada
            $statement->bindParam('causa', $causa, PDO::PARAM_STR);
            $statement->bindParam('variables', $variables, PDO::PARAM_STR);

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar la causa> ".$ex->getMessage();
        }
    }

    public function getCausa($id) {
        try {
            $sql = "SELECT * FROM $this->table WHERE idCausa=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result[0]; 
        } catch (PDOException $ex) {
            echo "Error al obtener la causa" . $ex->getMessage();
        }
    }

    public function editCausa($id, $causa, $variables) {
        try {
            $sql = "UPDATE $this->table SET 
                        causa=:causa, 
                        variables=:variables 
                    WHERE idCausa=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":causa", $causa, PDO::PARAM_STR);
            $statement->bindParam(":variables", $variables, PDO::PARAM_STR);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar la causa".$ex->getMessage();
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
            echo "No se pudo eliminar la causa".$ex->getMessage();
        }
    }
}