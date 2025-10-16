<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE."../models/BaseModel.php";

class ReporteModel extends BaseModel {
    public function __construct(
        ?int $idReporte = null,
        ?string $fechaCreacion = null,
        ?string $descripcion = null,
        ?string $direccionamiento = null,
        ?string $estado = null,
        ?string $fkIdAprendiz = null,
        ?string $fkIdUsuario = null
    ) {
        $this->table = "reports";  // Cambiado de "reporte" a "reports" para PostgreSQL
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveReporte($descripcion, $direccionamiento, $estado, $fkIdAprendiz, $fkIdUsuario) {   // Eliminamos la variable $fechaCreacion, para generacion automatica
        try {
            // Forzar estado "Registrado" al crear
            $estado = "Registrado"; // <-- Aseguramos el valor fijo del campo registrado, usuario mayor interactividad.

            // Generar fecha automática | Colombia 
            date_default_timezone_set('America/Bogota');
            $fechaCreacion = date('Y-m-d H:i:s');
            $fechaActual = date('Y-m-d H:i:s'); // Para createdAt y updatedAt

            // CONSULTA ADAPTADA para PostgreSQL con nombres de columnas en inglés
            // Se usa NOW() para las fechas automáticas de PostgreSQL
            $sql = "INSERT INTO $this->table (\"creationDate\", description, addressing, state, \"fkIdApprentices\", \"fkIdUsers\", \"createdAt\", \"updatedAt\") 
                    VALUES (:creationDate, :description, :addressing, :state, :fkIdApprentices, :fkIdUsers, :createdAt, :updatedAt)";
                    
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);

            // 2. BindParam para sanitizar los datos de entrada - NOMBRES ADAPTADOS
            $statement->bindParam('creationDate', $fechaCreacion, PDO::PARAM_STR);
            $statement->bindParam('description', $descripcion, PDO::PARAM_STR);
            $statement->bindParam('addressing', $direccionamiento, PDO::PARAM_STR);
            $statement->bindParam('state', $estado, PDO::PARAM_STR);
            $statement->bindParam('fkIdApprentices', $fkIdAprendiz, PDO::PARAM_INT);
            $statement->bindParam('fkIdUsers', $fkIdUsuario, PDO::PARAM_INT);
            $statement->bindParam('createdAt', $fechaActual, PDO::PARAM_STR);
            $statement->bindParam('updatedAt', $fechaActual, PDO::PARAM_STR);

            // 3. Ejecutar la consulta
            // $result = $statement->execute();
            // return $result;
            return $statement->execute();    // SE CAMBIA ESTO  
        } catch (PDOException $ex) {
            echo "Error al guardar el reporte> ".$ex->getMessage();
            return false;
        }
    }

    public function getReporte($id) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de tablas y columnas actualizados
            // Se usa CONCAT de PostgreSQL y nombres de tablas en inglés
            $sql = "SELECT reports.*, 
                        CONCAT(users.\"firstName\", ' ', users.\"lastName\") AS \"nombreUsuario\", 
                        CONCAT(apprentices.\"firtsName\", ' ', apprentices.\"lastName\") AS \"nombreAprendiz\" 
                    FROM reports 
                    INNER JOIN users 
                    ON reports.\"fkIdUsers\" = users.id 
                    INNER JOIN apprentices
                    ON reports.\"fkIdApprentices\" = apprentices.id
                    WHERE reports.id = :id";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result[0]; 
        } catch (PDOException $ex) {
            echo "Error al obtener el reporte: " . $ex->getMessage();
            return null;
        }
    }

    public function editReporte($id, $descripcion, $direccionamiento, $estado, $fkIdAprendiz, $fkIdUsuario) {  // Se elimina $fechaCreacion, fecha automática.
        try {
            // Generar fecha actual | Colombia
            date_default_timezone_set('America/Bogota');
            $fechaActual = date('Y-m-d H:i:s');

            // CONSULTA ADAPTADA para PostgreSQL - nombres de columnas actualizados
            $sql = "UPDATE $this->table SET 
                        description = :description, 
                        addressing = :addressing, 
                        state = :state, 
                        \"fkIdApprentices\" = :fkIdApprentices, 
                        \"fkIdUsers\" = :fkIdUsers,
                        \"updatedAt\" = :updatedAt 
                    WHERE id = :id";       // Se elimina fechaCreacion=:fechaCreacion, para fecha automática.
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            //$statement->bindParam(":fechaCreacion", $fechaCreacion, PDO::PARAM_STR);
            $statement->bindParam(":description", $descripcion, PDO::PARAM_STR);
            $statement->bindParam(":addressing", $direccionamiento, PDO::PARAM_STR);
            $statement->bindParam(":state", $estado, PDO::PARAM_STR);
            $statement->bindParam(":fkIdApprentices", $fkIdAprendiz, PDO::PARAM_INT);
            $statement->bindParam(":fkIdUsers", $fkIdUsuario, PDO::PARAM_INT);
            $statement->bindParam(":updatedAt", $fechaActual, PDO::PARAM_STR);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar el reporte: ".$ex->getMessage();
            return false;
        }
    }

