<?php
// namespace App\Controllers;
// use App\Models\NotificacionModel;
// use PDO;

// require_once 'baseController.php';
// require_once MAIN_APP_ROUTE."../models/NotificacionModel.php";

// class NotificacionController extends BaseController {
    
//     public function __construct() {
//         $this->layout = "admin_layout";
//         parent::__construct();
//     }

//     public function getNotificaciones() {
//         $usuarioId = $_SESSION['id'] ?? null;
//         if (!$usuarioId) {
//             echo json_encode(['error' => 'Usuario no autenticado']);
//             exit;
//         }

//         $model = new NotificacionModel();
//         $notificaciones = $model->getByUsuario($usuarioId);
        
//         // Contar no leídas
//         $noLeidas = 0;
//         foreach ($notificaciones as $notif) {
//             if (!$notif->leida) $noLeidas++;
//         }

//         header('Content-Type: application/json');
//         echo json_encode([
//             'noLeidas' => $noLeidas,
//             'notificaciones' => $notificaciones
//         ]);
//         exit;
//     }

//     public function marcarLeida($id) {
//         $usuarioId = $_SESSION['id'] ?? null;
//         if (!$usuarioId) {
//             http_response_code(401);
//             echo json_encode(['success' => false, 'error' => 'No autenticado']);
//             exit;
//         }

//         $model = new NotificacionModel();
//         $success = $model->marcarComoLeida($id, $usuarioId);
        
//         if ($success) {
//             echo json_encode(['success' => true]);
//         } else {
//             echo json_encode(['success' => false, 'error' => 'Error al marcar como leída']);
//         }
//         exit;
//     }

//     public function marcarTodasLeidas() {
//         $usuarioId = $_SESSION['id'] ?? null;
//         if (!$usuarioId) {
//             http_response_code(401);
//             echo json_encode(['success' => false, 'error' => 'No autenticado']);
//             exit;
//         }

//         $model = new NotificacionModel();
//         $success = $model->marcarTodasComoLeidas($usuarioId);
        
//         if ($success) {
//             echo json_encode(['success' => true]);
//         } else {
//             echo json_encode(['success' => false, 'error' => 'Error al marcar todas como leídas']);
//         }
//         exit;
//     }
// }