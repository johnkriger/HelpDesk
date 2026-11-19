<?php
declare(strict_types=1);

/**
 * Verifica se o perfil do usuário possui permissão para acessar determinado recurso.
 * 
 * @param array $perfisPermitidos Lista de IDs dos perfis autorizados.
 * @return void
 */
function verificarPermissao(array $perfisPermitidos): void{
    if(!in_array($_SESSION['usuarioPerfilId'], $perfisPermitidos, true)){
        http_response_code(403);
        echo 'Permissão negada';
        exit;
    }
}