<?php
declare(strict_types=1);

/**
 * Entorno local: navegador en localhost / 127.0.0.1 / *.local, o CLI con TELAS_BI_LOCAL=1
 * (setup_db.php y setup.php marcan CLI automáticamente).
 * En producción (host real) no aplica y solo se usa config.php (+ config.local.php si existiera).
 */
function bi_is_local_environment(): bool {
	$flag = getenv('TELAS_BI_LOCAL');
	if ($flag !== false && $flag !== '') {
		$flag = strtolower(trim($flag));
		if (in_array($flag, ['1', 'true', 'yes', 'local'], true)) {
			return true;
		}
		if (in_array($flag, ['0', 'false', 'no', 'production', 'prod'], true)) {
			return false;
		}
	}
	$host = strtolower($_SERVER['HTTP_HOST'] ?? '');
	if ($host !== '') {
		if ($host === 'localhost' || $host === '127.0.0.1' || str_starts_with($host, 'localhost:') || str_starts_with($host, '127.0.0.1:')) {
			return true;
		}
		if (str_ends_with($host, '.localhost') || str_ends_with($host, '.test') || str_ends_with($host, '.local')) {
			return true;
		}
		if ($host === '[::1]' || str_starts_with($host, '[::1]:')) {
			return true;
		}
	}
	$sn = strtolower($_SERVER['SERVER_NAME'] ?? '');
	if ($sn !== '' && in_array($sn, ['localhost', '127.0.0.1'], true)) {
		return true;
	}
	return false;
}

/** Carga .env simple (solo KEY=VAL) una vez por ruta; no sustituye variables ya definidas en el sistema. */
function bi_dotenv_load_if_present(string $path): void {
	static $loaded = [];
	if (!is_readable($path)) {
		return;
	}
	$key = realpath($path) ?: $path;
	if (isset($loaded[$key])) {
		return;
	}
	$loaded[$key] = true;
	$lines = file($path, FILE_IGNORE_NEW_LINES);
	if ($lines === false) {
		return;
	}
	foreach ($lines as $line) {
		$line = trim($line);
		if ($line === '' || str_starts_with($line, '#')) {
			continue;
		}
		if (!str_contains($line, '=')) {
			continue;
		}
		[$name, $value] = explode('=', $line, 2);
		$name = trim($name);
		if ($name === '') {
			continue;
		}
		$value = trim($value);
		if (
			(strlen($value) >= 2)
			&& (($value[0] === '"' && str_ends_with($value, '"')) || ($value[0] === "'" && str_ends_with($value, "'")))
		) {
			$value = substr($value, 1, -1);
		}
		if (getenv($name) !== false) {
			continue;
		}
		putenv("{$name}={$value}");
		$_ENV[$name] = $value;
	}
}

/** En local: ajusta mysql con variables de entorno (p. ej. desde .env en la raíz del repo). */
function bi_mysql_config_with_local_env(array $mysql): array {
	$map = [
		'TELAS_BI_MYSQL_HOST' => 'host',
		'TELAS_BI_MYSQL_PORT' => 'port',
		'TELAS_BI_MYSQL_DB' => 'dbname',
		'TELAS_BI_MYSQL_DBNAME' => 'dbname',
		'TELAS_BI_MYSQL_USER' => 'user',
	];
	foreach ($map as $env => $cfgKey) {
		$v = getenv($env);
		if ($v === false || $v === '') {
			continue;
		}
		if ($cfgKey === 'port') {
			$mysql['port'] = (int) $v;
		} else {
			$mysql[$cfgKey] = $v;
		}
	}
	$pw = getenv('TELAS_BI_MYSQL_PASSWORD');
	if ($pw !== false) {
		$mysql['password'] = $pw;
	}
	return $mysql;
}

function app_config(): array {
	static $cached = null;
	if ($cached !== null) {
		return $cached;
	}
	if (bi_is_local_environment()) {
		bi_dotenv_load_if_present(dirname(__DIR__) . '/.env');
		bi_dotenv_load_if_present(__DIR__ . '/.env');
	}
	$configPath = __DIR__ . '/config.php';
	if (!file_exists($configPath)) {
		$configPath = __DIR__ . '/config.sample.php';
	}
	$config = require $configPath;
	$repoLocalSample = __DIR__ . '/config.local.sample.php';
	if (bi_is_local_environment() && file_exists($repoLocalSample)) {
		$sample = require $repoLocalSample;
		if (is_array($sample)) {
			$config = array_replace_recursive($config, $sample);
		}
	}
	$localPath = __DIR__ . '/config.local.php';
	if (file_exists($localPath)) {
		$local = require $localPath;
		if (is_array($local)) {
			$config = array_replace_recursive($config, $local);
		}
	}
	if (bi_is_local_environment() && isset($config['mysql']) && is_array($config['mysql'])) {
		$config['mysql'] = bi_mysql_config_with_local_env($config['mysql']);
	}
	$cached = $config;
	return $cached;
}

