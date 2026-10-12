USE helpdesk;

CREATE TABLE IF NOT EXISTS historicos( 
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_chamado INT UNSIGNED NOT NULL,
    atualizacao VARCHAR(500) NOT NULL,
    data_e_hora DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_historicos_chamados
        FOREIGN KEY (id_chamado) REFERENCES chamados(id)
);