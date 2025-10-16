<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE."../models/BaseModel.php";

class IntervencionModel extends BaseModel {
    public function __construct(
        ?int $idIntervencion = null,
        ?string $fechaCreacion = null,
        ?string $descripcion = null,
        ?string $fkIdEstrategias = null,
        ?string $fkIdReporte = null,
        ?string $fkIdUsuario = null
    ) {
        $this->table = "interventions";  // Cambiado de "intervencion" a "interventions" para PostgreSQL
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveIntervencion( $descripcion, $fkIdEstrategias, $fkIdReporte, $fkIdUsuario) {   // Eliminamos la variable $fechaCreacion, para generacion automatica
        try {
            // Generar fecha automática | Colombia - Similar a ReporteModel
            date_default_timezone_set('America/Bogota');
            $fechaCreacion = date('Y-m-d H:i:s');
            $fechaActual = date('Y-m-d H:i:s'); // Para createdAt y updatedAt

            // CONSULTA ADAPTADA para PostgreSQL con nombres de columnas en inglés
            // Se usa NOW() para las fechas automáticas de PostgreSQL
            $sql = "INSERT INTO $this->table (\"creationDate\", description, \"fkIdStrategies\", \"fkIdReports\", \"fkIdUsers\", \"createdAt\", \"updatedAt\") 
                    VALUES (:creationDate, :description, :fkIdStrategies, :fkIdReports, :fkIdUsers, :createdAt, :updatedAt)";
                    
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);

            // 2. BindParam para sanitizar los datos de entrada - NOMBRES ADAPTADOS
            $statement->bindParam('creationDate', $fechaCreacion, PDO::PARAM_STR);
            $statement->bindParam('description', $descripcion, PDO::PARAM_STR);
            $statement->bindParam('fkIdStrategies', $fkIdEstrategias, PDO::PARAM_INT);
            $statement->bindParam('fkIdReports', $fkIdReporte, PDO::PARAM_INT);
            $statement->bindParam('fkIdUsers', $fkIdUsuario, PDO::PARAM_INT);
            $statement->bindParam('createdAt', $fechaActual, PDO::PARAM_STR);
            $statement->bindParam('updatedAt', $fechaActual, PDO::PARAM_STR);

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar la intervención: ".$ex->getMessage();
            return false;
        }
    }

