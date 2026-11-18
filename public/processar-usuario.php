<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/usuario/verificar-autenticacao.php';
require_once __DIR__ . '/../src/perfis/verificar-permissao.php';
require_once __DIR__ . '/../src/classes/database/UsuarioRepositorio.php';

verificarPermissao([1]);

if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

$acao = $_POST['acao'] ?? '';
$idUsuario = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT);

$pdo = require __DIR__ . '/../config/database.php';
$usuariosRepositorio = new UsuarioRepositorio($pdo);

switch($acao) {
    case 'bloquear':
        $usuariosRepositorio->bloquearUsuario($idUsuario);
        break;
    case 'desbloquear':
        $usuariosRepositorio->desbloquearUsuario($idUsuario);
        break;
}

$usuariosRepositorio->listarUsuarios();
header('Location: /usuarios.php');