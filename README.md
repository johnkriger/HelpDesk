# HelpDesk

Sistema de atendimento interno para registro, acompanhamento e resolução de solicitações de suporte técnico. O projeto é um MVP desenvolvido para estudo e portfólio, com foco em backend, autenticação, autorização, regras de negócio e rastreabilidade dos atendimentos.

## Visão geral

O HelpDesk centraliza solicitações relacionadas a computadores, sistemas, acessos e infraestrutura. Cada solicitação gera um chamado com protocolo próprio, responsável, prioridade, status, histórico e, opcionalmente, anexos.

A documentação detalhada está disponível em:

- [Requisitos do sistema](docs/requisitos.md)
- [Modelo de dados](docs/modelo-dados.md)

## Escopo do MVP

O MVP contempla:

- Autenticação e logout;
- Controle de acesso por perfil no backend;
- Cadastro, bloqueio e desbloqueio de usuários;
- Cadastro e inativação de tipos de problema;
- Abertura e visualização de chamados;
- Definição e alteração de prioridade;
- Atribuição, transferência e acompanhamento do responsável;
- Alteração de tipo e status;
- Registro da solução;
- Cancelamento com justificativa;
- Histórico permanente das ações realizadas;
- Anexos opcionais nos chamados.

## Perfis de usuário

### Administrador

Administra usuários e tipos de problema, visualiza todos os chamados e pode realizar ações administrativas, incluindo atribuir ou alterar o responsável e alterar informações dos chamados.

### Atendente

Visualiza todos os chamados, assume chamados, atende os chamados sob sua responsabilidade, altera prioridade e tipo, transfere chamados, registra a solução, cancela chamados não finalizados e consulta o histórico.

Somente o atendente responsável pode alterar as informações de atendimento. Outros atendentes podem consultar o chamado.

### Solicitante

Abre chamados, visualiza os chamados que abriu, acompanha seus status, consulta seus históricos e envia anexos durante a abertura.

## Chamados

Ao abrir um chamado, são informados:

- Título obrigatório entre 5 e 100 caracteres;
- Descrição obrigatória com até 1.500 caracteres;
- Usuário afetado, que pode ser o próprio solicitante ou outro usuário cadastrado;
- Tipo de problema obrigatório;
- Até 2 anexos opcionais por envio.

O identificador do chamado é gerado automaticamente e utilizado como protocolo. O título e a descrição não podem ser alterados após a abertura.

### Prioridades

- Baixa;
- Média;
- Alta.

A prioridade pode ser definida ou alterada pelo atendente responsável ou pelo Administrador enquanto o chamado estiver aberto. A alteração é registrada no histórico.

### Status e fluxo

Os status do MVP são:

- **Aguardando** — status inicial, normalmente sem responsável;
- **Em andamento** — chamado assumido ou em atendimento;
- **Finalizado** — solução registrada e atendimento encerrado;
- **Cancelado** — chamado encerrado mediante justificativa.

Fluxo principal:

```text
Aguardando → Em andamento → Finalizado
     │              │
     └──────────────┴────→ Cancelado
```

Chamados finalizados ou cancelados não podem sofrer alterações normais. O histórico permanece disponível para consulta.

## Anexos

Os anexos são opcionais e devem permanecer associados ao chamado ou à ação que os originou. Cada envio permite no máximo 2 arquivos, com até 10 MB por arquivo.

Formatos aceitos: JPG, JPEG, PNG, PDF, DOC e DOCX.

Depois do envio, os anexos não podem ser alterados ou excluídos.

## Histórico e persistência

O sistema registra, entre outras ações, a abertura do chamado, alterações de status, prioridade, tipo e responsável, registro da solução, cancelamento, justificativa e inclusão de anexos.

Cada registro de histórico possui a ação realizada, o usuário responsável e a data e hora. O histórico não pode ser editado ou excluído. A abertura do chamado e a criação de seu histórico inicial devem ocorrer na mesma transação.

Usuários bloqueados e tipos de problema inativos permanecem registrados. Chamados, históricos e anexos também são preservados durante o funcionamento normal da aplicação.

## Regras principais

- Usuários bloqueados não podem fazer login nem receber novas atribuições;
- Usuários não são excluídos definitivamente;
- Tipos inativos não podem ser usados em novos chamados;
- Um chamado possui no máximo um atendente responsável;
- A alteração do responsável não muda automaticamente o status;
- Chamados abertos por solicitantes começam como Aguardando e sem responsável;
- Um atendente que abre um chamado para si pode ser definido automaticamente como responsável, com status Em andamento;
- O cancelamento exige justificativa;
- Chamados finalizados ou cancelados não podem ser alterados normalmente.

## Fora do escopo do MVP

Ficam previstos para versões futuras: central de notificações, prazos de atendimento, solicitação de informações, confirmação da solução, bloqueio automático por tentativas de login e fluxo de primeiro acesso com troca de senha.

## Objetivo técnico

O projeto foi estruturado para praticar análise de requisitos, modelagem de dados, PHP, MySQL/MariaDB, autenticação e autorização, CRUD, validação, manipulação de arquivos, regras de negócio, histórico de alterações, organização de código e Git/GitHub.
