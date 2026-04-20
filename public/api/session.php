<?php
declare(strict_types=1);
session_start();
header('Content-Type: application/json; charset=utf-8');

$auth = isset($_SESSION['user_id']);
$response = [
	'ok' => true,
	'authenticated' => $auth,
];
if ($auth) {
	$response['user'] = [
		'id' => (int)($_SESSION['user_id'] ?? 0),
		'name' => (string)($_SESSION['user_name'] ?? ''),
		'email' => (string)($_SESSION['user_email'] ?? ''),
	];
}

echo json_encode($response);