function log_app_error(string $message): void {
	$line = '[' . date('c') . "] " . $message . "\n";
	@file_put_contents(__DIR__ . '/error.log', $line, FILE_APPEND);
}

function db_driver(): string {
	$cfg = app_config();
	return isset($cfg['mysql']) ? 'mysql' : 'pg';
}

function table_portal_users(): string {
	return 'portal_users';
}

function get_pdo(): PDO {
	if (db_driver() === 'mysql') {
		$cfg = app_config()['mysql'];
		$charset = $cfg['charset'] ?? 'utf8mb4';
		$dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=%s', (string)$cfg['host'], (int)$cfg['port'], (string)$cfg['dbname'], $charset);
		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES => false,
		];
		return new PDO($dsn, $cfg['user'], $cfg['password'], $options);
	}

	$cfg = app_config()['pg'];
	$sslmode = $cfg['sslmode'] ?? 'require';
	$connectTimeout = isset($cfg['connect_timeout']) ? (int)$cfg['connect_timeout'] : 5;
	$forceIPv4 = (bool)($cfg['force_ipv4'] ?? false);

	$host = (string)$cfg['host'];
	$port = (int)$cfg['port'];
	$dbname = (string)$cfg['dbname'];

	$dsn = sprintf('pgsql:host=%s;port=%d;dbname=%s;sslmode=%s;connect_timeout=%d;gssencmode=disable', $host, $port, $dbname, $sslmode, $connectTimeout);

	if ($forceIPv4 && stripos($sslmode, 'verify') === false) {
		$ipv4List = @gethostbynamel($host) ?: [];
		if (count($ipv4List) > 0) {
			$dsn .= ';hostaddr=' . $ipv4List[0];
		}
	}

	$sslrootcert = $cfg['sslrootcert'] ?? '';
	if ($sslrootcert === '' && in_array($sslmode, ['require', 'verify-ca', 'verify-full'], true)) {
		$candidates = [
			'/etc/pki/tls/certs/ca-bundle.crt',
			'/etc/ssl/certs/ca-bundle.crt',
			'/etc/ssl/cert.pem',
			'/etc/ssl/certs/ca-certificates.crt',
			'/etc/pki/ca-trust/extracted/pem/tls-ca-bundle.pem',
		];
		foreach ($candidates as $path) {
			if (@is_readable($path)) { $sslrootcert = $path; break; }
		}
	}
	if ($sslrootcert !== '') {
		$dsn .= ';sslrootcert=' . $sslrootcert;
	}

	$options = [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	];
	try {
		return new PDO($dsn, $cfg['user'], $cfg['password'], $options);
	} catch (Throwable $e) {
		$errMsg = (string)$e->getMessage();
		log_app_error('PDO connection failed (attempt 1): ' . $errMsg);
		if (stripos($errMsg, 'SSL connection has been closed unexpectedly') !== false) {
			$altModes = [];
			if (strcasecmp($sslmode, 'require') !== 0) $altModes[] = 'require';
			if (strcasecmp($sslmode, 'verify-full') !== 0) $altModes[] = 'verify-full';
			foreach ($altModes as $mode) {
				$dsnRetry = preg_replace('/sslmode=[^;]+/i', 'sslmode=' . $mode, $dsn);
				$dsnRetry = preg_replace('/;hostaddr=[^;]+/i', '', $dsnRetry);
				try {
					return new PDO($dsnRetry, $cfg['user'], $cfg['password'], $options);
				} catch (Throwable $e2) {
					log_app_error('PDO connection failed (retry ' . $mode . '): ' . $e2->getMessage());
				}
			}
		}
		throw $e;
	}
}

function verify_recaptcha(string $token, string $remoteIp = ''): bool {
	$secret = app_config()['recaptcha_secret'] ?? '';
	if ($secret === '' || $token === '') return false;
	$payload = http_build_query([
		'secret' => $secret,
		'response' => $token,
		'remoteip' => $remoteIp,
	]);
	$opts = [
		'http' => [
			'method' => 'POST',
			'header' => "Content-type: application/x-www-form-urlencoded\r\n",
			'content' => $payload,
			'timeout' => 8,
		],
	];
	$context = stream_context_create($opts);
	$result = @file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
	if ($result === false) {
		log_app_error('reCAPTCHA request failed');
		return false;
	}
	$data = json_decode($result, true);
	return is_array($data) && ($data['success'] ?? false) === true;
}