    public function removeReporte($id) {
        try {
            // Iniciar transacción | Para asegurar que ambas eliminaciones (reporte y relaciones) se completen con éxito. Si falla alguna operación, se revierten todos los cambios
            $this->dbConnection->beginTransaction();

            // 1. Eliminar relaciones en causes_reports (nombre de tabla en PostgreSQL)
            $sqlRelaciones = "DELETE FROM causes_reports WHERE \"fkIdReports\" = :id";
            $stmtRelaciones = $this->dbConnection->prepare($sqlRelaciones);
            $stmtRelaciones->bindParam(":id", $id, PDO::PARAM_INT);
            $stmtRelaciones->execute();

            // 2. Eliminar el reporte - CONSULTA ADAPTADA
            $sql = "DELETE FROM $this->table WHERE id = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();

            // Confirmar transacción
            $this->dbConnection->commit();
            return $result;
        } catch (PDOException $ex) {
            // Revertir cambios en caso de error
            $this->dbConnection->rollBack();
            echo "No se pudo eliminar el reporte: ".$ex->getMessage();
            return false;
        }
    }

    // SE CAMBIA ESTO
    public function getLastInsertId() {
        return $this->dbConnection->lastInsertId();
    }

    public function guardarRelacionesCausa($idReporte, $causas) {
        try {
            // Generar fecha actual | Colombia
            date_default_timezone_set('America/Bogota');
            $fechaActual = date('Y-m-d H:i:s');

            foreach ($causas as $causa) {
                // Acceder correctamente al valor de causaId
                $idCausa = $causa['causaId'];

                // CONSULTA ADAPTADA para PostgreSQL - nombres de tabla y columnas actualizados
                $sql = "INSERT INTO causes_reports (\"fkIdReports\", \"fkIdCauses\", \"createdAt\", \"updatedAt\") VALUES (:idReporte, :idCausa, :createdAt, :updatedAt)";
                $statement = $this->dbConnection->prepare($sql);
                $statement->bindParam(':idReporte', $idReporte, PDO::PARAM_INT);
                $statement->bindParam(':idCausa', $idCausa, PDO::PARAM_INT);
                $statement->bindParam(':createdAt', $fechaActual, PDO::PARAM_STR);
                $statement->bindParam(':updatedAt', $fechaActual, PDO::PARAM_STR);
                $statement->execute();
            }
            return true;
        } catch (PDOException $ex) {
            error_log("Error al guardar relaciones: " . $ex->getMessage());
            return false;
        }
    }

    // Funcion para cambio de estado del aprendiz en viewReporte
    public function updateEstado($id, $estado) {
        try {
            // Generar fecha actual | Colombia
            date_default_timezone_set('America/Bogota');
            $fechaActual = date('Y-m-d H:i:s');

            // CONSULTA ADAPTADA para PostgreSQL
            $sql = "UPDATE $this->table SET state = :state, \"updatedAt\" = :updatedAt WHERE id = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":state", $estado, PDO::PARAM_STR);
            $statement->bindParam(":updatedAt", $fechaActual, PDO::PARAM_STR);
            return $statement->execute();
        } catch (PDOException $ex) {
            error_log("Error al actualizar estado: " . $ex->getMessage());
            return false;
        }
    }

    // Funcion getAll para capturar nombre completo del aprendiz y renderizarla en el viewReporte.
    public function getAll():array {     // Se usa : array en la declaración del método para coincidir con la clase padre
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de tablas y columnas actualizados
            $sql = "SELECT reports.*, 
                       CONCAT(apprentices.\"firtsName\", ' ', apprentices.\"lastName\") AS \"nombreAprendiz\" 
                FROM reports 
                INNER JOIN apprentices ON reports.\"fkIdApprentices\" = apprentices.id
                ORDER BY reports.\"creationDate\" DESC";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener todos los reportes: " . $ex->getMessage();
            return [];    
        }
    }

    /**
     * Método adicional para obtener reportes por aprendiz
     * @param int $idAprendiz ID del aprendiz
     * @return array Array de reportes del aprendiz
     */
    public function getReportesPorAprendiz($idAprendiz) {
        try {
            $sql = "SELECT * FROM $this->table WHERE fkIdApprentices = :idAprendiz ORDER BY creationDate DESC";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":idAprendiz", $idAprendiz, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al obtener reportes por aprendiz: " . $ex->getMessage());
            return [];
        }
    }

    /**
     * Método adicional para obtener reportes por estado
     * @param string $estado Estado del reporte
     * @return array Array de reportes con el estado especificado
     */
    public function getReportesPorEstado($estado) {
        try {
            $sql = "SELECT reports.*, 
                        CONCAT(apprentices.firtsName, ' ', apprentices.lastName) AS nombreAprendiz 
                    FROM reports 
                    INNER JOIN apprentices ON reports.fkIdApprentices = apprentices.id
                    WHERE reports.state = :estado";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":estado", $estado, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al obtener reportes por estado: " . $ex->getMessage());
            return [];
        }
    }

}