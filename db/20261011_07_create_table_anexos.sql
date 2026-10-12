USE helpdesk;

CREATE TABLE IF NOT EXISTS anexos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_chamado INT UNSIGNED NOT NULL,
    caminho_do_anexo VARCHAR(255) NOT NULL,

    CONSTRAINT fk_anexos_chamados
        FOREIGN KEY (id_chamado) REFERENCES chamados(id)
);