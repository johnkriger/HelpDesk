<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/usuario/verificar-autenticacao.php';
?>

<h1>Painel do Helpdesk</h1>

<p>Bem vindo, <?= htmlspecialchars(
        $_SESSION['usuarioNome'],
        ENT_QUOTES,
        'utf-8')
    ?>!
</p>