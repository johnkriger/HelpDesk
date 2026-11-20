<?php
class UsuarioRepositorio {
    private PDO $pdo;

    /**
     * Inicializa o repositório de usuários com uma conexão ao banco de dados.
     *
     * @param PDO $pdo Instância de conexão com o banco de dados.
     */
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
     * @return void
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
     * 
     * @param $idUsuario ID do usuário que está sendo bloqueado
     * @return void
     */
    public function bloquearUsuario(int $idUsuario): void {
        $consulta = $this->pdo->prepare(
            'UPDATE usuarios
             SET status = "bloqueado"
             WHERE id = :id'
        );
        $consulta->execute(['id' => $idUsuario]);
    }

    /**
     * Desbloqueia o usuário
     * 
     * @param $idUsuario ID do usuário que está sendo desbloqueado
     * @return void
     */
    public function desbloquearUsuario(int $idUsuario): void {
        $consulta = $this->pdo->prepare(
            'UPDATE usuarios
             SET status = "ativo"
             WHERE id = :id'
        );
        $consulta->execute(['id' => $idUsuario]);
    }

    /**
     * Busca o usuário pelo ID
     * 
     * @param $idUsuario ID do usuário para busca
     * @return array|false Dados do usuário encontrado ou false se não encontrado.
     */
    public function buscarUsuarioPorId(int $idUsuario): array|false {
        $consulta = $this->pdo->prepare(
            'SELECT * FROM usuarios WHERE id = :id'
        );
        $consulta->execute(['id' => $idUsuario]);
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        return (is_array($usuario)) ? $usuario : false;
    }

    /**
     * Busca todos os usuários do banco
     * 
     * @return array dados dos usuários
     */
    public function listarUsuarios(): array {
        $consulta = $this->pdo->prepare(
            'SELECT u.id, u.nome, u.email, p.nome AS perfil, u.status 
                FROM usuarios u
             INNER JOIN perfis p
                ON u.id_perfil = p.id
             ORDER BY u.nome;'
        );

        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}