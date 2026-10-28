<?php
declare(strict_types=1);
session_start();

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
    if($usuario->validarSenha($dadosUsuario, $senha)) {
        session_regenerate_id(true);

        $_SESSION['usuarioId']       = (int) $dadosUsuario['id'];
        $_SESSION['usuarioNome']     = $dadosUsuario['nome'];
        $_SESSION['usuarioPerfilId'] = (int) $dadosUsuario['id_perfil'];

        $retorno = 'Usuário logado';
    } else {
        $retorno = 'Senha incorreta';
    }
} else {
    $retorno = 'E-mail não cadastrado';
}

echo $retorno;