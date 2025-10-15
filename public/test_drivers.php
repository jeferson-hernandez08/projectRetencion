<?php
echo "<h3>🔍 Test de Drivers PDO y Conexión PostgreSQL</h3>";

// 1. Verificar drivers PDO disponibles
echo "<b>1. Drivers PDO disponibles:</b><br>";
$drivers = PDO::getAvailableDrivers();
if (in_array('pgsql', $drivers)) {
    echo "✅ pgsql - INSTALADO<br>";
} else {
    echo "❌ pgsql - NO INSTALADO<br>";
}
echo "Todos los drivers: " . implode(', ', $drivers) . "<br><br>";

// 2. Test de conexión a PostgreSQL
echo "<b>2. Test de conexión a PostgreSQL:</b><br>";

// RUTA CORREGIDA - config está DENTRO de app
$configPath = __DIR__ . '/../app/config/global.php';
if (file_exists($configPath)) {
    require_once $configPath;
    echo "✅ Archivo de configuración cargado correctamente<br>";
    echo "✅ Ruta: " . $configPath . "<br>";
} else {
    echo "❌ No se pudo encontrar el archivo de configuración en: " . $configPath . "<br>";
    
    // Intentar rutas alternativas
    $alternativePaths = [
        __DIR__ . '/../../config/global.php',
        __DIR__ . '/../config/global.php', 
        __DIR__ . '/../../../config/global.php'
    ];
    
    foreach ($alternativePaths as $altPath) {
        if (file_exists($altPath)) {
            require_once $altPath;
            echo "✅ Archivo encontrado en ruta alternativa: " . $altPath . "<br>";
            break;
        }
    }
    
    if (!defined('DRIVER')) {
        echo "❌ No se pudo cargar la configuración en ninguna ruta<br>";
        exit;
    }
}

try {
    $dsn = DRIVER . ':host=' . HOST . ';port=' . PORT . ';dbname=' . DATABASE . ';sslmode=require';
    echo "✅ DSN: " . $dsn . "<br>";
    
    $pdo = new PDO($dsn, USERNAME_DB, PASSWORD_DB);
    
    echo "✅ CONEXIÓN EXITOSA a PostgreSQL<br>";
    
    // 3. Ver información de la conexión
    echo "✅ Host: " . HOST . "<br>";
    echo "✅ Base de datos: " . DATABASE . "<br>";
    
    // 4. Ver versión de PostgreSQL
    $version = $pdo->query('SELECT version()')->fetchColumn();
    echo "✅ Versión PostgreSQL: " . $version . "<br>";
    
    // 5. Listar tablas disponibles
    echo "<br><b>3. Tablas en la base de datos:</b><br>";
    $tables = $pdo->query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'")->fetchAll(PDO::FETCH_COLUMN);
    
    if (empty($tables)) {
        echo "❌ No se encontraron tablas en la base de datos<br>";
    } else {
        foreach ($tables as $table) {
            echo "✅ Tabla: " . $table . "<br>";
        }
        
        // 6. Estructura detallada de tablas
        echo "<br><b>4. Estructura detallada de tablas:</b><br>";
        foreach ($tables as $table) {
            echo "<br><b>Tabla: $table</b><br>";
            $columns = $pdo->query("SELECT column_name, data_type, is_nullable 
                                   FROM information_schema.columns 
                                   WHERE table_name = '$table' 
                                   ORDER BY ordinal_position")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($columns as $col) {
                echo " - {$col['column_name']} ({$col['data_type']}) " . 
                     ($col['is_nullable'] == 'NO' ? 'NOT NULL' : 'NULL') . "<br>";
            }
        }
    }
    
} catch (PDOException $e) {
    echo "❌ ERROR de conexión: " . $e->getMessage() . "<br>";
    
    // Información adicional para debugging
    echo "<br><b>Debug info:</b><br>";
    echo "Usuario: " . USERNAME_DB . "<br>";
    echo "¿Password definido?: " . (PASSWORD_DB ? 'SÍ (' . strlen(PASSWORD_DB) . ' caracteres)' : 'NO') . "<br>";
    echo "Error completo: " . $e->getMessage() . "<br>";
}
?>