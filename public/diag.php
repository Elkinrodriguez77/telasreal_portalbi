<?php
declare(strict_types=1);
ini_set('display_errors','1');
error_reporting(E_ALL);

require_once __DIR__ . '/../backend/db.php';

header('Content-Type: application/json; charset=utf-8');

$report = [
  'php_version' => PHP_VERSION,
  'extensions' => [
    'pdo' => extension_loaded('pdo'),
    'pdo_pgsql' => extension_loaded('pdo_pgsql'),
    'pgsql' => extension_loaded('pgsql'),
    'pdo_mysql' => extension_loaded('pdo_mysql'),
    'mysqli' => extension_loaded('mysqli'),
  ],
  'openssl' => defined('OPENSSL_VERSION_TEXT') ? OPENSSL_VERSION_TEXT : 'n/a',
];

// Mostrar config mínima de conexión (sin secretos)
try {
  $driver = function_exists('db_driver') ? db_driver() : 'pg';
  $report['driver'] = $driver;
  if ($driver === 'mysql') {
    $cfg = app_config()['mysql'];
    $report['db'] = [
      'host' => (string)$cfg['host'],
      'port' => (int)$cfg['port'],
      'dbname' => (string)$cfg['dbname'],
      'charset' => (string)($cfg['charset'] ?? 'utf8mb4'),
    ];
  } else {
    $cfg = app_config()['pg'];
    $report['db'] = [
      'host' => (string)$cfg['host'],
      'port' => (int)$cfg['port'],
      'dbname' => (string)$cfg['dbname'],
      'sslmode' => (string)($cfg['sslmode'] ?? ''),
      'sslrootcert' => isset($cfg['sslrootcert']) ? (string)$cfg['sslrootcert'] : '(auto)',
      'force_ipv4' => (bool)($cfg['force_ipv4'] ?? false),
    ];
    $rc = $cfg['sslrootcert'] ?? '';
    if ($rc !== '') {
      $report['sslrootcert_exists'] = @file_exists($rc);
      $report['sslrootcert_readable'] = @is_readable($rc);
      $report['sslrootcert_size'] = @filesize($rc);
    }
  }
} catch (Throwable $e) {
  $report['driver'] = 'error: ' . $e->getMessage();
}

try {
  $pdo = get_pdo();              // usa backend/config.php
  $pdo->query('SELECT 1');
  $report['db_connection'] = 'ok';
} catch (Throwable $e) {
  $report['db_connection'] = 'error';
  $report['db_error'] = $e->getMessage();
}

try {
  $driver = function_exists('db_driver') ? db_driver() : 'pg';
  if ($driver === 'mysql') {
    $host = app_config()['mysql']['host'];
    $port = (int)app_config()['mysql']['port'];
  } else {
    $host = app_config()['pg']['host'];
    $port = (int)app_config()['pg']['port'];
  }
  $errno = 0; $errstr = '';
  $fp = @fsockopen($host, $port, $errno, $errstr, 5);
  if ($fp) { fclose($fp); $report['tcp_5432'] = 'reachable'; }
  else { $report['tcp_5432'] = "blocked: $errno $errstr"; }
} catch (Throwable $e) {
  $report['tcp_5432'] = 'error: ' . $e->getMessage();
}

// Intento adicional con libpq directa (pg_connect) para obtener mensaje bajo nivel
if (function_exists('pg_connect')) {
  try {
    $connStr = sprintf(
      'host=%s port=%d dbname=%s user=%s password=%s sslmode=%s connect_timeout=%d',
      $cfg['host'], (int)$cfg['port'], $cfg['dbname'], $cfg['user'], $cfg['password'], ($cfg['sslmode'] ?? 'require'), (int)($cfg['connect_timeout'] ?? 5)
    );
    if (!empty($cfg['sslrootcert'] ?? '')) {
      $connStr .= ' sslrootcert=' . $cfg['sslrootcert'];
    }
    $connStr .= ' gssencmode=disable';
    $pg = @pg_connect($connStr);
    if ($pg !== false) {
      $report['pg_connect'] = 'ok';
      $ver = @pg_version($pg);
      if (is_array($ver)) $report['pg_connect_version'] = $ver;
      @pg_close($pg);
    } else {
      $report['pg_connect'] = 'error';
      $report['pg_last_error'] = @pg_last_error();
    }
  } catch (Throwable $e) {
    $report['pg_connect'] = 'exception: ' . $e->getMessage();
  }
} else {
  $report['pg_connect'] = 'not available';
}

// Test opcional para MySQL
if (function_exists('mysqli_init')) {
  try {
   if (isset($GLOBALS['cfg']) && isset($GLOBALS['cfg']['host'])) {
     // noop
   }
    if (function_exists('db_driver') && db_driver() === 'mysql') {
      $m = mysqli_init();
      mysqli_options($m, MYSQLI_OPT_CONNECT_TIMEOUT, 5);
      $ok = @mysqli_real_connect($m, app_config()['mysql']['host'], app_config()['mysql']['user'], app_config()['mysql']['password'], app_config()['mysql']['dbname'], (int)app_config()['mysql']['port']);
      if ($ok) { $report['mysqli_connect'] = 'ok'; mysqli_close($m); }
      else { $report['mysqli_connect'] = 'error: ' . mysqli_connect_error(); }
    }
  } catch (Throwable $e) {
    $report['mysqli_connect'] = 'exception: ' . $e->getMessage();
  }
}

session_start();
$_SESSION['probe'] = time();
$report['session'] = 'ok';

echo json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);