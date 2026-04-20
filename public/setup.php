<?php
// Este archivo sirve para inicializar la base de datos manualmente
// y verificar la conexión con las nuevas credenciales.

if (PHP_SAPI === 'cli') {
	putenv('TELAS_BI_LOCAL=1');
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../backend/db.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalación de Base de Datos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white font-sans flex items-center justify-center min-h-screen">
    <div class="max-w-md w-full bg-gray-800 p-8 rounded-xl border border-gray-700 shadow-2xl">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-white">Configuración DB</h1>
            <p class="text-gray-400 text-sm">Verificando conexión y tablas...</p>
        </div>

        <div class="space-y-4">
            <?php
            try {
                // 1. Intentar conexión
                echo '<div class="flex items-center gap-3 text-sm p-3 rounded bg-gray-700/50 border border-gray-600">';
                echo '<span class="text-blue-400">ℹ️</span> Intentando conectar...';
                echo '</div>';

                $pdo = get_pdo();
                
                echo '<div class="flex items-center gap-3 text-sm p-3 rounded bg-green-900/20 border border-green-500/30 text-green-400">';
                echo '<span>✅</span> Conexión exitosa a la base de datos.';
                echo '</div>';

                // 2. Ejecutar esquema
                provision_schema($pdo);
                
                echo '<div class="flex items-center gap-3 text-sm p-3 rounded bg-green-900/20 border border-green-500/30 text-green-400">';
                echo '<span>✅</span> Tablas verificadas/creadas correctamente.';
                echo '</div>';

                echo '<div class="mt-6 pt-6 border-t border-gray-700 text-center">';
                echo '<p class="mb-4 text-gray-300">Todo está listo. Ya puedes usar el sistema.</p>';
                echo '<a href="./index.html" class="inline-block bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-6 rounded-full transition-colors">Ir al Inicio</a>';
                echo '</div>';

            } catch (Throwable $e) {
                echo '<div class="p-4 rounded bg-red-900/20 border border-red-500/50 text-red-300 text-sm">';
                echo '<strong class="block mb-2 text-red-400">Error Crítico:</strong>';
                echo htmlspecialchars($e->getMessage());
                echo '</div>';
                
                echo '<p class="mt-4 text-xs text-gray-500 text-center">Revisa tus credenciales en <code>backend/config.php</code></p>';
            }
            ?>
        </div>
    </div>
</body>
</html>

