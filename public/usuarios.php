<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/usuario/verificar-autenticacao.php';
require_once __DIR__ . '/../src/perfis/verificar-permissao.php';
require_once __DIR__ . '/../src/classes/database/UsuarioRepositorio.php';

verificarPermissao([1]);

$pdo = require __DIR__ . '/../config/database.php';

$usuariosRepositorio = new UsuarioRepositorio($pdo);
$usuarios = $usuariosRepositorio->listarUsuarios();

require __DIR__ . '/../src/views/layouts/cabecalho.php';
require __DIR__ . '/../src/views/layouts/menu.php';

require __DIR__ . '/../src/views/usuarios/gerenciamento.php';
require __DIR__ . '/../src/views/layouts/rodape.php';