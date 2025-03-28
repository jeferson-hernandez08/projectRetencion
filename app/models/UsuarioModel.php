<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE."../models/BaseModel.php";

class UsuarioModel extends BaseModel {
    public function __construct(
        ?int $idUsuario = null,
        ?string $nombre = null,
        ?string $email = null,
        ?string $password = null,
        ?string $telefono = null,
        ?string $tipoCoordinador = null,
        ?string $gestor = null,
        ?string $fkIdRol = null
    ) {
        $this->table = "usuario";
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveUsuario($nombre, $email, $password, $telefono, $tipoCoordinador, $gestor, $fkIdRol) {
        try {
            $sql = "INSERT INTO $this->table (nombre, email, password, telefono, tipoCoordinador, gestor, fkIdRol) 
                    VALUES (:nombre, :email, :password, :telefono, :tipoCoordinador, :gestor, :fkIdRol)";
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);
            // $nombre = $this->nombre ?? '';         // Estos datos es opcional
            // $email = $this->email ?? '';
            // $password = $this->password ?? '';
            // $telefono = $this->telefono ?? '';
            // $tipoCoordinador = $this->tipoCoordinador ?? '';
            // $gestor = $this->gestor ?? '';
            // $fkIdRol = $this->fkIdRol ?? '';

            // 2. BindParam para sanitizar los datos de entrada
            $statement->bindParam('nombre', $nombre, PDO::PARAM_STR);
            $statement->bindParam('email', $email, PDO::PARAM_STR);
            $statement->bindParam('password', $password, PDO::PARAM_STR);
            $statement->bindParam('telefono', $telefono, PDO::PARAM_STR);
            $statement->bindParam('tipoCoordinador', $tipoCoordinador, PDO::PARAM_STR);
            $statement->bindParam('gestor', $gestor, PDO::PARAM_STR);
            $statement->bindParam('fkIdRol', $fkIdRol, PDO::PARAM_INT);

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar el usuario> ".$ex->getMessage();
        }
    }

    public function getUsuario($id) {
        try {
            $sql = "SELECT usuario.*, rol.nombre AS nombreRol 
                    FROM usuario 
                    INNER JOIN rol 
                    ON usuario.fkIdRol = rol.idRol 
                    WHERE usuario.idUsuario=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result[0]; 
        } catch (PDOException $ex) {
            echo "Error al obtener el usuario" . $ex->getMessage();
        }
    }

    public function editUsuario($id, $nombre, $email, $password, $telefono, $tipoCoordinador, $gestor, $fkIdRol) {
        try {
            $sql = "UPDATE $this->table SET 
                        nombre=:nombre, 
                        email=:email, 
                        password=:password, 
                        telefono=:telefono, 
                        tipoCoordinador=:tipoCoordinador, 
                        gestor=:gestor, 
                        fkIdRol=:fkIdRol 
                    WHERE idUsuario=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $statement->bindParam(":email", $email, PDO::PARAM_STR);
            $statement->bindParam(":password", $password, PDO::PARAM_STR);
            $statement->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $statement->bindParam(":tipoCoordinador", $tipoCoordinador, PDO::PARAM_STR);
            $statement->bindParam(":gestor", $gestor, PDO::PARAM_STR);
            $statement->bindParam(":fkIdRol", $fkIdRol, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar el usuario".$ex->getMessage();
        }
    }

    public function deleteUsuario($id) {
        try {
            $sql = "DELETE FROM $this->table WHERE idUsuario=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo eliminar el usuario".$ex->getMessage();
        }
    }
}