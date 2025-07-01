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
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);   // Hash de la contraseña
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
            $statement->bindParam('password', $hashedPassword, PDO::PARAM_STR);   // Guardar el hash
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
            // Añadimos hashing de contraseña para editar contraseña
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

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
            $statement->bindParam(":password", $hashedPassword, PDO::PARAM_STR);    // Para editar el hash de la contraseña
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

    public function removeUsuario($id) {
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

    // Función para validar el login del usuario | Para usar o heredar funcion en el controlador de loginController
    public function validarLogin($email, $password){  // Contraseñaque llega del formulario
        $sql = "SELECT * FROM $this->table WHERE email=:email";
        $statement = $this->dbConnection->prepare($sql);
        $statement->bindParam(':email', $email);
        $statement->execute();
        $resultSet = [];
        while($row = $statement->fetch(PDO::FETCH_OBJ)){
            $resultSet [] = $row;
        }

        if(count($resultSet) > 0){
            $hash = $resultSet[0]->password; // Hash guardado en la base de datos
            // Verificar contraseña con hash almacenado
            if(password_verify($password, $hash)){            // password_verify verifica las contraseñas hasheadas y no textto plano 123.
                $_SESSION['id'] = $resultSet[0]->idUsuario;     // ***Veridficar si los datos aqui son exactamente de los de la BD
                $_SESSION['nombre'] = $resultSet[0]->nombre;
                $_SESSION['rol'] = $resultSet[0]->fkIdRol;       // REVISAR ESTO COMO CAPRTURAR EL ROL PARA USAR EN USUARIO
                $_SESSION['timeout'] = time();
                session_regenerate_id();
                return true;
            }
        }
        return false;
    }

    // Funcion para enviar el nombre del Rol a la card de viewReporte.php
    public function getAll():array {
        try {
            $sql = "SELECT usuario.*, rol.nombre AS nombreRol 
                    FROM usuario 
                    LEFT JOIN rol ON usuario.fkIdRol = rol.idRol";
            $statement = $this->dbConnection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener los usuarios: " . $ex->getMessage();
            return [];
        }
    }

}