<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE . "../models/BaseModel.php";

class GestorModel extends BaseModel {
    public function __construct(
        ?int $idGestor = null,
        ?string $nombreCompleto = null,
        ?string $centroAcademico = null,
        ?string $email = null,
        ?string $telefono = null,
        ?string $competencias = null
    ) {
        $this->table = "gestor"; // Nombre de la tabla en la base de datos
        // Se llama al constructor del padre
        parent::__construct();
    }

    /**
     * Guarda un nuevo gestor en la base de datos.
     */
    public function saveGestor($nombreCompleto, $centroAcademico, $email, $telefono, $competencias) {
        try {
            $sql = "INSERT INTO $this->table (nombreCompleto, centroAcademico, email, telefono, competencias) 
                    VALUES (:nombreCompleto, :centroAcademico, :email, :telefono, :competencias)";
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);

            // 2. BindParam para sanitizar los datos de entrada
            $statement->bindParam('nombreCompleto', $nombreCompleto, PDO::PARAM_STR);
            $statement->bindParam('centroAcademico', $centroAcademico, PDO::PARAM_STR);
            $statement->bindParam('email', $email, PDO::PARAM_STR);
            $statement->bindParam('telefono', $telefono, PDO::PARAM_STR);
            $statement->bindParam('competencias', $competencias, PDO::PARAM_STR);

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar el gestor: " . $ex->getMessage();
        }
    }

    /**
     * Obtiene un gestor por su ID.
     */
    public function getGestor($idGestor) {
        try {
            $sql = "SELECT * FROM $this->table WHERE idGestor = :idGestor";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":idGestor", $idGestor, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result[0]; // Retorna el primer resultado
        } catch (PDOException $ex) {
            echo "Error al obtener el gestor: " . $ex->getMessage();
        }
    }

    /**
     * Edita un gestor existente.
     */
    public function editGestor($idGestor, $nombreCompleto, $centroAcademico, $email, $telefono, $competencias) {
        try {
            $sql = "UPDATE $this->table 
                    SET nombreCompleto = :nombreCompleto, 
                        centroAcademico = :centroAcademico, 
                        email = :email, 
                        telefono = :telefono, 
                        competencias = :competencias 
                    WHERE idGestor = :idGestor";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":idGestor", $idGestor, PDO::PARAM_INT);
            $statement->bindParam(":nombreCompleto", $nombreCompleto, PDO::PARAM_STR);
            $statement->bindParam(":centroAcademico", $centroAcademico, PDO::PARAM_STR);
            $statement->bindParam(":email", $email, PDO::PARAM_STR);
            $statement->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $statement->bindParam(":competencias", $competencias, PDO::PARAM_STR);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al editar el gestor: " . $ex->getMessage();
        }
    }

    /**
     * Elimina un gestor por su ID.
     */
    public function deleteGestor($idGestor) {
        try {
            $sql = "DELETE FROM $this->table WHERE idGestor = :idGestor";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":idGestor", $idGestor, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al eliminar el gestor: " . $ex->getMessage();
        }
    }
}