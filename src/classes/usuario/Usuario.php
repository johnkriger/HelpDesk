<?php
class Usuario {
    /** Repositório utilizado para acessar os dados dos usuários. */
    private UsuarioRepositorio $usuarioRepositorio;

    /**
     * Inicializa o usuário com o repositório de usuários.
     *
     * @param UsuarioRepositorio $usuarioRepositorio Repositório utilizado para acessar os dados dos usuários.
     */
    public function __construct(UsuarioRepositorio $usuarioRepositorio){
        $this->usuarioRepositorio = $usuarioRepositorio;
    }

    /**
     * Busca um usuário pelo endereço de e-mail.
     *
     * @param array  $dadosUsuario Dados do cadastro do usuário.
     * @param string $senha Senha informada pelo usuário.
     * @return bool
     */
    public function validarSenha($dadosUsuario, $senha) {
        $errosSenha = $dadosUsuario['erros_login'];
        $validacao = (password_verify($senha, $dadosUsuario['senha']));

        $errosSenha = (!$validacao) ? (int) $dadosUsuario['erros_login'] + 1 : 0;
        $this->usuarioRepositorio->atualizarErrosLogin($dadosUsuario['id'], $errosSenha);

        if($errosSenha >= 5) $this->usuarioRepositorio->bloquearUsuario((int)$dadosUsuario['id']);
    
        return $validacao;
    }
}