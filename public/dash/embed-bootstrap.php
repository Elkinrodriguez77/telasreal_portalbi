<?php
declare(strict_types=1);

/**
 * Carga URLs de informes Power BI solo desde embed-config.php (archivo local, en .gitignore).
 */
$configPath = __DIR__ . '/embed-config.php';
if (!is_readable($configPath)) {
    http_response_code(503);
    header('Content-Type: text/html; charset=UTF-8');
    echo '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Configuración pendiente</title></head>';
    echo '<body style="font-family:system-ui,sans-serif;padding:2rem;max-width:36rem;background:#0a0a0f;color:#e2e8f0;line-height:1.6">';
    echo '<h1 style="font-size:1.25rem;margin-bottom:1rem;">Falta la configuración de los informes embebidos</h1>';
    echo '<p style="color:#94a3b8;">Copia <code style="background:#1e293b;padding:0.15em 0.4em;border-radius:4px;color:#f8fafc">public/dash/embed-config.sample.php</code> a <code style="background:#1e293b;padding:0.15em 0.4em;border-radius:4px;color:#f8fafc">public/dash/embed-config.php</code> y completa las URLs publicadas en Power BI. Ese archivo no se versiona ni debe subirse a GitHub.</p>';
    echo '</body></html>';
    exit;
}

$dashEmbedCfg = require $configPath;
if (!is_array($dashEmbedCfg)) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=UTF-8');
    exit('embed-config.php debe devolver un array.');
}

$dashEmbedKeys = ['gestion_b2b', 'ventas_360'];
foreach ($dashEmbedKeys as $key) {
    $url = $dashEmbedCfg[$key] ?? null;
    if (!is_string($url) || trim($url) === '') {
        http_response_code(500);
        header('Content-Type: text/html; charset=UTF-8');
        echo '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>Error de configuración</title></head><body style="font-family:system-ui,sans-serif;padding:2rem;background:#0a0a0f;color:#e2e8f0">';
        echo '<h1 style="font-size:1.25rem">embed-config.php incompleto</h1>';
        echo '<p style="color:#94a3b8">Define una URL no vacía para la clave <code>' . htmlspecialchars($key, ENT_QUOTES, 'UTF-8') . '</code>.</p></body></html>';
        exit;
    }
}

$DASH_EMBED = $dashEmbedCfg;
