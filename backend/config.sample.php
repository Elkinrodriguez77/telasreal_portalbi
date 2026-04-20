<?php
/**
 * Copia este archivo como config.php y completa los valores.
 * config.php no debe subirse al repositorio (está en .gitignore).
 */
return [
	'mysql' => [
		'host' => 'localhost',
		'port' => 3306,
		'dbname' => 'tu_base_de_datos',
		'user' => 'tu_usuario_mysql',
		'password' => 'tu_contraseña',
		'charset' => 'utf8mb4',
	],
	'recaptcha_secret' => 'TU_CLAVE_SECRETA_RECAPTCHA',
	'recaptcha_site_key' => 'TU_CLAVE_DE_SITIO_RECAPTCHA',
	'allowed_email_domains' => [
		'asesorgroup.com.co',
	],
];
