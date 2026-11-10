<?php
declare(strict_types=1);

session_start();

//limpa os dados da sessão
$_SESSION = [];

//recupera as configurações do cookie da sessão
$parametrosCookie = session_get_cookie_params();

//remove o cookie de sessão do navegador
setcookie(
    session_name(),
    '',
    [
        'expires' => time() -42000,
        'path'    => $parametrosCookie['path'],
        'domain'  => $parametrosCookie['domain'],
        'secure'  => $parametrosCookie['secure'],
        'httponly'=> $parametrosCookie['httponly'],
        'samesite'=> $parametrosCookie['samesite']
    ]
);

//destrói a sessão no servidor
session_destroy();

//retorna o usuário para tela de login
header('Location: /login.php');
exit;