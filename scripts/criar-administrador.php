<?php

declare(strict_types=1);

$pdo = require __DIR__ . '/../config/database.php';

//readline() recebe os dados pelo terminal.
$nome = trim((string) readline('Nome do administrador: '));
$email = trim((string) readline('E-mail do administrador: '));

echo 'Senha do administrador: ';
system('stty -echo');
$senha = (string) readline();
system('stty echo');
echo PHP_EOL;

if($nome === '' or $email === '' or $senha === '') {
    exit('Erro: Todos os campos são obrigatórios.\n');
}

//filter_var() valida o formato do e-mail.
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit('Erro: Informe um email válido.\n');
}

if(strlen($senha) < 8) {
    exit('Erro: A senha deve ter mais de 8 caracteres.\n');
}


//prepare() e execute() usam parâmetros para evitar injeção de SQL.
$consultaAdministrador = $pdo->prepare(
    "SELECT COUNT(*) FROM usuarios WHERE id_perfil = :idPerfil;"
);

$consultaAdministrador->execute([
    'idPerfil' => 1
]);

if((int) $consultaAdministrador->fetchColumn() > 0) {
    exit('Já existe um usuário Administrador cadastrado.\n');
}

//password_hash() transforma a senha em um hash seguro para armazenamento.
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$consultaUsuario = $pdo->prepare(
    'INSERT INTO usuarios (nome, email, senha, id_perfil, status)
    VALUES (:nome, :email, :senha, :id_perfil, :status);'
);

$consultaUsuario->execute([
    'nome'      => $nome,
    'email'     => $email,
    'senha'     => $senhaHash,
    'id_perfil' => 1,
    'status'    => 'ativo'
]);

echo 'Administrador criado com sucesso!\n';