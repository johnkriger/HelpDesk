# HelpDesk

Sistema de atendimento interno para registro, acompanhamento e resolução de solicitações de suporte técnico.

O HelpDesk é um projeto de MVP desenvolvido para estudo e portfólio, com foco em desenvolvimento backend, análise de requisitos, modelagem de dados, autenticação, autorização, regras de negócio e rastreabilidade dos atendimentos.

## Visão geral

O HelpDesk centraliza solicitações relacionadas a computadores, sistemas, acessos e infraestrutura. Cada solicitação gera um chamado com protocolo próprio, solicitante, usuário afetado, tipo de problema, prioridade, status e histórico de alterações.

O sistema permite acompanhar o andamento dos chamados, registrar interações entre solicitantes e atendentes, anexar arquivos e manter o histórico das ações realizadas.

## Tecnologias

- **PHP 8.5:** desenvolvimento backend.
- **MariaDB 11.8:** banco de dados relacional.
- **PDO:** acesso ao banco de dados por meio do PHP.
- **Docker e Docker Compose:** configuração e execução do ambiente.
- **HTML, CSS e JavaScript:** tecnologias para construção da interface.
- **Git e GitHub:** versionamento e documentação do projeto.

## Documentação

- [Requisitos do sistema](docs/requisitos.md)
- [Modelo de dados](docs/modelo-dados.md)

A documentação de requisitos descreve as funcionalidades e regras de negócio. O modelo de dados documenta a estrutura do banco e os relacionamentos entre as entidades.

## Escopo do MVP

O MVP contempla:

- Autenticação e encerramento de sessão.
- Controle de acesso por perfil.
- Bloqueio automático após cinco tentativas consecutivas de login inválidas.
- Bloqueio e desbloqueio manual de usuários.
- Gerenciamento de usuários e tipos de problema.
- Abertura e consulta de chamados.
- Identificação do solicitante e do usuário afetado.
- Definição e alteração de prioridade.
- Atribuição e acompanhamento do atendente responsável.
- Alteração do tipo de problema e do status.
- Registro de interações e informações de atendimento.
- Finalização com confirmação da solução pelo solicitante.
- Cancelamento de chamados pelo atendente.
- Histórico das ações realizadas.
- Inclusão de anexos.
- Notificações relacionadas a chamados e prazos de diagnóstico.

## Perfis de usuário

### Administrador

Responsável pelo gerenciamento administrativo do sistema.

Suas atribuições incluem:

- Cadastrar usuários com perfil de Solicitante ou Atendente.
- Bloquear e desbloquear usuários.
- Gerenciar os tipos de problema disponíveis para abertura de chamados.
- Receber notificações sobre chamados cujo prazo de diagnóstico tenha sido excedido.

O primeiro usuário Administrador deve ser provisionado pelo responsável pela implantação do sistema.

### Atendente

Responsável pelo atendimento e pela resolução dos chamados.

Suas atribuições incluem:

- Consultar e acompanhar chamados.
- Assumir e gerenciar os atendimentos sob sua responsabilidade.
- Definir e alterar a prioridade.
- Alterar o tipo de problema, com registro no histórico.
- Atualizar o status do chamado.
- Solicitar informações adicionais ao solicitante.
- Registrar informações sobre o atendimento e a solução.
- Transferir a responsabilidade pelo atendimento, quando aplicável.
- Cancelar chamados conforme as regras de negócio.

As ações de atendimento devem respeitar as permissões e as condições de alteração definidas para cada chamado.

### Solicitante

Responsável por registrar e acompanhar suas solicitações.

Suas atribuições incluem:

- Abrir chamados.
- Consultar os chamados que abriu.
- Acompanhar status, prioridade e histórico.
- Enviar informações adicionais quando solicitadas.
- Anexar arquivos durante a abertura do chamado.
- Confirmar a resolução de um chamado finalizado.

O solicitante não pode consultar chamados de outros usuários sem autorização prevista nas regras de acesso.

## Autenticação e segurança

O sistema utiliza credenciais para autenticar os usuários e sessões para manter o estado de autenticação.

As regras de autenticação incluem:

- Senhas armazenadas por meio de hash, utilizando os recursos apropriados do PHP.
- Bloqueio após cinco tentativas consecutivas de login inválidas.
- Reinicialização do contador de tentativas após um login bem-sucedido.
- Bloqueio e desbloqueio de usuários pelo Administrador.
- Impedimento de autenticação para usuários bloqueados.
- Verificação de permissões no backend para impedir acesso indevido a funcionalidades.
- Redirecionamento de usuários não autenticados para a tela de login.
- Exibição de acesso negado quando um usuário autenticado tenta acessar uma funcionalidade sem permissão, preservando sua sessão.

