<?php
declare(strict_types=1);

/**
 * Gera um token CSRF
 * @return string Token CSRF
 */
function gerarTokenCSRF(): string {
    if(empty($_SESSION['tokenCSRF'])) {
        $_SESSION['tokenCSRF'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['tokenCSRF'];
}