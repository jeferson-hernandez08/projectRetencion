<?php 

// Esta es la clase padre de todos los modelos
namespace APP\Models;     
use PDO;
use PDOException;

abstract class BaseModel {     // Base model es el papa de todos los modelos
    protected $dbConnection;
    protected $table;

    public function __construct()   // cpilot Ejemplo de conexion deconexion en php con PDO.
    {    
        try {
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ];
            $dsn = DRIVER.':host='.HOST.';dbname='.DATABASE;
            $this->dbConnection = new PDO($dsn, USERNAME_DB, PASSWORD_DB, $options);
        } catch (PDOException $ex) {
            echo "Error> ".$ex->getMessage();
        }

    }  // Cierra constructor

    public function getAll():array {

        try {
            $sql = "SELECT * FROM $this->table";
            $statement = $this->dbConnection->query($sql);
            //Obtenemos resultados de la BD en una array asociativo
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            // Devolvemos el array con los datos
            return $result;

        } catch (PDOException $ex) {
            echo "Error en consulta> {$ex->getMessage()}";
            //echo "Error en consulta> ".$ex->getMessage();
            return [];
        }
    }

}

?>