## Chamados

### Abertura

Ao abrir um chamado, devem ser informados:

- **Título:** obrigatório, entre 5 e 100 caracteres.
- **Descrição:** obrigatória, com até 1.500 caracteres.
- **Usuário afetado:** o próprio solicitante ou outro usuário cadastrado.
- **Tipo de problema:** obrigatório, selecionado entre os tipos ativos.
- **Anexos:** opcionais, respeitando os limites definidos para cada envio.

A descrição pode incluir informações sobre vários usuários afetados pela mesma ocorrência.

O identificador gerado pelo banco de dados é utilizado como protocolo do chamado. A data e a hora de abertura são registradas automaticamente.

A abertura de um chamado deve gerar seu registro inicial no histórico. A criação do chamado e do histórico inicial deve ocorrer na mesma transação, evitando registros inconsistentes.

O solicitante deve receber uma notificação após a abertura.

### Tipos de problema

Os tipos de problema são gerenciados pelo Administrador. Exemplos iniciais incluem Hardware e Software.

Cada chamado possui um único tipo de problema. Tipos inativos não podem ser selecionados na abertura de novos chamados.

O Atendente pode alterar o tipo de um chamado durante o atendimento, desde que a alteração seja permitida pelas regras de negócio e registrada no histórico.

### Prioridades

As prioridades disponíveis são:

- Baixa.
- Média.
- Alta.

A prioridade é definida pelo Atendente durante o atendimento e pode ser alterada conforme as regras de negócio. A alteração deve ser registrada no histórico, e o solicitante deve ser notificado.

### Status e fluxo

Os status do chamado são:

- **Aguardando:** status inicial de um chamado ainda não iniciado.
- **Em andamento:** chamado em atendimento.
- **Pendente de informação:** o atendimento depende de informações adicionais do solicitante.
- **Finalizado:** a solução foi registrada e aguarda confirmação do solicitante.
- **Cancelado:** o atendimento foi encerrado porque não exige uma ação de suporte, conforme a avaliação do Atendente.

Fluxo principal:

```text
Aguardando
    |
    v
Em andamento <------------------+
    |                           |
    +--> Pendente de informação |
    |          |                |
    |          v                |
    |     Em andamento          |
    |                           |
    v                           |
Finalizado                      |
    |                           |
    +--> Aguardando confirmação |
                 |              |
                 +-- Confirmado |
                 |              |
                 +-- Não resolvido
                        |
                        +--------+
```

O estado de confirmação é complementar ao status Finalizado:

- **Aguardando confirmação:** a solução foi registrada, mas o solicitante ainda precisa confirmar o resultado.
- **Confirmado:** o solicitante confirmou a resolução. O chamado não pode voltar ao fluxo normal de atendimento.

Se o solicitante informar que o problema não foi resolvido, o chamado retorna para Em andamento.

O cancelamento só pode ser realizado pelo Atendente e exige justificativa registrada no histórico.

Chamados confirmados ou cancelados não podem sofrer alterações normais. As restrições de alteração devem ser aplicadas no backend.

## Solicitação de informações

Quando o Atendente precisar de informações adicionais, poderá colocar o chamado em Pendente de informação e registrar uma pergunta para o solicitante.

O solicitante poderá responder no próprio chamado. As mensagens devem ser armazenadas com data e hora, compondo o histórico de interação.

A chegada de uma solicitação de informação deve ser sinalizada ao solicitante, e a resposta deve ser disponibilizada ao Atendente no acompanhamento do chamado.

## Prazos e notificações

O prazo de diagnóstico é de dois dias úteis a partir da abertura do chamado.

Quando esse prazo for excedido sem o diagnóstico correspondente, o Administrador deverá receber uma notificação.

O sistema também deve disponibilizar notificações relacionadas aos chamados, incluindo a abertura de solicitações e alterações relevantes para os usuários envolvidos.

## Anexos

Os anexos são opcionais e ficam associados ao chamado.

Regras de envio:

- Máximo de dois arquivos por chamado no envio inicial.
- Tamanho máximo de 10 MB por arquivo.
- Formatos aceitos: JPG, JPEG, PNG, PDF, DOC e DOCX.
- Validação de formato e tamanho no backend.

Após o envio, os anexos não podem ser alterados ou excluídos pelas funcionalidades normais do sistema.

