<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE."../models/BaseModel.php";

class UsuarioModel extends BaseModel {
    public function __construct(
        ?int $idUsuario = null,
        ?string $nombres = null,
        ?string $apellidos = null,
        ?string $documento = null,
        ?string $email = null,
        ?string $password = null,
        ?string $telefono = null,
        ?string $tipoCoordinador = null,
        ?string $gestor = null,
        ?string $fkIdRol = null
    ) {
        $this->table = "users";  // Cambiado de "usuario" a "users" para PostgreSQL
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveUsuario($nombres, $apellidos, $documento, $email, $password, $telefono, $tipoCoordinador, $gestor, $fkIdRol) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);   // Hash de la contraseña
            
            // CONSULTA ADAPTADA para PostgreSQL con nombres de columnas en inglés
            // Se incluyen passwordResetToken y passwordResetExpires con valores NULL por defecto
            $sql = "INSERT INTO $this->table (\"firstName\", \"lastName\", \"document\", \"email\", \"password\", \"phone\", \"coordinadorType\", \"manager\", \"fkIdRols\", \"passwordResetToken\", \"passwordResetExpires\", \"createdAt\", \"updatedAt\") 
                    VALUES (:firstName, :lastName, :document, :email, :password, :phone, :coordinadorType, :manager, :fkIdRols, NULL, NULL, NOW(), NOW())";
            
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);

            // 2. BindParam para sanitizar los datos de entrada - NOMBRES ADAPTADOS
            $statement->bindParam('firstName', $nombres, PDO::PARAM_STR);
            $statement->bindParam('lastName', $apellidos, PDO::PARAM_STR);
            $statement->bindParam('document', $documento, PDO::PARAM_STR);
            $statement->bindParam('email', $email, PDO::PARAM_STR);
            $statement->bindParam('password', $hashedPassword, PDO::PARAM_STR);   // Guardar el hash
            $statement->bindParam('phone', $telefono, PDO::PARAM_STR);
            $statement->bindParam('coordinadorType', $tipoCoordinador, PDO::PARAM_STR);
            
            // Convertir gestor (string) a booleano para PostgreSQL
            $gestorBoolean = ($gestor == '1' || $gestor === true) ? true : false;
            $statement->bindParam('manager', $gestorBoolean, PDO::PARAM_BOOL);
            
            $statement->bindParam('fkIdRols', $fkIdRol, PDO::PARAM_INT);

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar el usuario> ".$ex->getMessage();
            return false;
        }
    }

    public function getUsuario($id) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - unión con tabla 'rols' (no 'rol')
            $sql = "SELECT users.*, rols.name AS \"nombreRol\" 
                    FROM users 
                    INNER JOIN rols 
                    ON users.\"fkIdRols\" = rols.id 
                    WHERE users.id = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result[0]; 
        } catch (PDOException $ex) {
            echo "Error al obtener el usuario: " . $ex->getMessage();
            return null;
        }
    }

    public function editUsuario($id, $nombres, $apellidos, $documento, $email, $password, $telefono, $tipoCoordinador, $gestor, $fkIdRol) {
        try {
            // Añadimos hashing de contraseña para editar contraseña
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // CONSULTA ADAPTADA para PostgreSQL
            $sql = "UPDATE $this->table SET 
                        \"firstName\" = :firstName, 
                        \"lastName\" = :lastName, 
                        \"document\" = :document, 
                        \"email\" = :email, 
                        \"password\" = :password, 
                        \"phone\" = :phone, 
                        \"coordinadorType\" = :coordinadorType, 
                        \"manager\" = :manager, 
                        \"fkIdRols\" = :fkIdRols,
                        \"updatedAt\" = NOW() 
                    WHERE id = :id";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":firstName", $nombres, PDO::PARAM_STR);
            $statement->bindParam(":lastName", $apellidos, PDO::PARAM_STR);
            $statement->bindParam(":document", $documento, PDO::PARAM_STR);
            $statement->bindParam(":email", $email, PDO::PARAM_STR);
            $statement->bindParam(":password", $hashedPassword, PDO::PARAM_STR);    // Para editar el hash de la contraseña
            $statement->bindParam(":phone", $telefono, PDO::PARAM_STR);
            $statement->bindParam(":coordinadorType", $tipoCoordinador, PDO::PARAM_STR);
            
            // Convertir gestor a booleano
            $gestorBoolean = ($gestor == '1' || $gestor === true) ? true : false;
            $statement->bindParam(":manager", $gestorBoolean, PDO::PARAM_BOOL);
            
            $statement->bindParam(":fkIdRols", $fkIdRol, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar el usuario: ".$ex->getMessage();
            return false;
        }
    }

    public function removeUsuario($id) {
        try {
            $sql = "DELETE FROM $this->table WHERE id = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo eliminar el usuario: ".$ex->getMessage();
            return false;
        }
    }

    // Función para validar el login del usuario | Para usar o heredar funcion en el controlador de loginController
    public function validarLogin($email, $password){  // Contraseña que llega del formulario
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de columnas en inglés
            $sql = "SELECT * FROM $this->table WHERE email = :email";
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
                if(password_verify($password, $hash)){            // password_verify verifica las contraseñas hasheadas y no texto plano 123.
                    // VARIABLES DE SESIÓN ACTUALIZADAS con nombres de PostgreSQL
                    $_SESSION['id'] = $resultSet[0]->id;                    // Cambiado de idUsuario a id
                    $_SESSION['nombres'] = $resultSet[0]->firstName;        // Cambiado de nombres a firstName
                    $_SESSION['apellidos'] = $resultSet[0]->lastName;       // Cambiado de apellidos a lastName
                    $_SESSION['nombre'] = $resultSet[0]->firstName . ' ' . $resultSet[0]->lastName; // Nombre completo
                    $_SESSION['rol'] = $resultSet[0]->{"fkIdRols"};             // Cambiado de fkIdRol a fkIdRols
                    $_SESSION['timeout'] = time();
                    session_regenerate_id();
                    return true;
                }
            }
            return false;
        } catch (PDOException $ex) {
            error_log("Error en validarLogin: " . $ex->getMessage());
            return false;
        }
    }

    // Funcion para enviar el nombre del Rol a la card de viewReporte.php
    public function getAll():array {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - unión con tabla 'rols'
            $sql = "SELECT users.*, rols.name AS \"nombreRol\" 
                    FROM users 
                    LEFT JOIN rols ON users.\"fkIdRols\" = rols.id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al obtener los usuarios: " . $ex->getMessage());
            return [];
        }
    }

    // Funcion para verificar importacion excel que no este repetido
    public function getUsuarioPorEmail($email) {
        try {
            $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
            $stmt = $this->dbConnection->prepare($sql);
            $stmt->execute([$email]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log("Error en getUsuarioPorEmail: " . $e->getMessage());
            return false;
        }
    }

    // =========================================================================
    // NUEVOS MÉTODOS PARA RECUPERACIÓN DE CONTRASEÑA
    // =========================================================================

    /**
     * Método para guardar el token de recuperación de contraseña
     * @param string $email Email del usuario
     * @param string $token Token generado para recuperación
     * @param string $expiry Fecha de expiración del token (formato PostgreSQL)
     * @return bool True si se actualizó correctamente
     */
    public function guardarTokenRecuperacion($email, $token, $expiry) {
        try {
            $sql = "UPDATE $this->table 
                    SET passwordResetToken = :token, 
                        passwordResetExpires = :expiry,
                        updatedAt = NOW()
                    WHERE email = :email";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":token", $token, PDO::PARAM_STR);
            $statement->bindParam(":expiry", $expiry, PDO::PARAM_STR);
            $statement->bindParam(":email", $email, PDO::PARAM_STR);
            
            return $statement->execute();
        } catch (PDOException $ex) {
            error_log("Error al guardar token de recuperación: " . $ex->getMessage());
            return false;
        }
    }

    /**
     * Método para buscar usuario por token de recuperación válido
     * @param string $token Token de recuperación
     * @return mixed Usuario si el token es válido, false si no
     */
    public function buscarPorToken($token) {
        try {
            $sql = "SELECT * FROM $this->table 
                    WHERE passwordResetToken = :token 
                    AND passwordResetExpires > NOW()";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":token", $token, PDO::PARAM_STR);
            $statement->execute();
            
            return $statement->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al buscar por token: " . $ex->getMessage());
            return false;
        }
    }

    /**
     * Método para actualizar contraseña y limpiar token
     * @param int $id ID del usuario
     * @param string $newPassword Nueva contraseña hasheada
     * @return bool True si se actualizó correctamente
     */
    public function actualizarPassword($id, $newPassword) {
        try {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            
            $sql = "UPDATE $this->table 
                    SET password = :password,
                        passwordResetToken = NULL,
                        passwordResetExpires = NULL,
                        updatedAt = NOW()
                    WHERE id = :id";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            
            return $statement->execute();
        } catch (PDOException $ex) {
            error_log("Error al actualizar password: " . $ex->getMessage());
            return false;
        }
    }

    /**
     * Método para limpiar token de recuperación (por si expira)
     * @param string $email Email del usuario
     * @return bool True si se limpió correctamente
     */
    public function limpiarToken($email) {
        try {
            $sql = "UPDATE $this->table 
                    SET passwordResetToken = NULL,
                        passwordResetExpires = NULL,
                        updatedAt = NOW()
                    WHERE email = :email";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":email", $email, PDO::PARAM_STR);
            
            return $statement->execute();
        } catch (PDOException $ex) {
            error_log("Error al limpiar token: " . $ex->getMessage());
            return false;
        }
    }

    // Funcion para crear notificación al crear un reporte
    // public function getUsuariosByRol($roles) {
    //     if (empty($roles)) return [];
        
    //     $placeholders = implode(',', array_fill(0, count($roles), '?'));
    //     $sql = "SELECT * FROM users WHERE fkIdRols IN ($placeholders)";
    //     $stmt = $this->dbConnection->prepare($sql);
        
    //     // Bindear cada valor individualmente
    //     foreach ($roles as $k => $rol) {
    //         $stmt->bindValue($k+1, $rol, PDO::PARAM_INT);
    //     }
        
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_OBJ);
    // }

        // =========================================================================
    // MÉTODOS PARA RECUPERACIÓN DE CONTRASEÑA - ACTUALIZADOS
    // =========================================================================

    /**
     * Método para buscar usuario por email y documento
     * @param string $email Email institucional
     * @param string $document Número de documento
     * @return mixed Usuario si existe, false si no
     */
    public function buscarPorEmailYDocumento($email, $document) {
        try {
            $sql = "SELECT * FROM $this->table 
                    WHERE email = :email 
                    AND document = :document 
                    LIMIT 1";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":email", $email, PDO::PARAM_STR);
            $statement->bindParam(":document", $document, PDO::PARAM_STR);
            $statement->execute();
            
            return $statement->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al buscar por email y documento: " . $ex->getMessage());
            return false;
        }
    }

    /**
     * Método para actualizar contraseña directamente
     * @param string $email Email del usuario
     * @param string $newPassword Nueva contraseña hasheada
     * @return bool True si se actualizó correctamente
     */
    public function actualizarPasswordPorEmail($email, $newPassword) {
        try {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            
            $sql = "UPDATE $this->table 
                    SET password = :password,
                        updatedAt = NOW()
                    WHERE email = :email";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
            $statement->bindParam(":email", $email, PDO::PARAM_STR);
            
            return $statement->execute();
        } catch (PDOException $ex) {
            error_log("Error al actualizar password por email: " . $ex->getMessage());
            return false;
        }
    }

    /**
     * Método para generar contraseña aleatoria segura
     * @param int $length Longitud de la contraseña (por defecto 10)
     * @return string Contraseña generada
     */
    public function generarPasswordAleatoria($length = 10) {
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $special = '!@#$%&*';
        
        // Aseguramos al menos un carácter de cada tipo
        $password = $uppercase[rand(0, strlen($uppercase) - 1)];
        $password .= $lowercase[rand(0, strlen($lowercase) - 1)];
        $password .= $numbers[rand(0, strlen($numbers) - 1)];
        $password .= $special[rand(0, strlen($special) - 1)];
        
        // Completamos el resto de la longitud
        $allCharacters = $uppercase . $lowercase . $numbers . $special;
        for ($i = 4; $i < $length; $i++) {
            $password .= $allCharacters[rand(0, strlen($allCharacters) - 1)];
        }
        
        // Mezclamos la contraseña para que no sea predecible
        return str_shuffle($password);
    }


}