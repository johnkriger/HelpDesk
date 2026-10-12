USE helpdesk;

CREATE TABLE IF NOT EXISTS chamados (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_solicitante INT UNSIGNED NOT NULL,
    id_usuario_afetado INT UNSIGNED NOT NULL,
    id_atendente INT UNSIGNED NULL,
    id_tipo INT UNSIGNED NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descricao VARCHAR(1500) NOT NULL,
    prioridade ENUM('Alta', 'Média', 'Baixa') NULL,
    status ENUM('Aguardando', 'Em andamento', 'Pendente de informação', 'Finalizado', 'Cancelado') NOT NULL DEFAULT 'Aguardando',
    criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fechado_em DATETIME NULL,

    CONSTRAINT fk_chamados_solicitante
        FOREIGN KEY (id_solicitante) REFERENCES usuarios(id),

    CONSTRAINT fk_chamados_usuario_afetado
        FOREIGN KEY (id_usuario_afetado) REFERENCES usuarios(id),

    CONSTRAINT fk_chamados_atendente
        FOREIGN KEY (id_atendente) REFERENCES usuarios(id),

    CONSTRAINT fk_chamados_tipo
        FOREIGN KEY (id_tipo) REFERENCES tipos_problema(id)
);