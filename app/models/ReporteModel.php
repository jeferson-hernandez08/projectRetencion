<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE . "../models/BaseModel.php";

class ReporteModel extends BaseModel {
    public function __construct(
        ?int $idReporte = null,
        ?string $fechaCreacion = null,
        ?string $tipoReporte = null,
        ?string $descripcion = null,
        ?string $conclusiones = null,
        ?string $fkIdAprendiz = null,
        ?string $fkIdGestor = null
    ) {
        $this->table = "reporte"; // Nombre de la tabla en la base de datos  //ERROR COMUN MAL NOMBRAMIENTO
        // Se llama al constructor del padre
        parent::__construct();
    }

    /**
     * Guarda un nuevo reporte en la base de datos.
     */
    public function saveReporte($fechaCreacion, $tipoReporte, $descripcion, $conclusiones, $fkIdAprendiz, $fkIdGestor) {
        try {
            $sql = "INSERT INTO $this->table (fechaCreacion, tipoReporte, descripcion, conclusiones, FkIdAprendiz, FkIdGestor) 
                    VALUES (:fechaCreacion, :tipoReporte, :descripcion, :conclusiones, :FkIdAprendiz, :FkIdGestor)";
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);

            // 2. BindParam para sanitizar los datos de entrada
            $statement->bindParam('fechaCreacion', $fechaCreacion, PDO::PARAM_STR);
            $statement->bindParam('tipoReporte', $tipoReporte, PDO::PARAM_STR);
            $statement->bindParam('descripcion', $descripcion, PDO::PARAM_STR);
            $statement->bindParam('conclusiones', $conclusiones, PDO::PARAM_STR);
            $statement->bindParam('FkIdAprendiz', $fkIdAprendiz, PDO::PARAM_INT);
            $statement->bindParam('FkIdGestor', $fkIdGestor, PDO::PARAM_INT);

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar el reporte: " . $ex->getMessage();
        }
    }

    /**
     * Obtiene un reporte por su ID.
     */
    public function getReporte($idReporte) {
        try {
            $sql = "SELECT * FROM $this->table WHERE idReporte = :idReporte";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":idReporte", $idReporte, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result[0]; // Retorna el primer resultado
        } catch (PDOException $ex) {
            echo "Error al obtener el reporte: " . $ex->getMessage();
        }
    }

    /**
     * Edita un reporte existente.
     */
    public function editReporte($idReporte, $fechaCreacion, $tipoReporte, $descripcion, $conclusiones, $fkIdAprendiz, $fkIdGestor) {
        try {
            $sql = "UPDATE $this->table 
                    SET fechaCreacion = :fechaCreacion, 
                        tipoReporte = :tipoReporte, 
                        descripcion = :descripcion, 
                        conclusiones = :conclusiones, 
                        FkIdAprendiz = :FkIdAprendiz, 
                        FkIdGestor = :FkIdGestor 
                    WHERE idReporte = :idReporte";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":idReporte", $idReporte, PDO::PARAM_INT);
            $statement->bindParam(":fechaCreacion", $fechaCreacion, PDO::PARAM_STR);
            $statement->bindParam(":tipoReporte", $tipoReporte, PDO::PARAM_STR);
            $statement->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $statement->bindParam(":conclusiones", $conclusiones, PDO::PARAM_STR);
            $statement->bindParam(":FkIdAprendiz", $fkIdAprendiz, PDO::PARAM_INT);
            $statement->bindParam(":FkIdGestor", $fkIdGestor, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al editar el reporte: " . $ex->getMessage();
        }
    }

    /**
     * Elimina un reporte por su ID.
     */
    public function deleteReporte($idReporte) {
        try {
            $sql = "DELETE FROM $this->table WHERE idReporte = :idReporte";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":idReporte", $idReporte, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al eliminar el reporte: " . $ex->getMessage();
        }
    }
}