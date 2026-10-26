<?php
declare(strict_types=1);
require_once __DIR__ . '/../src/usuario/Usuario.php';
require_once __DIR__ . '/../src/database/UsuarioRepositorio.php';
$pdo = require __DIR__ . '/../config/database.php';

$retorno = '';
$errosCont = 0;
//teste no terminal
// $email = trim((string) readline('E-mail do usuário: ')); //adm.master@helpdesk.com
// $senha = trim((string) readline('Senha do usuário: '));


$email = 'adm.master@helpdesk.com';
$senha = '1234567';

$usuarioRepositorio = new UsuarioRepositorio($pdo);
$dadosUsuario = $usuarioRepositorio->buscarUsuarioPorEmail($email);

if(is_array($dadosUsuario)) {
    $usuario = new Usuario($usuarioRepositorio);
    $retorno = (!!$usuario->validarSenha($dadosUsuario, $senha)) ? 'Usuário logado' : 'Senha incorreta';
} else {
    $retorno = 'E-mail não cadastrado';
}

echo $retorno;