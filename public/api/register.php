<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	http_response_code(405);
	echo json_encode(['ok' => false, 'message' => 'Método no permitido']);
	exit;
}

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
if (!is_array($data)) {
	http_response_code(400);
	echo json_encode(['ok' => false, 'message' => 'Formato inválido']);
	exit;
}

function respondError(string $msg, int $code = 400) {
	http_response_code($code);
	echo json_encode(['ok' => false, 'message' => $msg]);
	exit;
}

$fullName = trim((string)($data['full_name'] ?? ''));
$email = trim((string)($data['email'] ?? ''));
$password = (string)($data['password'] ?? '');
$passwordConfirm = (string)($data['password_confirm'] ?? '');
$department = trim((string)($data['department'] ?? ''));
$reason = trim((string)($data['reason'] ?? ''));
$honeypot = trim((string)($data['hp_website'] ?? ''));
$recaptcha = (string)($data['recaptcha'] ?? '');

// Nuevos campos de seguridad
$sq1 = trim((string)($data['sq1'] ?? ''));
$sa1 = trim((string)($data['sa1'] ?? ''));
$sq2 = trim((string)($data['sq2'] ?? ''));
$sa2 = trim((string)($data['sa2'] ?? ''));

if ($honeypot !== '') respondError('Solicitud inválida');
if ($fullName === '' || mb_strlen($fullName) < 3) respondError('Nombre inválido');
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) respondError('Correo inválido');
if ($password === '' || strlen($password) < 8) respondError('Contraseña muy corta');
if ($password !== $passwordConfirm) respondError('Las contraseñas no coinciden');

// Validar preguntas de seguridad
if ($sq1 === '' || $sa1 === '' || $sq2 === '' || $sa2 === '') respondError('Preguntas de seguridad incompletas');

require_once __DIR__ . '/../../backend/db.php';
$cfg = app_config();
$allowedDomains = $cfg['allowed_email_domains'] ?? [];
if (is_array($allowedDomains) && count($allowedDomains) > 0) {
	$domain = strtolower(substr(strrchr($email, "@") ?: '', 1));
	$isAllowed = in_array($domain, array_map('strtolower', $allowedDomains), true);
	if (!$isAllowed) respondError('Correo no permitido');
}

$remoteIp = $_SERVER['REMOTE_ADDR'] ?? '';
if (!verify_recaptcha($recaptcha, $remoteIp)) {
	respondError('reCAPTCHA inválido');
}

try {
	$pdo = get_pdo();
	provision_schema($pdo);
	$hash = password_hash($password, PASSWORD_DEFAULT);
	$table = table_portal_users();
	if (db_driver() === 'mysql') {
		$sql = "INSERT IGNORE INTO `$table` (full_name, email, department, reason, approved, ip_address, user_agent, password_hash, security_question_1, security_answer_1, security_question_2, security_answer_2) VALUES (:full_name, :email, :department, :reason, 0, :ip_address, :user_agent, :password_hash, :sq1, :sa1, :sq2, :sa2)";
	} else {
		$sql = "INSERT INTO $table (full_name, email, department, reason, approved, ip_address, user_agent, password_hash, security_question_1, security_answer_1, security_question_2, security_answer_2) VALUES (:full_name, :email, :department, :reason, FALSE, :ip_address, :user_agent, :password_hash, :sq1, :sa1, :sq2, :sa2) ON CONFLICT (email) DO NOTHING";
	}
	$stmt = $pdo->prepare($sql);
	$stmt->execute([
		':full_name' => $fullName,
		':email' => $email,
		':department' => $department !== '' ? $department : null,
		':reason' => $reason !== '' ? $reason : null,
		':ip_address' => $remoteIp,
		':user_agent' => substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 500),
		':password_hash' => $hash,
        ':sq1' => $sq1,
        ':sa1' => strtolower($sa1), // Guardamos respuesta normalizada
        ':sq2' => $sq2,
        ':sa2' => strtolower($sa2)
	]);
	if ($stmt->rowCount() === 0) {
		echo json_encode(['ok' => true, 'message' => 'Solicitud ya recibida. Estamos procesando.']);
		exit;
	}
	echo json_encode(['ok' => true, 'message' => 'Solicitud enviada. Queda pendiente de aprobación.']);
} catch (Throwable $e) {
	log_app_error('register error: ' . $e->getMessage());
	http_response_code(500);
	echo json_encode(['ok' => false, 'message' => 'Error del servidor']);
}
