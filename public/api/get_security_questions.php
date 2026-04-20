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

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['ok' => false, 'message' => 'Correo inválido']);
        exit;
    }

    $pdo = get_pdo();
    // Asegurar esquema por si acaso
    provision_schema($pdo);

    $table = table_portal_users();
    $stmt = $pdo->prepare("SELECT id, approved, security_question_1, security_question_2 FROM $table WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // Por seguridad, podemos decir "Usuario no encontrado" o ser vagos.
        // Dado que es una herramienta interna, seremos explícitos para ayudar al usuario.
        http_response_code(404);
        echo json_encode(['ok' => false, 'message' => 'El usuario no existe']);
        exit;
    }

    $approved = (int)($user['approved'] ?? 0);
    if ($approved !== 1 && $approved !== true) {
        http_response_code(403);
        echo json_encode(['ok' => false, 'message' => 'Tu usuario aún no ha sido aprobado por un administrador.']);
        exit;
    }

    // Verificar si tiene preguntas configuradas
    if (empty($user['security_question_1']) || empty($user['security_question_2'])) {
        http_response_code(400);
        echo json_encode(['ok' => false, 'message' => 'Este usuario no tiene preguntas de seguridad configuradas. Contacta a soporte.']);
        exit;
    }

    // Devolver las preguntas
    $map = [
        'mascota' => '¿Cuál es el nombre de tu primera mascota?',
        'ciudad' => '¿En qué ciudad nacieron tus padres?',
        'comida' => '¿Cuál es tu comida favorita?',
        'padre' => '¿Cuál es el segundo nombre de tu padre?',
        'trabajo' => '¿Cuál fue tu primer trabajo?',
        'colegio' => '¿Cómo se llamaba tu colegio de primaria?'
    ];

    $q1Label = $map[$user['security_question_1']] ?? $user['security_question_1'];
    $q2Label = $map[$user['security_question_2']] ?? $user['security_question_2'];

    echo json_encode([
        'ok' => true,
        'questions' => [
            'q1' => $q1Label,
            'q2' => $q2Label
        ]
    ]);

} catch (Throwable $e) {
    log_app_error('get_questions error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['ok' => false, 'message' => 'Error del servidor']);
}

