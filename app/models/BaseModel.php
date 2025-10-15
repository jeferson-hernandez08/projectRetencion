<?php 

// Esta es la clase padre de todos los modelos
namespace APP\Models;     
use PDO;
use PDOException;

abstract class BaseModel {     // Base model es el padre de todos los modelos
    protected $dbConnection;
    protected $table;

    public function __construct()   
    {    
        try {
            // Configuración de opciones para PDO
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                // Para PostgreSQL, configuramos el charset en el DSN
            ];
            
            // DSN para PostgreSQL - Formato diferente al de MySQL
            $dsn = DRIVER . ':host=' . HOST . 
                   ';port=' . PORT . 
                   ';dbname=' . DATABASE . 
                   ';sslmode=require';  // SSL requerido por Render
            
            // Crear conexión PDO a PostgreSQL
            $this->dbConnection = new PDO($dsn, USERNAME_DB, PASSWORD_DB, $options);
            
            // Configurar encoding CORREGIDO para PostgreSQL
            $this->dbConnection->exec("SET client_encoding TO 'UTF8'");
            
        } catch (PDOException $ex) {
            echo "Error de conexión a la base de datos: " . $ex->getMessage();
            // En producción, considera loggear este error en lugar de mostrarlo
        }

    }

    /**
     * Obtiene todos los registros de la tabla
     * @return array Array de objetos con los resultados
     */
    public function getAll():array {
        try {
            $sql = "SELECT * FROM {$this->table}"; 
            $statement = $this->dbConnection->query($sql);
            
            // Obtenemos resultados de la BD en un array asociativo
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            
            return $result;

        } catch (PDOException $ex) {
            echo "Error en consulta: {$ex->getMessage()}";
            return [];
        }
    }

    /**
     * Método genérico para ejecutar consultas preparadas
     * Útil para INSERT, UPDATE, DELETE
     */
    protected function executeQuery(string $sql, array $params = []): bool {
        try {
            $statement = $this->dbConnection->prepare($sql);
            return $statement->execute($params);
        } catch (PDOException $ex) {
            echo "Error en consulta ejecutada: {$ex->getMessage()}";
            return false;
        }
    }

    /**
     * Método para obtener registros con condiciones
     */
    protected function fetchAll(string $sql, array $params = []): array {
        try {
            $statement = $this->dbConnection->prepare($sql);
            $statement->execute($params);
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error en consulta fetch: {$ex->getMessage()}";
            return [];
        }
    }

    /**
     * Método para obtener un solo registro
     */
    protected function fetchOne(string $sql, array $params = []) {
        try {
            $statement = $this->dbConnection->prepare($sql);
            $statement->execute($params);
            return $statement->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error en consulta fetchOne: {$ex->getMessage()}";
            return null;
        }
    }

}

?>