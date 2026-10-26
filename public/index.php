<?php

declare(strict_types=1);

try {
    $pdo = require __DIR__ . '/../config/database.php';

    $bd = $pdo->query('SELECT DATABASE() AS banco')->fetch();

    echo 'Conexão com o banco estabelecida com sucesso!';
    echo '<br>';
    echo 'Banco conectado: ' . htmlspecialchars(
        $bd['banco'],
        ENT_QUOTES,
        'UTF-8'
    );
} catch (Throwable $erro) {
    error_log($erro->getMessage());

    http_response_code(500);

    echo 'Não foi possível conectar ao banco de dados.';
}
    