function add_column_if_not_exists(PDO $pdo, string $table, string $column, string $definition): void {
	if (db_driver() === 'mysql') {
		$stmt = $pdo->prepare("SHOW COLUMNS FROM `$table` LIKE ?");
		$stmt->execute([$column]);
		if (!$stmt->fetch()) {
			$pdo->exec("ALTER TABLE `$table` ADD COLUMN $column $definition");
		}
	} else {
		// Postgres
		$stmt = $pdo->prepare("SELECT column_name FROM information_schema.columns WHERE table_name = ? AND column_name = ?");
		$stmt->execute([$table, $column]);
		if (!$stmt->fetch()) {
			$pdo->exec("ALTER TABLE $table ADD COLUMN $column $definition");
		}
	}
}

function provision_schema(PDO $pdo): void {
	try {
		$table = table_portal_users();
		if (db_driver() === 'mysql') {
			$pdo->exec(
				"CREATE TABLE IF NOT EXISTS `$table` (
					id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					full_name VARCHAR(255) NOT NULL,
					email VARCHAR(255) NOT NULL UNIQUE,
					department VARCHAR(255) NULL,
					reason TEXT NULL,
					approved TINYINT(1) NOT NULL DEFAULT 0,
					created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
					approved_at TIMESTAMP NULL DEFAULT NULL,
					ip_address VARCHAR(45) NULL,
					user_agent VARCHAR(500) NULL,
					password_hash TEXT NULL,
                    security_question_1 VARCHAR(255) NULL,
                    security_answer_1 VARCHAR(255) NULL,
                    security_question_2 VARCHAR(255) NULL,
                    security_answer_2 VARCHAR(255) NULL
				) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
			);
            
            // Asegurar que las columnas nuevas existan si la tabla ya existía
            add_column_if_not_exists($pdo, $table, 'security_question_1', 'VARCHAR(255) NULL');
            add_column_if_not_exists($pdo, $table, 'security_answer_1', 'VARCHAR(255) NULL');
            add_column_if_not_exists($pdo, $table, 'security_question_2', 'VARCHAR(255) NULL');
            add_column_if_not_exists($pdo, $table, 'security_answer_2', 'VARCHAR(255) NULL');

			$pdo->exec(
				"CREATE TABLE IF NOT EXISTS `password_resets` (
					id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					user_id BIGINT UNSIGNED NOT NULL,
					token_hash CHAR(64) NOT NULL UNIQUE,
					created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
					expires_at TIMESTAMP NOT NULL,
					used_at TIMESTAMP NULL DEFAULT NULL,
					ip_address VARCHAR(45) NULL,
					user_agent VARCHAR(500) NULL,
					INDEX (user_id)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
			);
		} else {
			// Postgres logic remains similar... omitted for brevity as user is on MySQL primarily
            $pdo->exec('CREATE EXTENSION IF NOT EXISTS citext');
			$pdo->exec(
				"CREATE TABLE IF NOT EXISTS $table (
					id BIGSERIAL PRIMARY KEY,
					full_name TEXT NOT NULL,
					email CITEXT NOT NULL UNIQUE,
					department TEXT,
					reason TEXT,
					approved BOOLEAN NOT NULL DEFAULT FALSE,
					created_at TIMESTAMPTZ NOT NULL DEFAULT NOW(),
					approved_at TIMESTAMPTZ,
					ip_address INET,
					user_agent TEXT,
					password_hash TEXT,
                    security_question_1 TEXT NULL,
                    security_answer_1 TEXT NULL,
                    security_question_2 TEXT NULL,
                    security_answer_2 TEXT NULL
				)"
			);
            add_column_if_not_exists($pdo, $table, 'security_question_1', 'TEXT NULL');
            add_column_if_not_exists($pdo, $table, 'security_answer_1', 'TEXT NULL');
            add_column_if_not_exists($pdo, $table, 'security_question_2', 'TEXT NULL');
            add_column_if_not_exists($pdo, $table, 'security_answer_2', 'TEXT NULL');

			$pdo->exec(
				"CREATE TABLE IF NOT EXISTS password_resets (
					id BIGSERIAL PRIMARY KEY,
					user_id BIGINT NOT NULL,
					token_hash TEXT NOT NULL UNIQUE,
					created_at TIMESTAMPTZ NOT NULL DEFAULT NOW(),
					expires_at TIMESTAMPTZ NOT NULL,
					used_at TIMESTAMPTZ,
					ip_address INET,
					user_agent TEXT
				)"
			);
		}
	} catch (Throwable $e) {
		log_app_error('Schema provision failed: ' . $e->getMessage());
	}
}
