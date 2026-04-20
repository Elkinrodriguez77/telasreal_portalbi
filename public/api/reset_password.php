<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'message' => 'Método no permitido']);
    exit;
}

require_once __DIR__ . '/../../backend/db.php';

function respond(bool $ok, string $msg): void {
    echo json_encode(['ok' => $ok, 'message' => $msg]);
    exit;
}

try {
    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true) ?: [];
    $token = (string)($data['token'] ?? '');
    $password = (string)($data['password'] ?? '');
    $passwordConfirm = (string)($data['password_confirm'] ?? '');
    if ($token === '' || strlen($token) < 64) { http_response_code(400); respond(false, 'Token inválido'); }
    if ($password === '' || strlen($password) < 8) { http_response_code(400); respond(false, 'Contraseña muy corta'); }
    if ($password !== $passwordConfirm) { http_response_code(400); respond(false, 'Las contraseñas no coinciden'); }

    $pdo = get_pdo();
    provision_schema($pdo);

    $tokenHash = hash('sha256', $token);
    // Buscar token válido
    $sql = 'SELECT id, user_id, used_at, ' . (db_driver()==='mysql' ? 'UNIX_TIMESTAMP(expires_at)' : 'EXTRACT(EPOCH FROM expires_at)') . ' AS exp FROM password_resets WHERE token_hash = :h LIMIT 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':h' => $tokenHash]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) { http_response_code(400); respond(false, 'Token inválido'); }
    if (!empty($row['used_at'])) { http_response_code(400); respond(false, 'Token ya utilizado'); }
    if ((int)$row['exp'] < time()) { http_response_code(400); respond(false, 'Token expirado'); }

    // Actualizar contraseña
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $table = table_portal_users();
    $pdo->beginTransaction();
    $pdo->prepare("UPDATE $table SET password_hash = :p WHERE id = :id")->execute([
        ':p' => $hash,
        ':id' => (int)$row['user_id'],
    ]);
    $markSql = db_driver()==='mysql'
        ? 'UPDATE password_resets SET used_at = NOW() WHERE id = :id'
        : 'UPDATE password_resets SET used_at = NOW() WHERE id = :id';
    $pdo->prepare($markSql)->execute([':id' => (int)$row['id']]);
    $pdo->commit();

    respond(true, 'Contraseña actualizada');
} catch (Throwable $e) {
    if ($pdo && $pdo->inTransaction()) { $pdo->rollBack(); }
    log_app_error('reset_password error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['ok' => false, 'message' => 'Error del servidor']);
}


