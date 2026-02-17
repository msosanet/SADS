<?php
declare(strict_types=1);

// Bootstrap minimo para el fork IASis.
// No modifica conexiones de BD del sistema legado.

define('IASIS_ROOT', dirname(__DIR__));
define('IASIS_MIGRADO_ROOT', IASIS_ROOT . DIRECTORY_SEPARATOR . 'migrado');

date_default_timezone_set('America/Argentina/Ushuaia');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
