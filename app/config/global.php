<?php

// Tiempo inactivo de 1 minuto | commit clase 13 prueba
define("INACTIVE_TIME", 1);
define("MAIN_APP_ROUTE", __DIR__.'/../app/');

// Configuración para PostgreSQL en Render
define("DRIVER", 'pgsql');  // Cambiado de 'mysql' a 'pgsql'
define("HOST", 'dpg-d3ofl53ipnbc73fva8pg-a.oregon-postgres.render.com'); // Host de Render PostgreSQL
define("USERNAME_DB", 'projectretention711_3c2x_user'); // Usuario de la BD en Render
define("PASSWORD_DB", 'bTspe32vczTss47SKDcnLRCfZ0CoaIKI'); // Password de Render
define("DATABASE", 'projectretention711_3c2x');  // Nombre de la base de datos en Render
define("PORT", 5432); // Puerto estándar de PostgreSQL
define("CHARSET", 'utf8'); // Charset para PostgreSQL

// Nota: Se eliminaron COLLATION ya que PostgreSQL maneja collation de forma diferente
?>