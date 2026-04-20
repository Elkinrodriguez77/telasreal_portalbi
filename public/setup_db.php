<?php
if (PHP_SAPI === 'cli') {
	putenv('TELAS_BI_LOCAL=1');
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../backend/db.php';

try {
    echo "<h1>Iniciando actualización de Base de Datos...</h1>";
    
    $pdo = get_pdo();
    echo "<p>Conexión exitosa a la base de datos.</p>";
    
    provision_schema($pdo);
    echo "<p>Función provision_schema ejecutada correctamente.</p>";
    
    // Verificación manual extra
    $table = table_portal_users();
    if (db_driver() === 'mysql') {
        echo "<p>Verificando columnas en la tabla <strong>$table</strong>...</p>";
        $stmt = $pdo->query("SHOW COLUMNS FROM `$table`");
        $cols = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        $needed = ['security_question_1', 'security_answer_1', 'security_question_2', 'security_answer_2'];
        $missing = [];
        
        foreach ($needed as $col) {
            if (in_array($col, $cols)) {
                echo "<span style='color:green'>✓ Columna $col existe.</span><br>";
            } else {
                echo "<span style='color:red'>✗ Columna $col NO existe. Intentando crear...</span><br>";
                $missing[] = $col;
            }
        }
        
        if (empty($missing)) {
            echo "<h2>✅ Base de datos actualizada correctamente.</h2>";
        } else {
            echo "<h2>⚠️ Faltan columnas. Revisa los permisos del usuario de BD.</h2>";
        }
    } else {
        echo "<h2>✅ Proceso completado (PostgreSQL detectado).</h2>";
    }
    
} catch (Throwable $e) {
    echo "<h2 style='color:red'>Error Crítico:</h2>";
    echo "<pre>" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</pre>";
    $msg = $e->getMessage();
    if (str_contains($msg, '1044')) {
        echo '<p><strong>El usuario MySQL existe, pero no tiene permisos sobre esa base de datos.</strong> Conéctate en Workbench como <code>root</code> (o un admin), elige la base correcta y ejecuta:</p>';
        echo '<pre>GRANT ALL PRIVILEGES ON telas_bi_local.* TO \'telas_local\'@\'localhost\';' . "\n" . 'FLUSH PRIVILEGES;</pre>';
        echo '<p>O en <strong>Server → Users and Privileges</strong> → usuario <code>telas_local</code> → pestaña <strong>Schema Privileges</strong> → añade el esquema <code>telas_bi_local</code> y marca los permisos (en local puedes usar <strong>ALL</strong>).</p>';
    } elseif (str_contains($msg, '1045')) {
        echo '<p><strong>MySQL rechazó el usuario o la contraseña.</strong> Revisa <code>.env</code> (<code>TELAS_BI_MYSQL_USER</code> / <code>TELAS_BI_MYSQL_PASSWORD</code>) o <code>backend/config.local.php</code>.</p>';
    }
    echo "<pre>" . htmlspecialchars($e->getTraceAsString(), ENT_QUOTES, 'UTF-8') . "</pre>";
}

