<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'message' => 'Método no permitido']);
    exit;
}

require_once __DIR__ . '/../../backend/db.php';

function respond(bool $ok, string $msg, array $extra = []): void {
    echo json_encode(array_merge(['ok' => $ok, 'message' => $msg], $extra));
    exit;
}

try {
    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true) ?: [];
    $email = trim((string)($data['email'] ?? ''));
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        respond(false, 'Correo inválido');
    }

    $pdo = get_pdo();
    provision_schema($pdo);

    $table = table_portal_users();
    $stmt = $pdo->prepare("SELECT id, approved FROM $table WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        http_response_code(404);
        respond(false, 'No existe usuario');
    }
    $approved = (int)($user['approved'] ?? 0);
    if ($approved !== 1 && $approved !== true) {
        http_response_code(403);
        respond(false, 'Usuario no aprobado');
    }

    // Generar token y guardar hash
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

    // Devolver token para redirigir a reset.php inmediatamente
    $base = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https://' : 'http://') . ($_SERVER['HTTP_HOST'] ?? '');
    $link = $base . '/reset.php?token=' . $token;
    respond(true, 'OK', ['token' => $token, 'reset_link' => $link]);
} catch (Throwable $e) {
    log_app_error('request_reset error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['ok' => false, 'message' => 'Error del servidor']);
}


