<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'message' => 'Método no permitido']);
    exit;
}

require_once __DIR__ . '/../../backend/db.php';

try {
    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true) ?: [];
    
    $email = trim((string)($data['email'] ?? ''));
    $sa1 = trim(strtolower((string)($data['sa1'] ?? '')));
    $sa2 = trim(strtolower((string)($data['sa2'] ?? '')));

    if ($email === '' || $sa1 === '' || $sa2 === '') {
        http_response_code(400);
        echo json_encode(['ok' => false, 'message' => 'Datos incompletos']);
        exit;
    }

    $pdo = get_pdo();
    $table = table_portal_users();
    
    // Obtener respuestas guardadas
    $stmt = $pdo->prepare("SELECT id, approved, security_answer_1, security_answer_2 FROM $table WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        http_response_code(404);
        echo json_encode(['ok' => false, 'message' => 'Usuario no encontrado']);
        exit;
    }

    // Validar respuestas (comparación simple en minúsculas)
    $dbSa1 = trim(strtolower($user['security_answer_1'] ?? ''));
    $dbSa2 = trim(strtolower($user['security_answer_2'] ?? ''));

    if ($sa1 !== $dbSa1 || $sa2 !== $dbSa2) {
        http_response_code(401); // Unauthorized
        echo json_encode(['ok' => false, 'message' => 'Respuestas incorrectas. Intenta de nuevo.']);
        exit;
    }

    // --- Si llegamos aquí, la identidad está verificada ---
    
    // Generar token para resetear contraseña
    $token = bin2hex(random_bytes(32));
    $tokenHash = hash('sha256', $token);
    $now = time();
    $expires = $now + 3600; // 1 hora

    if (db_driver() === 'mysql') {
        $sql = 'INSERT INTO password_resets (user_id, token_hash, created_at, expires_at, ip_address, user_agent) VALUES (:user_id, :token_hash, FROM_UNIXTIME(:created_at), FROM_UNIXTIME(:expires_at), :ip, :ua)';
    } else {
        $sql = 'INSERT INTO password_resets (user_id, token_hash, created_at, expires_at, ip_address, user_agent) VALUES (:user_id, :token_hash, to_timestamp(:created_at), to_timestamp(:expires_at), :ip, :ua)';
    }
    
    $pdo->prepare($sql)->execute([
        ':user_id' => (int)$user['id'],
        ':token_hash' => $tokenHash,
        ':created_at' => $now,
        ':expires_at' => $expires,
        ':ip' => $_SERVER['REMOTE_ADDR'] ?? null,
        ':ua' => substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 500),
    ]);

    // Devolver token al frontend para redirección inmediata
    echo json_encode([
        'ok' => true, 
        'message' => 'Identidad verificada', 
        'token' => $token
    ]);

} catch (Throwable $e) {
    log_app_error('verify_security error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['ok' => false, 'message' => 'Error del servidor']);
}

