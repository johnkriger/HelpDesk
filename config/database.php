<?php
declare(strict_types=1);

$host = getenv('DB_HOST');
$database = getenv('DB_DATABASE');
$userName = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');

if (
    $host === false ||
    $database === false ||
    $userName === false ||
    $password === false
) {
    throw new RuntimeException(
        'As variáveis de ambiente não foram configuradas.'
    );
}

$dsn = "mysql:host={$host};dbname={$database};charset=utf8mb4";

$pdo = new PDO(
    $dsn,
    $userName,
    $password,
    [
        PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
);

return $pdo;
?>