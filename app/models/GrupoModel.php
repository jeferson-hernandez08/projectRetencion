<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE."../models/BaseModel.php";

class GrupoModel extends BaseModel {
    public function __construct(
        ?int $idGrupo = null,
        ?string $ficha = null,
        ?string $inicioLectiva = null,
        ?string $finLectiva = null,
        ?string $inicioPractica = null,
        ?string $finPractica = null,
        ?string $nombreGestor = null,
        ?string $jornada = null,
        ?string $modalidad = null,
        ?string $fkIdProgramaFormacion = null
    ) {
        $this->table = "groups";  // Cambiado de "grupo" a "groups" para PostgreSQL
        // Se llama al constructor del padre
        parent::__construct();
    }

    public function saveGrupo($ficha, $inicioLectiva, $finLectiva, $inicioPractica, $finPractica, $nombreGestor, $jornada, $modalidad, $fkIdProgramaFormacion) {
        try {
            // Debug: verificar el valor de ficha
            error_log("🔍 Valor de ficha recibido: '$ficha'");
            
            // CONSULTA ADAPTADA para PostgreSQL con nombres de columnas en inglés
            // Se incluyen createdAt y updatedAt que son NOT NULL en PostgreSQL
            $sql = "INSERT INTO $this->table (\"file\", \"trainingStart\", \"trainingEnd\", \"practiceStart\", \"practiceEnd\", \"managerName\", \"shift\", \"modality\", \"fkIdTrainingPrograms\", \"createdAt\", \"updatedAt\") 
                VALUES (:file, :trainingStart, :trainingEnd, :practiceStart, :practiceEnd, :managerName, :shift, :modality, :fkIdTrainingPrograms, NOW(), NOW())";

                error_log("🔍 SQL: " . $sql);
                    
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);

            // 2. BindParam para sanitizar los datos de entrada - NOMBRES ADAPTADOS
            $statement->bindParam('file', $ficha, PDO::PARAM_STR);
            $statement->bindParam('trainingStart', $inicioLectiva, $inicioLectiva ? PDO::PARAM_STR : PDO::PARAM_NULL);
            $statement->bindParam('trainingEnd', $finLectiva, $finLectiva ? PDO::PARAM_STR : PDO::PARAM_NULL);
            $statement->bindParam('practiceStart', $inicioPractica, $inicioPractica ? PDO::PARAM_STR : PDO::PARAM_NULL);
            $statement->bindParam('practiceEnd', $finPractica, $finPractica ? PDO::PARAM_STR : PDO::PARAM_NULL);
            $statement->bindParam('managerName', $nombreGestor, PDO::PARAM_STR);
            $statement->bindParam('shift', $jornada, PDO::PARAM_STR);
            $statement->bindParam('modality', $modalidad, PDO::PARAM_STR);
            $statement->bindParam('fkIdTrainingPrograms', $fkIdProgramaFormacion, PDO::PARAM_INT);
            // if (!empty($fkIdProgramaFormacion)) {
            //     $statement->bindParam('fkIdTrainingPrograms', $fkIdProgramaFormacion, PDO::PARAM_INT);
            // } else {
            //     $statement->bindValue('fkIdTrainingPrograms', null, PDO::PARAM_NULL);
            // }

            // 3. Ejecutar la consulta
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "Error al guardar el grupo: ".$ex->getMessage();
            return false;
        }
    }

    // Método para obtener todos los grupos con información del programa de formación
    public function getAllWithPrograma() {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de tablas y columnas actualizados
            $sql = "SELECT groups.*, training_programs.name AS \"nombrePrograma\" 
                    FROM groups 
                    INNER JOIN training_programs 
                    ON groups.\"fkIdTrainingPrograms\" = training_programs.id";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (PDOException $ex) {
            echo "Error al obtener los grupos con programa: " . $ex->getMessage();
            return [];
        }
    }

    public function getGrupo($id) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de tablas y columnas actualizados
            $sql = "SELECT groups.*, training_programs.name AS \"nombrePrograma\" 
                    FROM groups 
                    INNER JOIN training_programs 
                    ON groups.\"fkIdTrainingPrograms\" = training_programs.id 
                    WHERE groups.id = :id";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result[0]; 
        } catch (PDOException $ex) {
            echo "Error al obtener el grupo: " . $ex->getMessage();
            return null;
        }
    }

    public function editGrupo($id, $ficha, $inicioLectiva, $finLectiva, $inicioPractica, $finPractica, $nombreGestor, $jornada, $modalidad, $fkIdProgramaFormacion) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de columnas actualizados
            $sql = "UPDATE $this->table SET 
                        \"file\" = :file, 
                        \"trainingStart\" = :trainingStart,
                        \"trainingEnd\" = :trainingEnd,
                        \"practiceStart\" = :practiceStart,
                        \"practiceEnd\" = :practiceEnd,
                        \"managerName\" = :managerName,
                        \"shift\" = :shift, 
                        \"modality\" = :modality, 
                        \"fkIdTrainingPrograms\" = :fkIdTrainingPrograms,
                        \"updatedAt\" = NOW()  
                    WHERE id = :id";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":file", $ficha, PDO::PARAM_STR);
            $statement->bindParam(":trainingStart", $inicioLectiva, $inicioLectiva ? PDO::PARAM_STR : PDO::PARAM_NULL);
            $statement->bindParam(":trainingEnd", $finLectiva, $finLectiva ? PDO::PARAM_STR : PDO::PARAM_NULL);
            $statement->bindParam(":practiceStart", $inicioPractica, $inicioPractica ? PDO::PARAM_STR : PDO::PARAM_NULL);
            $statement->bindParam(":practiceEnd", $finPractica, $finPractica ? PDO::PARAM_STR : PDO::PARAM_NULL);
            $statement->bindParam(":managerName", $nombreGestor, PDO::PARAM_STR);
            $statement->bindParam(":shift", $jornada, PDO::PARAM_STR);
            $statement->bindParam(":modality", $modalidad, PDO::PARAM_STR);
            $statement->bindParam(":fkIdTrainingPrograms", $fkIdProgramaFormacion, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar el grupo: ".$ex->getMessage();
            return false;
        }
    }

    public function removeGrupo($id) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombre de columna cambiado
            $sql = "DELETE FROM $this->table WHERE id = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo eliminar el grupo: ".$ex->getMessage();
            return false;
        }
    }

    // Funcion para verificar importacion excel que no este repetido
    public function getGrupoPorFicha($ficha) {
        try {
            // CONSULTA ADAPTADA para PostgreSQL - nombres de tabla y columna actualizados
            $sql = "SELECT * FROM groups WHERE file = ? LIMIT 1";
            $stmt = $this->dbConnection->prepare($sql);
            $stmt->execute([$ficha]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log("Error en getGrupoPorFicha: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Método para obtener grupos por programa de formación
     * @param int $idPrograma ID del programa de formación
     * @return array Array de grupos del programa especificado
     */
    public function getGruposPorPrograma($idPrograma) {
        try {
            $sql = "SELECT groups.*, training_programs.name AS nombrePrograma 
                    FROM groups 
                    INNER JOIN training_programs ON groups.fkIdTrainingPrograms = training_programs.id
                    WHERE groups.fkIdTrainingPrograms = :idPrograma
                    ORDER BY groups.file";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":idPrograma", $idPrograma, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al obtener grupos por programa: " . $ex->getMessage());
            return [];
        }
    }

    /**
     * Método para obtener grupos por jornada
     * @param string $jornada Jornada (Diurna, Mixta, Nocturna, etc.)
     * @return array Array de grupos de la jornada especificada
     */
    public function getGruposPorJornada($jornada) {
        try {
            $sql = "SELECT groups.*, training_programs.name AS nombrePrograma 
                    FROM groups 
                    INNER JOIN training_programs ON groups.fkIdTrainingPrograms = training_programs.id
                    WHERE groups.shift = :jornada
                    ORDER BY groups.file";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":jornada", $jornada, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al obtener grupos por jornada: " . $ex->getMessage());
            return [];
        }
    }

    /**
     * Método para obtener grupos por modalidad
     * @param string $modalidad Modalidad (Presencial, Virtual, etc.)
     * @return array Array de grupos de la modalidad especificada
     */
    public function getGruposPorModalidad($modalidad) {
        try {
            $sql = "SELECT groups.*, training_programs.name AS nombrePrograma 
                    FROM groups 
                    INNER JOIN training_programs ON groups.fkIdTrainingPrograms = training_programs.id
                    WHERE groups.modality = :modalidad
                    ORDER BY groups.file";
                    
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":modalidad", $modalidad, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al obtener grupos por modalidad: " . $ex->getMessage());
            return [];
        }
    }

    /**
     * Método para contar aprendices por grupo
     * @param int $idGrupo ID del grupo
     * @return int Número de aprendices en el grupo
     */
    public function contarAprendicesPorGrupo($idGrupo) {
        try {
            $sql = "SELECT COUNT(*) as total FROM apprentices WHERE fkIdGroups = :idGrupo";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":idGrupo", $idGrupo, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_OBJ);
            return $result->total;
        } catch (PDOException $ex) {
            error_log("Error al contar aprendices por grupo: " . $ex->getMessage());
            return 0;
        }
    }

}