    public function getIntervencion($id) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de tablas y columnas actualizados
            $sql = "SELECT interventions.*, strategies.strategy AS \"nombreEstrategia\", 
                    reports.description AS \"descripcionReporte\", 
                    CONCAT(users.\"firstName\", ' ', users.\"lastName\") AS \"nombreUsuario\"
                    FROM interventions 
                    INNER JOIN strategies ON interventions.\"fkIdStrategies\" = strategies.id
                    INNER JOIN reports ON interventions.\"fkIdReports\" = reports.id
                    INNER JOIN users ON interventions.\"fkIdUsers\" = users.id
                    WHERE interventions.id = :id";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result[0]; 
        } catch (PDOException $ex) {
            echo "Error al obtener la intervención: " . $ex->getMessage();
            return null;
        }
    }

    public function editIntervencion($id, $descripcion, $fkIdEstrategias, $fkIdReporte, $fkIdUsuario) {  // Se elimina $fechaCreacion, fecha automática.
        try {
            // Generar fecha actual | Colombia - Similar a ReporteModel
            date_default_timezone_set('America/Bogota');
            $fechaActual = date('Y-m-d H:i:s');

            // CONSULTA ADAPTADA para PostgreSQL - nombres de columnas actualizados
            $sql = "UPDATE $this->table SET  
                        description = :description, 
                        \"fkIdStrategies\" = :fkIdStrategies, 
                        \"fkIdReports\" = :fkIdReports, 
                        \"fkIdUsers\" = :fkIdUsers,
                        \"updatedAt\" = :updatedAt 
                    WHERE id = :id";       // Se elimina fechaCreacion=:fechaCreacion, para fecha automática.
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            //$statement->bindParam(":fechaCreacion", $fechaCreacion, PDO::PARAM_STR);
            $statement->bindParam(":description", $descripcion, PDO::PARAM_STR);
            $statement->bindParam(":fkIdStrategies", $fkIdEstrategias, PDO::PARAM_INT);
            $statement->bindParam(":fkIdReports", $fkIdReporte, PDO::PARAM_INT);
            $statement->bindParam(":fkIdUsers", $fkIdUsuario, PDO::PARAM_INT);
            $statement->bindParam(":updatedAt", $fechaActual, PDO::PARAM_STR);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar la intervención: ".$ex->getMessage();
            return false;
        }
    }

    public function removeIntervencion($id) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombre de columna cambiado
            $sql = "DELETE FROM $this->table WHERE id = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo eliminar la intervención: ".$ex->getMessage();
            return false;
        }
    }

    // Funcion getByReporteId para ver intervencion de dicho reporte o aprendiz | Y enviar a funcion intervenciones() en reporte controller
    public function getByReporteId($idReporte) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de tablas y columnas actualizados
            $sql = "SELECT interventions.*, strategies.strategy AS \"nombreEstrategia\", 
                    CONCAT(users.\"firstName\", ' ', users.\"lastName\") AS \"nombreUsuario\"
                    FROM interventions 
                    INNER JOIN strategies ON interventions.\"fkIdStrategies\" = strategies.id
                    INNER JOIN users ON interventions.\"fkIdUsers\" = users.id
                    WHERE interventions.\"fkIdReports\" = :idReporte
                    ORDER BY interventions.\"creationDate\" DESC";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":idReporte", $idReporte, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener las intervenciones: " . $ex->getMessage();
            return [];
        }
    }

    /**
     * Método para obtener intervenciones por usuario
     * @param int $idUsuario ID del usuario
     * @return array Array de intervenciones realizadas por el usuario
     */
    public function getIntervencionesPorUsuario($idUsuario) {
        try {
            $sql = "SELECT interventions.*, strategies.strategy AS nombreEstrategia,
                    reports.description AS descripcionReporte,
                    CONCAT(apprentices.firtsName, ' ', apprentices.lastName) AS nombreAprendiz
                    FROM interventions 
                    INNER JOIN strategies ON interventions.fkIdStrategies = strategies.id
                    INNER JOIN reports ON interventions.fkIdReports = reports.id
                    INNER JOIN apprentices ON reports.fkIdApprentices = apprentices.id
                    WHERE interventions.fkIdUsers = :idUsuario
                    ORDER BY interventions.creationDate DESC";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al obtener intervenciones por usuario: " . $ex->getMessage());
            return [];
        }
    }

    /**
     * Método para contar intervenciones por reporte
     * @param int $idReporte ID del reporte
     * @return int Número de intervenciones para el reporte
     */
    public function contarIntervencionesPorReporte($idReporte) {
        try {
            $sql = "SELECT COUNT(*) as total FROM interventions WHERE fkIdReports = :idReporte";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":idReporte", $idReporte, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_OBJ);
            return $result->total;
        } catch (PDOException $ex) {
            error_log("Error al contar intervenciones por reporte: " . $ex->getMessage());
            return 0;
        }
    }

    /**
     * Método para obtener la última intervención de un reporte
     * @param int $idReporte ID del reporte
     * @return mixed Última intervención o null si no existe
     */
    public function getUltimaIntervencion($idReporte) {
        try {
            $sql = "SELECT interventions.*, 
                    CONCAT(users.firstName, ' ', users.lastName) AS nombreUsuario,
                    strategies.strategy AS nombreEstrategia
                    FROM interventions 
                    INNER JOIN users ON interventions.fkIdUsers = users.id
                    INNER JOIN strategies ON interventions.fkIdStrategies = strategies.id
                    WHERE interventions.fkIdReports = :idReporte
                    ORDER BY interventions.creationDate DESC
                    LIMIT 1";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":idReporte", $idReporte, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return count($result) > 0 ? $result[0] : null;
        } catch (PDOException $ex) {
            error_log("Error al obtener última intervención: " . $ex->getMessage());
            return null;
        }
    }

}