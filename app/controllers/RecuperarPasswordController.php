<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

require_once MAIN_APP_ROUTE . '../controllers/BaseController.php';
require_once MAIN_APP_ROUTE . '../models/UsuarioModel.php';

class RecuperarPasswordController extends BaseController {
    
    public function __construct() {
        // Se define la plantilla para este controlador
        $this->layout = "login_layout";
        // Llamamos al constructor del padre
        parent::__construct();
    }

    /**
     * Muestra el formulario de recuperación de contraseña
     */
    public function mostrarFormulario() {
        $data = [
            'title' => 'Recuperar Contraseña'
        ];
        $this->render('recuperarPassword/formulario.php', $data);
    }

    /**
     * Procesa la solicitud de recuperación de contraseña
     */
    public function procesarRecuperacion() {
        $errors = [];
        $success = false;
        $nuevaPassword = '';

        if (isset($_POST['txtEmail']) && isset($_POST['txtDocumento'])) {
            $email = trim($_POST['txtEmail']) ?? null;
            $documento = trim($_POST['txtDocumento']) ?? null;

            if ($email != "" && $documento != "") {
                // Validar formato de email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors = "El formato del email no es válido.";
                } else {
                    // Buscar usuario por email y documento
                    $usuarioModel = new UsuarioModel();
                    $usuario = $usuarioModel->buscarPorEmailYDocumento($email, $documento);

                    if ($usuario) {
                        // Generar nueva contraseña aleatoria
                        $nuevaPassword = $usuarioModel->generarPasswordAleatoria();
                        
                        // Actualizar contraseña en la base de datos
                        $resultado = $usuarioModel->actualizarPasswordPorEmail($email, $nuevaPassword);

                        if ($resultado) {
                            $success = true;
                            
                            // Aquí podrías implementar el envío por email si lo deseas
                            // $this->enviarEmailRecuperacion($email, $nuevaPassword, $usuario->firstName);
                            
                        } else {
                            $errors = "Error al actualizar la contraseña. Por favor, intente nuevamente.";
                        }
                    } else {
                        $errors = "No se encontró un usuario con ese email y número de documento.";
                    }
                }
            } else {
                $errors = "El email y el número de documento no pueden estar vacíos.";
            }
        } else {
            $errors = "Por favor, complete todos los campos.";
        }

        $data = [
            'title' => 'Recuperar Contraseña',
            'errors' => $errors,
            'success' => $success,
            'nuevaPassword' => $nuevaPassword,
            'email' => $email ?? ''
        ];

        $this->render('recuperarPassword/resultado.php', $data);
    }

    /**
     * Método para enviar email de recuperación (OPCIONAL - para implementación futura)
     */
    private function enviarEmailRecuperacion($email, $nuevaPassword, $nombreUsuario) {
        // Implementación básica de envío de email
        $asunto = "Recuperación de Contraseña - Sistema de Prevención de Deserción";
        $mensaje = "
        Hola $nombreUsuario,

        Se ha generado una nueva contraseña para tu cuenta en el Sistema de Prevención de Deserción.

        Tu nueva contraseña es: $nuevaPassword

        Por seguridad, te recomendamos cambiar esta contraseña después de iniciar sesión.

        Atentamente,
        Equipo del Sistema de Prevención de Deserción
        ";

        $headers = "From: no-reply@sistema-desercion.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Descomenta la siguiente línea cuando quieras activar el envío de emails
        // mail($email, $asunto, $mensaje, $headers);
        
        error_log("EMAIL SIMULADO para $email: Nueva contraseña - $nuevaPassword");
    }
}