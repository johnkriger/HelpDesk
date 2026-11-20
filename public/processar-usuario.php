<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/usuario/verificar-autenticacao.php';
require_once __DIR__ . '/../src/perfis/verificar-permissao.php';
require_once __DIR__ . '/../src/classes/database/UsuarioRepositorio.php';
require_once __DIR__ . '/../src/seguranca/csrf.php';

verificarPermissao([1]);

if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

$tokenSessao   = $_SESSION['tokenCSRF'] ?? '';
$tokenRecebido = $_POST['tokenCSRF'] ?? '';
$acao          = $_POST['acao'] ?? '';
$idUsuario     = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT);

if(!is_int($idUsuario) || $idUsuario <= 0) {
    http_response_code(400);
    exit('ID de usuário inválido.');
}

$pdo = require __DIR__ . '/../config/database.php';
$usuariosRepositorio = new UsuarioRepositorio($pdo);

$usuario = $usuariosRepositorio->buscarUsuarioPorId($idUsuario);
if (!is_array($usuario) || (int) $usuario['id_perfil'] === 1) {
    http_response_code(400);
    exit('Usuário inválido ou não permitido.');
}

if($tokenSessao === '' || $tokenRecebido === '' || !hash_equals($tokenSessao, $tokenRecebido)) {
    http_response_code(403);
    exit('Requisição inválida.');
}

switch($acao) {
    case 'bloquear':
        $usuariosRepositorio->bloquearUsuario($idUsuario);
        break;
    case 'desbloquear':
        $usuariosRepositorio->desbloquearUsuario($idUsuario);
        break;
    default:
        http_response_code(400);
        exit('Ação inválida.');
}

header('Location: /usuarios.php');
exit;