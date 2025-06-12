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
                // Agregamos esta línea para forzar UTF-8: | Para que la base de datos se conecte con el charset utf8mb4
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'"
            ];
            // Agregamos charset aquí charset=utf8mb4 | Soporta caracteres especiales y emojis      
            $dsn = DRIVER.':host='.HOST.';dbname='.DATABASE.';charset=utf8mb4';    //  utf8mb4: Soporta el 100% de caracteres Unicode.
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
