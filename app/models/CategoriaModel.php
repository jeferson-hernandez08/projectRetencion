<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE."../models/BaseModel.php";

class CategoriaModel extends BaseModel {
    public function __construct(
        ?int $idCategoria = null,
        ?string $nombre = null,
        ?string $descripcion = null,
        ?string $direccionamiento = null,
        ?string $fkIdCausa = null
    ) {
        $this->table = "categoria";
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveCategoria($nombre, $descripcion, $direccionamiento, $fkIdCausa) {
        try {
            $sql = "INSERT INTO $this->table (nombre, descripcion, direccionamiento, fkIdCausa) 
                    VALUES (:nombre, :descripcion, :direccionamiento, :fkIdCausa)";
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);
            // $nombre = $this->nombre ?? '';         // Estos datos es opcional
            // $descripcion = $this->descripcion ?? '';
            // $direccionamiento = $this->direccionamiento ?? '';
            // $fkIdCausa = $this->fkIdCausa ?? '';

            // 2. BindParam para sanitizar los datos de entrada
            $statement->bindParam('nombre', $nombre, PDO::PARAM_STR);
            $statement->bindParam('descripcion', $descripcion, PDO::PARAM_STR);
            $statement->bindParam('direccionamiento', $direccionamiento, PDO::PARAM_STR);
            $statement->bindParam('fkIdCausa', $fkIdCausa, PDO::PARAM_INT);

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar la categoría> ".$ex->getMessage();
        }
    }

    public function getCategoria($id) {
        try {
            $sql = "SELECT categoria.*, causa.nombre AS nombreCausa 
                    FROM categoria 
                    INNER JOIN causa 
                    ON categoria.fkIdCausa = causa.idCausa 
                    WHERE categoria.idCategoria=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result[0]; 
        } catch (PDOException $ex) {
            echo "Error al obtener la categoría" . $ex->getMessage();
        }
    }

    public function editCategoria($id, $nombre, $descripcion, $direccionamiento, $fkIdCausa) {
        try {
            $sql = "UPDATE $this->table SET 
                        nombre=:nombre, 
                        descripcion=:descripcion, 
                        direccionamiento=:direccionamiento, 
                        fkIdCausa=:fkIdCausa 
                    WHERE idCategoria=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $statement->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $statement->bindParam(":direccionamiento", $direccionamiento, PDO::PARAM_STR);
            $statement->bindParam(":fkIdCausa", $fkIdCausa, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar la categoría".$ex->getMessage();
        }
    }

    public function deleteCategoria($id) {
        try {
            $sql = "DELETE FROM $this->table WHERE idCategoria=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo eliminar la categoría".$ex->getMessage();
        }
    }
}