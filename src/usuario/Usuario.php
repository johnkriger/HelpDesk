<?php

class Usuario {

    /**
     * Busca um usuário pelo endereço de e-mail.
     *
     * @param array  $dadosUsuario Dados do cadastro do usuário.
     * @param string $senha Senha informada pelo usuário.
     * @return bool
     */
    public function validarSenha($dadosUsuario, $senha) {  
        return (password_verify($dadosUsuario['senha'], $senha)) ? true : false;
    }
}