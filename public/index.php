<?php

declare(strict_types=1);

try {
    $pdo = require __DIR__ . '/../config/database.php';

    $bd = $pdo->query('SELECT DATABASE() AS banco')->fetch();
    header('Location: /login.php');
    exit;

} catch (Throwable $erro) {
    error_log($erro->getMessage());

    http_response_code(500);

    echo 'Não foi possível conectar ao sistema. Tente novamente mais tarde.';
}
    