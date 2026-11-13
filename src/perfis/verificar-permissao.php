<?php
declare(strict_types=1);

function verificarPermissao(array $perfisPermitidos): void{
    if(!in_array($_SESSION['usuarioPerfilId'], $perfisPermitidos, true)){
        http_response_code(403);
        echo 'Permissão negada';
        exit;
    }
}