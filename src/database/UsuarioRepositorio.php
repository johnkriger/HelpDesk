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

    /**
     * Atualiza o número de vezes que o usuário errou a senha
     * 
     * @param int $idUsuario  ID do usuário que está tentando acessar o sistema
     * @param int $errosLogin Número de erros consecutivos
     */
    public function atualizarErrosLogin(int $idUsuario, int $errosLogin): void {
        $consulta = $this->pdo->prepare(
            'UPDATE usuarios
             SET erros_login = :erros_login
             WHERE id = :id'
        );
        $consulta->execute([
            'id' => $idUsuario,
            'erros_login' => $errosLogin
        ]);
    }

    /**
     * Bloqueia o usuário
     * @param $idUsuario ID do usuário que está tentando acessar o sistema
     */
    public function bloquearUsuario(int $idUsuario): void {
        $consulta = $this->pdo->prepare(
            'UPDATE usuarios
             SET status = "bloqueado"
             WHERE id = :id'
        );
        $consulta->execute(['id' => $idUsuario]);
    }
}