<?php
declare(strict_types=1);
session_start();
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	http_response_code(405);
	echo json_encode(['ok' => false, 'message' => 'Método no permitido']);
	exit;
}

$raw = file_get_contents('php://input');
$payload = json_decode($raw, true) ?: [];
$email = trim((string)($payload['email'] ?? ''));
$password = (string)($payload['password'] ?? '');
if ($email === '' || $password === '') {
	http_response_code(400);
	echo json_encode(['ok' => false, 'message' => 'Credenciales requeridas']);
	exit;
}

require_once __DIR__ . '/../../backend/db.php';
try {
	$pdo = get_pdo();
	provision_schema($pdo);
	$table = table_portal_users();
	$stmt = $pdo->prepare("SELECT id, full_name, email, password_hash, approved FROM $table WHERE email = :email");
	$stmt->execute([':email' => $email]);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	if (!$user) {
			http_response_code(401);
			echo json_encode(['ok' => false, 'message' => 'Usuario o contraseña inválidos']);
			exit;
	}
	$approved = filter_var($user['approved'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
	if ($approved !== true) {
			http_response_code(403);
			echo json_encode(['ok' => false, 'message' => 'Tu usuario aún no está aprobado']);
			exit;
	}
	if (!password_verify($password, (string)$user['password_hash'])) {
			http_response_code(401);
			echo json_encode(['ok' => false, 'message' => 'Usuario o contraseña inválidos']);
			exit;
	}
	$_SESSION['user_id'] = (int)$user['id'];
	$_SESSION['user_name'] = (string)$user['full_name'];
	$_SESSION['user_email'] = (string)$user['email'];
	echo json_encode(['ok' => true]);
} catch (Throwable $e) {
	log_app_error('login error: ' . $e->getMessage());
	http_response_code(500);
	echo json_encode(['ok' => false, 'message' => 'Error del servidor']);
}
