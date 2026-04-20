<?php
/**
 * Valores por defecto para desarrollo local (archivo versionado en el repo).
 *
 * Si accedes desde localhost / 127.0.0.1 / *.local, db.php fusiona este archivo
 * automáticamente sobre config.php: no hace falta copiar nada para probar en local.
 * En producción (host real) esta fusión no se aplica.
 *
 * Opcional: copia como backend/config.local.php para ajustes solo en tu PC; o define
 * TELAS_BI_MYSQL_PASSWORD en un archivo .env en la raíz del repo (ver .env.example).
 */
return [
	'mysql' => [
		'host' => '127.0.0.1',
		'port' => 3306,
		'dbname' => 'telas_bi_local',
		'user' => 'root',
		'password' => '',
		'charset' => 'utf8mb4',
	],
];
