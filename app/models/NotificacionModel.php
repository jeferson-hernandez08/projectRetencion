<?php
// namespace App\Models;
// use PDO;
// use PDOException;

// require_once MAIN_APP_ROUTE."../models/BaseModel.php";

// class NotificacionModel extends BaseModel {
//     public function __construct() {
//         $this->table = "notificacion";
//         parent::__construct();
//     }

//     public function crearNotificacion($mensaje, $usuarioId, $reporteId) {
//         try {
//             $sql = "INSERT INTO notificacion (mensaje, fecha, leida, fkIdUsuario, fkIdReporte)
//                     VALUES (:mensaje, NOW(), 0, :usuario, :reporte)";
//             $stmt = $this->dbConnection->prepare($sql);
//             $stmt->bindParam(':mensaje', $mensaje, PDO::PARAM_STR);
//             $stmt->bindParam(':usuario', $usuarioId, PDO::PARAM_INT);
//             $stmt->bindParam(':reporte', $reporteId, PDO::PARAM_INT);
//             return $stmt->execute();
//         } catch (PDOException $ex) {
//             error_log("Error al crear notificación: " . $ex->getMessage());
//             return false;
//         }
//     }

//     public function getByUsuario($usuarioId) {
//         try {
//             $sql = "SELECT * FROM notificacion 
//                     WHERE fkIdUsuario = :usuarioId
//                     ORDER BY fecha DESC 
//                     LIMIT 10";
//             $stmt = $this->dbConnection->prepare($sql);
//             $stmt->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
//             $stmt->execute();
//             return $stmt->fetchAll(PDO::FETCH_OBJ);
//         } catch (PDOException $ex) {
//             error_log("Error al obtener notificaciones: " . $ex->getMessage());
//             return [];
//         }
//     }

//     public function marcarComoLeida($id, $usuarioId) {
//         try {
//             $sql = "UPDATE notificacion SET leida = 1 
//                     WHERE idNotificacion = :id AND fkIdUsuario = :usuarioId";
//             $stmt = $this->dbConnection->prepare($sql);
//             $stmt->bindParam(':id', $id, PDO::PARAM_INT);
//             $stmt->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
//             return $stmt->execute();
//         } catch (PDOException $ex) {
//             error_log("Error al marcar notificación como leída: " . $ex->getMessage());
//             return false;
//         }
//     }

//     public function marcarTodasComoLeidas($usuarioId) {
//         try {
//             $sql = "UPDATE notificacion SET leida = 1 
//                     WHERE fkIdUsuario = :usuarioId AND leida = 0";
//             $stmt = $this->dbConnection->prepare($sql);
//             $stmt->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
//             return $stmt->execute();
//         } catch (PDOException $ex) {
//             error_log("Error al marcar todas como leídas: " . $ex->getMessage());
//             return false;
//         }
//     }
// }