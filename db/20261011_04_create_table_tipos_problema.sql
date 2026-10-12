USE helpdesk;

CREATE TABLE IF NOT EXISTS tipos_problema (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(100) UNIQUE NOT NULL,
    status ENUM('ativo', 'bloqueado') NOT NULL DEFAULT 'ativo'
)