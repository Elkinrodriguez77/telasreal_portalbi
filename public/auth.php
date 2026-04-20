<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Detectar la ruta base para redirigir correctamente
    // Si estamos en /public/dash/sales.php, queremos ir a ../login.php
    // Si estamos en /public/dashboards.php, queremos ir a ./login.php
    
    // Una forma robusta es usar una ruta absoluta basada en la ubicación del script
    // O simplemente asumir que login.php está en la carpeta padre de 'dash' o en la misma de 'dashboards'
    
    $uri = $_SERVER['REQUEST_URI'] ?? '/dashboards.php';
    
    // Ajuste simple: usar una ruta relativa al archivo actual si es posible, 
    // pero como auth.php se incluye, __DIR__ es fijo.
    // Lo mejor es definir una constante BASE_URL o detectar.
    
    // Solución rápida para tu estructura actual (/public/ es la base de la app web):
    // Si el script actual está en /dash/, subir un nivel.
    
    $prefix = './';
    if (strpos($_SERVER['SCRIPT_NAME'], '/dash/') !== false) {
        $prefix = '../';
    }
    
    $login = $prefix . 'login.php?next=' . urlencode($uri);
    header('Location: ' . $login);
    exit;
}
