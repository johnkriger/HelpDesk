<?php
declare(strict_types=1);
require_once __DIR__ . '/../src/usuario/Usuario.php';
require_once __DIR__ . '/../src/database/UsuarioRepositorio.php';
$pdo = require __DIR__ . '/../config/database.php';

$retorno = '';
$email = '';
$senha = '';

$usuarioRepositorio = new UsuarioRepositorio($pdo);
$dadosUsuario = $usuarioRepositorio->buscarUsuarioPorEmail($email);

if(is_array($dadosUsuario)) {
    if($dadosUsuario['status'] === 'bloqueado'){
        echo 'Usuário bloqueado, consulte o administrador.';
        return;
    }

    $usuario = new Usuario($usuarioRepositorio);
    $retorno = ($usuario->validarSenha($dadosUsuario, $senha)) ? 'Usuário logado' : 'Senha incorreta';
} else {
    $retorno = 'E-mail não cadastrado';
}

echo $retorno;