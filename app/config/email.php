<?php
// Configuración de PHPMailer para Gmail
// IMPORTANTE: Reemplaza los valores con tus datos reales. No subas este archivo a Git sin ocultar las credenciales.

define('MAIL_HOST', 'smtp.gmail.com');  // Servidor SMTP fijo para Gmail (no cambies esto)

define('MAIL_USERNAME', 'sistema.retencion@gmail.com');  // Tu dirección de Gmail DEDICADA para enviar correos (ej. crea una nueva cuenta para el sistema)

define('MAIL_PASSWORD', 'iyef vccc qzoc coqv');  // La CONTRASEÑA DE APLICACIÓN de 16 caracteres (generada en Google, NO tu contraseña normal). Ejemplo: reemplaza con la tuya.

define('MAIL_SMTPSECURE', 'tls');  // Encriptación: 'tls' para puerto 587 (recomendado para Gmail). Si usas SSL, cambia a 'ssl' y puerto 465.

define('MAIL_PORT', 587);  // Puerto: 587 para TLS (estándar para Gmail). Si usas SSL, cambia a 465.

define('MAIL_FROM_EMAIL', 'sistema.retencion@gmail.com');  // Email del remitente (debe coincidir con MAIL_USERNAME para evitar rechazos de Gmail)

define('MAIL_FROM_NAME', 'Sistema de Retención');  // Nombre visible del remitente (puede ser lo que quieras, ej. 'Soporte Retención')