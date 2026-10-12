USE helpdesk;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    id_perfil INT UNSIGNED NOT NULL,
    status ENUM('ativo', 'bloqueado') NOT NULL DEFAULT 'ativo',

    CONSTRAINT fk_usuarios_perfis
        FOREIGN KEY (id_perfil) REFERENCES perfis(id)
);