## Histórico e persistência

O histórico registra as ações relevantes realizadas nos chamados, incluindo:

- Abertura do chamado.
- Alterações de status.
- Alterações de prioridade.
- Alterações de tipo de problema.
- Atribuição ou transferência de responsável.
- Solicitações de informações e respectivas respostas.
- Registro da solução.
- Confirmação ou rejeição da solução pelo solicitante.
- Cancelamento e justificativa.
- Inclusão de anexos.

Cada registro deve conter a ação realizada, a data e a hora e, quando aplicável, o usuário responsável.

O histórico não pode ser editado ou excluído pelas funcionalidades normais da aplicação.

Usuários bloqueados e tipos de problema inativos permanecem registrados no banco. Chamados, históricos e anexos também são preservados durante o funcionamento normal do sistema.

## Regras de negócio principais

- Usuários bloqueados não podem fazer login nem receber novas atribuições.
- Usuários não são excluídos definitivamente.
- Tipos inativos não podem ser utilizados em novos chamados.
- Cada chamado possui um solicitante, um usuário afetado e, no máximo, um Atendente responsável.
- O responsável pelo atendimento pode ser nulo enquanto o chamado não tiver sido atribuído.
- Chamados abertos por solicitantes começam no status Aguardando.
- A atribuição de um responsável não altera automaticamente o status.
- A alteração de tipo, prioridade, responsável ou status deve respeitar as permissões do usuário e as condições do chamado.
- O status Pendente de informação exige registro da solicitação e permite resposta do solicitante.
- A finalização exige registro da solução e posterior confirmação pelo solicitante.
- Chamados confirmados não retornam ao atendimento normal.
- O cancelamento é exclusivo do Atendente e exige justificativa.
- A abertura do chamado e a criação do histórico inicial devem ocorrer na mesma transação.
- As permissões devem ser verificadas no backend, não apenas na interface.

## Ambiente de desenvolvimento

O projeto utiliza Docker Compose para iniciar a aplicação PHP e o banco MariaDB.

### Pré-requisitos

- Docker Engine.
- Docker Compose.
- Git.
- Navegador web.

Não é necessário instalar PHP ou MariaDB diretamente no sistema operacional para executar a aplicação no ambiente configurado com Docker.

### Configuração inicial

Clone o repositório e entre na pasta do projeto:

```bash
git clone https://github.com/johnkriger/helpdesk.git
cd helpdesk
```

Crie o arquivo `.env` a partir do exemplo:

```bash
cp .env.example .env
```

Edite o `.env` e configure as credenciais do banco de dados, incluindo `DB_ROOT_PASSWORD` e `DB_PASSWORD`.

O arquivo `.env` contém configurações locais e não deve ser enviado ao GitHub. O `.env.example` deve conter apenas valores ilustrativos, sem credenciais reais.

### Iniciar a aplicação

Na primeira execução, ou após alterações que exijam reconstrução da imagem:

```bash
docker compose up -d --build
```

Nas inicializações seguintes:

```bash
docker compose up -d
```

A aplicação estará disponível em:

http://localhost:8000

O banco MariaDB utiliza a porta 3306 do host e o volume persistente `helpdesk_db_data`.

### Comandos úteis

Verificar o estado dos serviços:

```bash
docker compose ps
```

Acompanhar os logs da aplicação:

```bash
docker compose logs -f app
```

Acompanhar os logs do banco:

```bash
docker compose logs -f db
```

Parar os serviços sem removê-los:

```bash
docker compose stop
```

Iniciar novamente os contêineres existentes:

```bash
docker compose start
```

Parar e remover os contêineres e a rede do projeto:

```bash
docker compose down
```

O comando `docker compose down` preserva o volume do banco de dados. Não utilize `docker compose down -v` sem compreender que isso pode apagar os dados persistidos.

## Objetivo técnico e evolução

O HelpDesk foi concebido para praticar análise de requisitos, modelagem relacional, PHP, MariaDB, PDO, autenticação, autorização, CRUD, validação de dados, manipulação de arquivos, transações, regras de negócio, histórico de alterações, Docker e Git/GitHub.

A implementação será incremental, priorizando inicialmente a conexão com o banco, a autenticação e o controle de acesso. As demais funcionalidades serão desenvolvidas e testadas conforme os requisitos definidos.

O projeto tem finalidade educacional e de portfólio e não deve ser considerado pronto para produção sem uma revisão adicional de segurança, configuração, testes e operação.