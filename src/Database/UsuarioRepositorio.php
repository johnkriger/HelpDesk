<?php
class UsuarioRepositorio {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    
    /**
     * Busca um usuário pelo endereço de e-mail.
     *
     * @param string $email Endereço de e-mail do usuário.
     * @return array|false Dados do usuário encontrado ou false se não encontrado.
     */
    public function buscarUsuarioPorEmail(string $email): array|false {
        $consulta = $this->pdo->prepare(
            'SELECT * FROM usuarios WHERE email = :email'
        );
        $consulta->execute(['email' => $email]);
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        return (is_array($usuario)) ? $usuario : false;
    }
}