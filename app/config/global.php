<?php

// Tiempo inactivo de 1 minuto | commit clase 13 prueba
define("INACTIVE_TIME", 1);
define("MAIN_APP_ROUTE", __DIR__.'/../app/');

// Configuración para PostgreSQL en Render
define("DRIVER", 'pgsql');  // Cambiado de 'mysql' a 'pgsql'
define("HOST", 'dpg-d34m086r433s73co6ia0-a.oregon-postgres.render.com'); // Host de Render PostgreSQL
define("USERNAME_DB", 'projectretention711_user'); // Usuario de la BD en Render
define("PASSWORD_DB", 'wqDspLygZaNE01sQmYUqV9lv76PURhPa'); // Password de Render
define("DATABASE", 'projectretention711');  // Nombre de la base de datos en Render
define("PORT", 5432); // Puerto estándar de PostgreSQL
define("CHARSET", 'utf8'); // Charset para PostgreSQL

// Nota: Se eliminaron COLLATION ya que PostgreSQL maneja collation de forma diferente
?>