<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/usuario/verificar-autenticacao.php';
require_once __DIR__ . '/../src/perfis/verificar-permissao.php';

verificarPermissao([1, 2, 3]);

require __DIR__ . '/../src/views/layouts/cabecalho.php';
require __DIR__ . '/../src/views/layouts/menu.php';

switch($_SESSION['usuarioPerfilId']){
    case 1:
        require __DIR__ . '/../src/views/painel/administrador.php';
        break;
    default:
        http_response_code(403);
        exit;
}

require __DIR__ . '/../src/views/layouts/rodape.php';
?>

<h1>Painel do Helpdesk</h1>

<p>Bem vindo, <?= htmlspecialchars(
        $_SESSION['usuarioNome'],
        ENT_QUOTES,
        'utf-8')
    ?>!
</p>