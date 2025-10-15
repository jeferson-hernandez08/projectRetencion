<?php

    namespace App\Models;
    use PDO;
    use PDOException;

    require_once MAIN_APP_ROUTE."../models/BaseModel.php";

    class ProgramaFormacionModel extends BaseModel {
        public function __construct(
            ?int $idProgramaFormacion = null,
            ?string $nombre = null,
            ?string $nivel = null,
            ?string $version = null
        ) {
            $this->table = "training_programs";  // Cambiado de "programaformacion" a "training_programs" para PostgreSQL
            // Se llama al constructor del padre
            parent::__construct();
        }

        public function saveProgramaFormacion($nombre, $nivel, $version) {
            try {
                // CONSULTA ADAPTADA para PostgreSQL con nombres de columnas en inglés
                // Se incluyen createdAt y updatedAt que son NOT NULL en PostgreSQL
                $sql = "INSERT INTO $this->table (name, level, version, \"createdAt\", \"updatedAt\") 
                        VALUES (:name, :level, :version, NOW(), NOW())";
                        
                // 1. Se prepara la consulta
                $statement = $this->dbConnection->prepare($sql);

                // 2. BindParam para sanitizar los datos de entrada - NOMBRES ADAPTADOS
                $statement->bindParam('name', $nombre, PDO::PARAM_STR);
                $statement->bindParam('level', $nivel, PDO::PARAM_STR);
                $statement->bindParam('version', $version, PDO::PARAM_STR);

                // 3. Ejecutar la consulta
                $result = $statement->execute();
                return $result;
            } catch (PDOException $ex) {
                echo "Error al guardar el programa de formación: ".$ex->getMessage();
                return false;
            }
        }

        public function getProgramaFormacion($id) {
            try {
                // CONSULTA ADAPTADA para PostgreSQL - nombre de columna cambiado
                $sql = "SELECT * FROM $this->table WHERE id = :id";
                $statement = $this->dbConnection->prepare($sql);
                $statement->bindParam(":id", $id, PDO::PARAM_INT);
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_OBJ);
                //print_r($result);
                return $result[0];
            } catch (PDOException $ex) {
                echo "Error al obtener el programa de formación: " . $ex->getMessage();
                return null;
            }
        }

        public function editProgramaFormacion($id, $nombre, $nivel, $version) {
            try {
                // CONSULTA ADAPTADA para PostgreSQL - nombres de columnas actualizados
                $sql = "UPDATE $this->table SET name = :name, level = :level, version = :version, \"updatedAt\" = NOW() WHERE id = :id";
                
                error_log("Ejecutando UPDATE: ID=$id, Nombre=$nombre, Nivel=$nivel, Version=$version");
                
                $statement = $this->dbConnection->prepare($sql);
                $statement->bindParam(":id", $id, PDO::PARAM_INT);
                $statement->bindParam(":name", $nombre, PDO::PARAM_STR);
                $statement->bindParam(":level", $nivel, PDO::PARAM_STR);
                $statement->bindParam(":version", $version, PDO::PARAM_STR);
                
                $result = $statement->execute();
                
                // Verificar cuántas filas fueron afectadas
                $rowCount = $statement->rowCount();
                error_log("Filas afectadas: $rowCount, Resultado: " . ($result ? 'true' : 'false'));
                
                return $result;
            } catch (PDOException $ex) {
                error_log("No se pudo editar el programa de formación: ".$ex->getMessage());
                return false;
            }
        }

        public function removeProgramaFormacion($id) {
            try {
                // CONSULTA ADAPTADA para PostgreSQL - nombre de columna cambiado
                $sql = "DELETE FROM $this->table WHERE id = :id";
                $statement = $this->dbConnection->prepare($sql);
                $statement->bindParam(":id", $id, PDO::PARAM_INT);
                $result = $statement->execute();
                return $result;
            } catch (PDOException $ex) {
                echo "No se pudo eliminar el programa de formación: ".$ex->getMessage();
                return false;
            }
        }

        // Funcion para verificar importacion excel que no este repetido
        public function getProgramaPorNombre($nombre) {
            try {
                // CONSULTA ADAPTADA para PostgreSQL - nombres de tabla y columna actualizados
                $sql = "SELECT * FROM training_programs WHERE name = ? LIMIT 1";
                $stmt = $this->dbConnection->prepare($sql);
                $stmt->execute([$nombre]);
                return $stmt->fetch(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                error_log("Error en getProgramaPorNombre: " . $e->getMessage());
                return false;
            }
        }

        /**
         * Método para obtener todos los programas de formación - Override del método getAll del BaseModel
         * @return array Array de objetos con todos los programas de formación
         */
        public function getAll(): array {
            try {
                $sql = "SELECT * FROM $this->table ORDER BY name";
                $statement = $this->dbConnection->prepare($sql);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $ex) {
                error_log("Error al obtener todos los programas de formación: " . $ex->getMessage());
                return [];
            }
        }

        /**
         * Método para buscar programas de formación por nivel
         * @param string $nivel Nivel del programa (Técnico, Tecnólogo, etc.)
         * @return array Array de programas de formación del nivel especificado
         */
        public function getProgramasPorNivel($nivel) {
            try {
                $sql = "SELECT * FROM $this->table WHERE level = :level ORDER BY name";
                $statement = $this->dbConnection->prepare($sql);
                $statement->bindParam(":level", $nivel, PDO::PARAM_STR);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $ex) {
                error_log("Error al obtener programas por nivel: " . $ex->getMessage());
                return [];
            }
        }

        /**
         * Método para obtener programas con filtros opcionales
         * @param string|null $nombre Nombre del programa (opcional)
         * @param string|null $nivel Nivel del programa (opcional)
         * @return array Array de programas de formación filtrados
         */
        public function getProgramasFiltrados($nombre = null, $nivel = null) {
            try {
                $sql = "SELECT * FROM $this->table WHERE 1=1";
                $params = [];

                if ($nombre) {
                    $sql .= " AND name LIKE :nombre";
                    $params[':nombre'] = "%$nombre%";
                }

                if ($nivel) {
                    $sql .= " AND level = :nivel";
                    $params[':nivel'] = $nivel;
                }

                $sql .= " ORDER BY name";

                $statement = $this->dbConnection->prepare($sql);
                
                // Bind de parámetros
                foreach ($params as $key => $value) {
                    $statement->bindValue($key, $value);
                }

                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $ex) {
                error_log("Error al obtener programas filtrados: " . $ex->getMessage());
                return [];
            }
        }

    }