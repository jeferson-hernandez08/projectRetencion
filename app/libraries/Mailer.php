<?php

namespace App\Libraries;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Ruta corregida: Desde app/libraries/ sube DOS niveles a la raíz (projectRetencion/vendor/autoload.php)
require_once __DIR__ . '/../../vendor/autoload.php'; 

// Ruta para config/email.php: Desde app/libraries/ sube un nivel a app/config/
require_once __DIR__ . '/../config/email.php';

class Mailer {

    protected $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        try {
            // Configuración del servidor
            $this->mail->isSMTP();                                            // Usar SMTP
            $this->mail->Host       = MAIL_HOST;                              // Especificar el servidor SMTP principal y de respaldo
            $this->mail->SMTPAuth   = true;                                   // Habilitar autenticación SMTP
            $this->mail->Username   = MAIL_USERNAME;                          // Nombre de usuario SMTP
            $this->mail->Password   = MAIL_PASSWORD;                          // Contraseña SMTP
            $this->mail->SMTPSecure = MAIL_SMTPSECURE;                        // Habilitar encriptación TLS, `ssl` también aceptado
            $this->mail->Port       = MAIL_PORT;                              // Puerto TCP para conectarse

            // Remitente
            $this->mail->setFrom(MAIL_FROM_EMAIL, MAIL_FROM_NAME);
            $this->mail->CharSet = 'UTF-8'; // Establecer el conjunto de caracteres a UTF-8

        } catch (Exception $e) {
            error_log("Error al configurar PHPMailer: {$this->mail->ErrorInfo}");
        }
    }

    public function sendNewReportNotification(array $recipients, string $reporteDescripcion, string $aprendizNombre) {
        try {
            // Limpiar destinatarios anteriores
            $this->mail->clearAddresses();
            $this->mail->clearCCs();
            $this->mail->clearBCCs();

            // Verificar si hay destinatarios válidos
            if (empty($recipients)) {
                error_log("No hay destinatarios para enviar notificación.");
                return false;
            }

            // Destinatarios
            foreach ($recipients as $recipient) {
                if (isset($recipient->email) && filter_var($recipient->email, FILTER_VALIDATE_EMAIL)) {
                    $this->mail->addAddress($recipient->email, $recipient->nombre ?? 'Usuario');
                } else {
                    error_log("Email inválido ignorado: " . ($recipient->email ?? 'N/A'));
                }
            }

            // Contenido
            $this->mail->isHTML(true);                                  // Establecer formato de correo a HTML
            $this->mail->Subject = 'Nuevo Reporte de Retención Creado';
            $this->mail->Body    = "
                <html>
                <head>
                    <title>Nuevo Reporte de Retención</title>
                    <style>
                        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                        .container { width: 80%; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9; }
                        .header { background-color: #007bff; color: #fff; padding: 10px 20px; text-align: center; border-radius: 8px 8px 0 0; }
                        .content { padding: 20px; }
                        .footer { text-align: center; margin-top: 20px; font-size: 0.8em; color: #777; }
                        .button { display: inline-block; background-color: #28a745; color: #ffffff !important; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
                        .button:hover { background-color: #218838; }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <div class='header'>
                            <h2>¡Nuevo Reporte de Retención Creado!</h2>
                        </div>
                        <div class='content'>
                            <p>Estimado(a) usuario(a),</p>
                            <p>Se ha registrado un nuevo reporte de retención en el sistema.</p>
                            <p><strong>Descripción del Reporte:</strong> {$reporteDescripcion}</p>
                            <p><strong>Aprendiz Involucrado:</strong> {$aprendizNombre}</p>
                            <p>Por favor, inicie sesión en el sistema para revisar los detalles y tomar las acciones necesarias.</p>
                            <p style='text-align: center; margin-top: 30px;'>
                                
                            </p>
                        </div>
                        <div class='footer'>
                            <p>Este es un mensaje automático, por favor no responda a este correo.</p>
                            <p>&copy; " . date('Y') . " Sistema de Retención. Todos los derechos reservados.</p>
                        </div>
                    </div>
                </body>
                </html>
            ";
            $this->mail->AltBody = 'Se ha creado un nuevo reporte de retención. Descripción: ' . $reporteDescripcion . '. Aprendiz: ' . $aprendizNombre . '. Por favor, revise el sistema.';

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Error al enviar notificación de nuevo reporte: {$this->mail->ErrorInfo}");
            return false;
        }
    }
}