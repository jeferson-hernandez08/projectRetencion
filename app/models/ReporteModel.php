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
        $this->table = "reporte";
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveReporte($descripcion, $direccionamiento, $estado, $fkIdAprendiz, $fkIdUsuario) {   // Eliminamos la variable $fechaCreacion, para generacion automatica
        try {
            // Generar fecha automática | Colombia
            date_default_timezone_set('America/Bogota');
            $fechaCreacion = date('Y-m-d H:i:s');

            $sql = "INSERT INTO $this->table (fechaCreacion, descripcion, direccionamiento, estado, fkIdAprendiz, fkIdUsuario) 
                    VALUES (:fechaCreacion, :descripcion, :direccionamiento, :estado, :fkIdAprendiz, :fkIdUsuario)";
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);
            // $fechaCreacion = $this->fechaCreacion ?? '';         // Estos datos es opcional
            // $descripcion = $this->descripcion ?? '';
            // $direccionamiento = $this->direccionamiento ?? '';
            // $estado = $this->estado ?? '';
            // $fkIdAprendiz = $this->fkIdAprendiz ?? '';
            // $fkIdUsuario = $this->fkIdUsuario ?? '';

            // 2. BindParam para sanitizar los datos de entrada
            $statement->bindParam('fechaCreacion', $fechaCreacion, PDO::PARAM_STR);
            $statement->bindParam('descripcion', $descripcion, PDO::PARAM_STR);
            $statement->bindParam('direccionamiento', $direccionamiento, PDO::PARAM_STR);
            $statement->bindParam('estado', $estado, PDO::PARAM_STR);
            $statement->bindParam('fkIdAprendiz', $fkIdAprendiz, PDO::PARAM_INT);
            $statement->bindParam('fkIdUsuario', $fkIdUsuario, PDO::PARAM_INT);

            // 3. Ejecutar la consulta
            // $result = $statement->execute();
            // return $result;
            return $statement->execute();    // SE CAMBIA ESTO  
        } catch (PDOException $ex) {
            echo "Error al guardar el reporte> ".$ex->getMessage();
        }
    }

    public function getReporte($id) {
        try {
            $sql = "SELECT reporte.*, usuario.nombre AS nombreUsuario, aprendiz.nombre AS nombreAprendiz 
                    FROM reporte 
                    INNER JOIN usuario 
                    ON reporte.fkIdUsuario = usuario.idUsuario 
                    INNER JOIN aprendiz
                    ON reporte.fkIdAprendiz = aprendiz.idAprendiz
                    WHERE reporte.idReporte=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result[0]; 
        } catch (PDOException $ex) {
            echo "Error al obtener el reporte" . $ex->getMessage();
        }
    }

    public function editReporte($id, $descripcion, $direccionamiento, $estado, $fkIdAprendiz, $fkIdUsuario) {  // Se elimina $fechaCreacion, fecha automática.
        try {
            $sql = "UPDATE $this->table SET 
                        descripcion=:descripcion, 
                        direccionamiento=:direccionamiento, 
                        estado=:estado, 
                        fkIdAprendiz=:fkIdAprendiz, 
                        fkIdUsuario=:fkIdUsuario 
                    WHERE idReporte=:id";       // Se elimina fechaCreacion=:fechaCreacion, para fecha automática.
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            //$statement->bindParam(":fechaCreacion", $fechaCreacion, PDO::PARAM_STR);
            $statement->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $statement->bindParam(":direccionamiento", $direccionamiento, PDO::PARAM_STR);
            $statement->bindParam(":estado", $estado, PDO::PARAM_STR);
            $statement->bindParam(":fkIdAprendiz", $fkIdAprendiz, PDO::PARAM_INT);
            $statement->bindParam(":fkIdUsuario", $fkIdUsuario, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar el reporte".$ex->getMessage();
        }
    }

    public function removeReporte($id) {
        try {
            // Iniciar transacción | Para asegurar que ambas eliminaciones (reporte y relaciones) se completen con éxito. Si falla alguna operación, se revierten todos los cambios
            $this->dbConnection->beginTransaction();

            // 1. Eliminar relaciones en causa_reporte
            $sqlRelaciones = "DELETE FROM causa_reporte WHERE fkIdReporte = :id";
            $stmtRelaciones = $this->dbConnection->prepare($sqlRelaciones);
            $stmtRelaciones->bindParam(":id", $id, PDO::PARAM_INT);
            $stmtRelaciones->execute();

            // 2. Eliminar el reporte
            $sql = "DELETE FROM $this->table WHERE idReporte=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();

            // Confirmar transacción
            $this->dbConnection->commit();
            return $result;
        } catch (PDOException $ex) {
            // Revertir cambios en caso de error
            $this->dbConnection->rollBack();
            echo "No se pudo eliminar el reporte".$ex->getMessage();
            return false;
        }
    }

    // SE CAMBIA ESTO
    public function getLastInsertId() {
        return $this->dbConnection->lastInsertId();
    }

    public function guardarRelacionesCausa($idReporte, $causas) {
        try {
            foreach ($causas as $causa) {
                // Acceder correctamente al valor de causaId
                $idCausa = $causa['causaId'];

                $sql = "INSERT INTO causa_reporte (fkIdReporte, fkIdCausa) VALUES (:idReporte, :idCausa)";
                $statement = $this->dbConnection->prepare($sql);
                $statement->bindParam(':idReporte', $idReporte, PDO::PARAM_INT);
                $statement->bindParam(':idCausa', $idCausa, PDO::PARAM_INT);
                $statement->execute();
            }
            return true;
        } catch (PDOException $ex) {
            error_log("Error al guardar relaciones: " . $ex->getMessage());
            return false;
        }
    }


}