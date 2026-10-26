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
        $errosSenha = $dadosUsuario['erros_login'];
        $validacao = (password_verify($senha, $dadosUsuario['senha'])) ? true : false;

        $errosSenha = (!$validacao) ? $dadosUsuario['erros_login'] + 1 : $errosSenha = 0;
        $this->usuarioRepositorio->atualizarErrosLogin($dadosUsuario['id'], $errosSenha);
        if($errosSenha > 4) $this->usuarioRepositorio->bloquearUsuario($dadosUsuario['id']);
    
        return $validacao;
    }
}