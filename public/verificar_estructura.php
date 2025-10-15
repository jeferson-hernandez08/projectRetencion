<?php
// verificar_estructura.php
require_once 'config/global.php';

try {
    $dsn = "pgsql:host=" . HOST . ";port=" . PORT . ";dbname=" . DATABASE . ";sslmode=require";
    $pdo = new PDO($dsn, USERNAME_DB, PASSWORD_DB);
    
    echo "<h3>Estructura de tabla 'users':</h3>";
    $columns = $pdo->query("SELECT column_name, data_type FROM information_schema.columns WHERE table_name = 'users'")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($columns as $col) {
        echo "Columna: <b>{$col['column_name']}</b> ({$col['data_type']})<br>";
    }
    
    echo "<h3>Estructura de tabla 'rols':</h3>";
    $columns = $pdo->query("SELECT column_name, data_type FROM information_schema.columns WHERE table_name = 'rols'")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($columns as $col) {
        echo "Columna: <b>{$col['column_name']}</b> ({$col['data_type']})<br>";
    }
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>