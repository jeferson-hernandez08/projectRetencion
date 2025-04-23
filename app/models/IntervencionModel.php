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
        $this->table = "intervencion";
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveIntervencion($fechaCreacion, $descripcion, $fkIdEstrategias, $fkIdReporte, $fkIdUsuario) {
        try {
            $sql = "INSERT INTO $this->table (fechaCreacion, descripcion, fkIdEstrategias, fkIdReporte, fkIdUsuario) 
                    VALUES (:fechaCreacion, :descripcion, :fkIdEstrategias, :fkIdReporte, :fkIdUsuario)";
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);
            // $fechaCreacion = $this->fechaCreacion ?? '';         // Estos datos es opcional
            // $descripcion = $this->descripcion ?? '';
            // $fkIdEstrategias = $this->fkIdEstrategias ?? '';
            // $fkIdReporte = $this->fkIdReporte ?? '';
            // $fkIdUsuario = $this->fkIdUsuario ?? '';

            // 2. BindParam para sanitizar los datos de entrada
            $statement->bindParam('fechaCreacion', $fechaCreacion, PDO::PARAM_STR);
            $statement->bindParam('descripcion', $descripcion, PDO::PARAM_STR);
            $statement->bindParam('fkIdEstrategias', $fkIdEstrategias, PDO::PARAM_INT);
            $statement->bindParam('fkIdReporte', $fkIdReporte, PDO::PARAM_INT);
            $statement->bindParam('fkIdUsuario', $fkIdUsuario, PDO::PARAM_INT);

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar la intervención> ".$ex->getMessage();
        }
    }

    public function getIntervencion($id) {
        try {
            $sql = "SELECT intervencion.*, estrategias.estrategia AS nombreEstrategia, 
                    reporte.descripcion AS descripcionReporte, usuario.nombre AS nombreUsuario
                    FROM intervencion 
                    INNER JOIN estrategias ON intervencion.fkIdEstrategias = estrategias.idEstrategias
                    INNER JOIN reporte ON intervencion.fkIdReporte = reporte.idReporte
                    INNER JOIN usuario ON intervencion.fkIdUsuario = usuario.idUsuario
                    WHERE intervencion.idIntervencion=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result[0]; 
        } catch (PDOException $ex) {
            echo "Error al obtener la intervención" . $ex->getMessage();
        }
    }

    public function editIntervencion($id, $fechaCreacion, $descripcion, $fkIdEstrategias, $fkIdReporte, $fkIdUsuario) {
        try {
            $sql = "UPDATE $this->table SET 
                        fechaCreacion=:fechaCreacion, 
                        descripcion=:descripcion, 
                        fkIdEstrategias=:fkIdEstrategias, 
                        fkIdReporte=:fkIdReporte, 
                        fkIdUsuario=:fkIdUsuario 
                    WHERE idIntervencion=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":fechaCreacion", $fechaCreacion, PDO::PARAM_STR);
            $statement->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $statement->bindParam(":fkIdEstrategias", $fkIdEstrategias, PDO::PARAM_INT);
            $statement->bindParam(":fkIdReporte", $fkIdReporte, PDO::PARAM_INT);
            $statement->bindParam(":fkIdUsuario", $fkIdUsuario, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar la intervención".$ex->getMessage();
        }
    }

    public function removeIntervencion($id) {
        try {
            $sql = "DELETE FROM $this->table WHERE idIntervencion=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo eliminar la intervención".$ex->getMessage();
        }
    }
}