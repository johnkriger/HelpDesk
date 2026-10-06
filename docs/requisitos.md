# HelpDesk — Requisitos do Sistema

## 1. Visão geral

O HelpDesk é um sistema de atendimento interno destinado ao registro e acompanhamento de solicitações de suporte técnico de uma empresa.

O sistema tem como objetivo centralizar os chamados de suporte, evitar que solicitações sejam esquecidas, permitir o acompanhamento do atendimento e manter um histórico das ações realizadas.

O projeto será desenvolvido inicialmente como um **MVP (Minimum Viable Product)**, priorizando funcionalidades essenciais e mantendo a implementação adequada ao objetivo de estudo e portfólio.

---

# 2. Escopo do MVP

A primeira versão do sistema contemplará:

* Autenticação de usuários;
* Controle de acesso por perfil;
* Cadastro e bloqueio de usuários;
* Cadastro de tipos de problema;
* Abertura de chamados;
* Visualização e acompanhamento de chamados;
* Definição de prioridade;
* Atribuição de responsável;
* Alteração de status;
* Atendimento dos chamados;
* Registro da solução;
* Cancelamento de chamados;
* Histórico das alterações;
* Anexos em chamados.

As funcionalidades que não fazem parte do MVP serão registradas ao final deste documento como **V2 / Melhorias futuras**.

---

# 3. Perfis de usuário

O sistema possuirá três perfis:

### 3.1 Administrador

Responsável pela administração do sistema.

Pode:

* Cadastrar usuários;
* Bloquear e desbloquear usuários;
* Cadastrar e inativar tipos de problema;
* Visualizar todos os chamados;
* Alterar o responsável por um chamado;
* Realizar ações administrativas nos chamados.

### 3.2 Atendente

Responsável pelo atendimento dos chamados.

Pode:

* Visualizar os chamados;
* Assumir chamados;
* Atender chamados pelos quais é responsável;
* Alterar prioridade;
* Alterar tipo do problema;
* Transferir o chamado para outro atendente;
* Registrar a solução;
* Cancelar chamados não finalizados;
* Consultar o histórico.

### 3.3 Solicitante

Usuário que solicita atendimento.

Pode:

* Abrir chamados;
* Visualizar os chamados que abriu;
* Acompanhar o status dos seus chamados;
* Consultar o histórico dos seus chamados;
* Enviar anexos durante a abertura do chamado.

---

# 4. Autenticação e acesso

## RF001 — Autenticação

O sistema deve permitir que usuários autenticados acessem o sistema utilizando:

* E-mail;
* Senha.

A senha deve ser armazenada de forma segura utilizando mecanismos de hash apropriados do PHP.

## RF002 — Controle de acesso

O sistema deve controlar o acesso às funcionalidades de acordo com o perfil do usuário.

O controle deve ser realizado no backend, não apenas pela exibição ou ocultação de opções no menu.

## RF003 — Acesso não autenticado

Caso um usuário não autenticado tente acessar uma área protegida, o sistema deve impedir o acesso e direcioná-lo para a tela de login.

## RF004 — Acesso não autorizado

Caso um usuário autenticado tente acessar uma funcionalidade que não pertence ao seu perfil, o sistema deve apresentar uma tela informando que ele não possui permissão.

O usuário não deve ser obrigado a realizar login novamente.

---

# 5. Usuários

## RF005 — Cadastro de usuário

O Administrador deve poder cadastrar usuários informando:

* Nome completo;
* E-mail;
* Senha inicial;
* Perfil.

O sistema deve gerar automaticamente o identificador do usuário e a data de cadastro.

## RF006 — Bloqueio de usuário

O Administrador deve poder bloquear um usuário.

Um usuário bloqueado não poderá realizar login ou receber novas atribuições de chamados.

## RF007 — Desbloqueio de usuário

O Administrador deve poder desbloquear um usuário anteriormente bloqueado.

## RF008 — Usuários não devem ser excluídos

O sistema não deve permitir a exclusão definitiva de usuários.

O bloqueio será utilizado para impedir novos acessos, preservando os registros históricos relacionados ao usuário.

---

# 6. Tipos de problema

## RF009 — Cadastro de tipos

O Administrador deve poder cadastrar tipos de problema utilizados nos chamados.

Exemplos iniciais:

* Hardware;
* Software.

Os tipos devem ser armazenados no banco de dados para permitir a inclusão de novos tipos posteriormente.

## RF010 — Inativação de tipo

O Administrador deve poder inativar um tipo de problema.

Tipos inativos não devem aparecer na abertura de novos chamados.

Chamados antigos devem continuar relacionados ao tipo originalmente utilizado.

---

# 7. Chamados

## RF011 — Abertura de chamado

O Solicitante deve poder abrir um chamado informando:

* Título;
* Descrição;
* Usuário afetado;
* Tipo do problema;
* Anexos opcionais.

O usuário afetado poderá ser:

* O próprio solicitante;
* Outro usuário cadastrado no sistema.

## RF012 — Título do chamado

O título será obrigatório e deverá possuir entre 5 e 100 caracteres.

O título não poderá ser alterado depois que o chamado for aberto.

## RF013 — Descrição do chamado

A descrição será obrigatória e deverá possuir no máximo 1500 caracteres.

A descrição não poderá ser alterada depois que o chamado for aberto.

## RF014 — Tipo do problema

Cada chamado deverá possuir exatamente um tipo de problema.

O tipo será obrigatório e não possuirá valor padrão selecionado.

O Atendente poderá alterar o tipo de um chamado durante o atendimento.

A alteração deverá ser registrada no histórico.

## RF015 — Identificação do chamado

O sistema deverá gerar automaticamente um identificador para cada chamado.

O identificador do registro no banco de dados será utilizado como protocolo do chamado.

## RF016 — Data de abertura

O sistema deverá registrar automaticamente a data e a hora de abertura do chamado.

## RF017 — Visualização dos chamados

O Solicitante deverá visualizar os chamados que abriu.

Os Atendentes deverão poder visualizar todos os chamados.

O Administrador deverá poder visualizar todos os chamados.

---

# 8. Status dos chamados

O MVP utilizará os seguintes status:

* Aguardando;
* Em andamento;
* Finalizado;
* Cancelado.

## RF018 — Status inicial

Todo chamado deverá ser criado com o status **Aguardando**.

## RF019 — Assumir chamado

Quando um Atendente assumir um chamado que esteja Aguardando e sem responsável, o sistema deverá:

1. Definir o Atendente como responsável;
2. Alterar o status para Em andamento.

## RF020 — Alteração de status

O Atendente responsável poderá alterar o status do chamado de acordo com o fluxo permitido pelo sistema.

O Administrador poderá realizar alterações administrativas nos chamados.

## RF021 — Finalização

O Atendente responsável deverá poder finalizar um chamado.

Ao finalizar, deverá registrar a solução ou ação realizada para resolver a solicitação.

## RF022 — Cancelamento

O Atendente responsável ou o Administrador poderá cancelar um chamado que ainda não esteja finalizado.

O cancelamento deverá exigir uma justificativa.

---

# 9. Fluxo básico do chamado

O fluxo principal do MVP será:

```text
Aguardando
    ↓
Em andamento
    ↓
Finalizado
```

Um chamado poderá ser cancelado enquanto não estiver finalizado:

```text
Aguardando ─────→ Cancelado
     │
     ↓
Em andamento ───→ Cancelado
```

Chamados **Finalizados** e **Cancelados** serão considerados encerrados.

---

# 10. Responsável pelo chamado

## RF023 — Responsável

Cada chamado poderá possuir um único Atendente responsável.

## RF024 — Atribuição

O Administrador poderá atribuir ou alterar o responsável de um chamado.

O Atendente responsável também poderá transferir o chamado para outro Atendente ativo.

## RF025 — Restrição de atribuição

Usuários bloqueados não poderão receber novos chamados.

## RF026 — Permissão de atendimento

O Atendente responsável poderá alterar as informações de atendimento do chamado.

Outros Atendentes poderão consultar o chamado, mas não poderão alterar suas informações de atendimento.

O Administrador possuirá acesso administrativo aos chamados.

## RF027 — Histórico de transferência

Quando o responsável de um chamado for alterado, o sistema deverá registrar no histórico:

* Responsável anterior;
* Novo responsável;
* Usuário que realizou a alteração;
* Data e hora da alteração.

---

# 11. Prioridade

O sistema utilizará três níveis de prioridade:

* Baixa;
* Média;
* Alta.

## RF028 — Definição de prioridade

A prioridade poderá ser definida pelo Atendente responsável ou pelo Administrador.

## RF029 — Alteração de prioridade

A prioridade poderá ser alterada enquanto o chamado estiver aberto.

Toda alteração deverá ser registrada no histórico.

---

# 12. Anexos

## RF030 — Anexos

O sistema deverá permitir anexar arquivos aos chamados.

Os anexos serão opcionais.

## RF031 — Limite de anexos

Cada envio poderá conter no máximo **2 arquivos**.

Cada arquivo poderá possuir no máximo **10 MB**.

## RF032 — Formatos permitidos

Serão aceitos os seguintes formatos:

* JPG;
* JPEG;
* PNG;
* PDF;
* DOC;
* DOCX.

## RF033 — Histórico dos anexos

Os anexos deverão permanecer associados ao registro ou ação que os originou.

Não será permitida a alteração ou exclusão de anexos após o envio.

---

# 13. Histórico

## RF034 — Histórico do chamado

O sistema deverá manter um histórico das principais ações realizadas em cada chamado.

O histórico deverá registrar, quando aplicável:

* Abertura do chamado;
* Alteração de status;
* Alteração de prioridade;
* Alteração de tipo;
* Alteração de responsável;
* Registro da solução;
* Cancelamento;
* Justificativa de cancelamento;
* Inclusão de anexos.

## RF035 — Informações do histórico

Cada registro do histórico deverá possuir:

* Ação realizada;
* Usuário responsável pela ação;
* Data e hora.

## RF036 — Histórico permanente

Os registros do histórico não poderão ser editados ou excluídos.

O objetivo é preservar a rastreabilidade do atendimento.

---

# 14. Regras de negócio

## RN001 — Usuários bloqueados

Usuários bloqueados não poderão realizar login.

## RN002 — Exclusão de usuários

Usuários não poderão ser excluídos definitivamente do sistema.

## RN003 — Tipos inativos

Tipos de problema inativos não poderão ser utilizados em novos chamados.

## RN004 — Responsável

Um chamado poderá possuir apenas um Atendente responsável por vez.

## RN005 — Atendente bloqueado

Um Atendente bloqueado não poderá receber novas atribuições.

Chamados que já estejam atribuídos a ele permanecerão vinculados até que um Administrador realize uma nova atribuição.

## RN006 — Alteração de responsável

A alteração do responsável não deverá alterar automaticamente o status do chamado.

## RN007 — Chamado sem responsável

Chamados abertos por Solicitantes serão inicialmente criados como Aguardando e sem responsável.

## RN008 — Chamado assumido

Quando um Atendente assumir um chamado Aguardando e sem responsável, ele se tornará o responsável e o chamado passará para Em andamento.

## RN009 — Chamado aberto por Atendente

Caso um Atendente abra um chamado para si e o chamado não possua responsável, ele será automaticamente definido como responsável e o status passará para Em andamento.

## RN010 — Chamado aberto por Administrador

Caso o Administrador abra um chamado, o chamado permanecerá Aguardando até que um Atendente o assuma.

## RN011 — Edição por Atendente

Somente o Atendente responsável poderá realizar alterações de atendimento em um chamado.

Outros Atendentes poderão consultar o chamado.

## RN012 — Cancelamento

O cancelamento de um chamado exigirá uma justificativa.

## RN013 — Chamados encerrados

Chamados Finalizados ou Cancelados não poderão sofrer alterações normais.

O histórico permanecerá disponível para consulta.

## RN014 — Histórico

Ações relevantes realizadas no chamado deverão ser registradas no histórico.

---

# 15. Permissões resumidas

| Funcionalidade               | Administrador | Atendente | Solicitante |
| ---------------------------- | :-----------: | :-------: | :---------: |
| Fazer login                  |       ✓       |     ✓     |      ✓      |
| Cadastrar usuários           |       ✓       |     —     |      —      |
| Bloquear usuários            |       ✓       |     —     |      —      |
| Desbloquear usuários         |       ✓       |     —     |      —      |
| Cadastrar tipos              |       ✓       |     —     |      —      |
| Inativar tipos               |       ✓       |     —     |      —      |
| Abrir chamado                |       ✓       |     ✓     |      ✓      |
| Visualizar todos os chamados |       ✓       |     ✓     |      —      |
| Visualizar próprios chamados |       ✓       |     ✓     |      ✓      |
| Assumir chamado              |       —       |     ✓     |      —      |
| Alterar responsável          |       ✓       |     ✓*    |      —      |
| Alterar prioridade           |       ✓       |     ✓*    |      —      |
| Alterar tipo                 |       ✓       |     ✓*    |      —      |
| Registrar solução            |       ✓       |     ✓*    |      —      |
| Cancelar chamado             |       ✓       |     ✓*    |      —      |
| Consultar histórico          |       ✓       |     ✓     |     ✓**     |

* Somente quando o Atendente possuir permissão para atuar sobre o chamado, normalmente por ser o responsável.

** O Solicitante poderá consultar o histórico dos chamados que abriu.

---

# 16. Fora do escopo do MVP

As funcionalidades abaixo foram discutidas durante a análise, mas **não serão implementadas na primeira versão**.

Elas poderão ser avaliadas posteriormente como V2:

### 16.1 Central de notificações

* Notificações de abertura;
* Notificações de alteração de prioridade;
* Notificações de solicitação de informação;
* Notificações de transferência;
* Notificações de finalização;
* Indicador de notificações não lidas.

### 16.2 Prazo de atendimento

* Prazo de 2 dias úteis para assumir chamados;
* Cálculo de dias úteis;
* Notificação ao Administrador quando o prazo for ultrapassado.

### 16.3 Solicitação de informações

* Status Pendente de informação;
* Atendente solicitar informações;
* Solicitante responder à solicitação;
* Anexos nas respostas;
* Histórico das solicitações e respostas.

### 16.4 Confirmação da solução

* Status Finalizado/Aguardando confirmação;
* Confirmação pelo Solicitante;
* Retorno do chamado para Em andamento caso o problema não esteja resolvido.

### 16.5 Segurança adicional de login

* Contagem de tentativas de login;
* Bloqueio automático após cinco tentativas incorretas;
* Controle específico para tentativas consecutivas.

### 16.6 Primeiro acesso

* Senha inicial definida pelo Administrador;
* Obrigatoriedade de troca da senha no primeiro acesso;
* Definição de nome de usuário no primeiro acesso.

### 16.7 Outras melhorias

Novas funcionalidades poderão ser adicionadas posteriormente conforme a evolução do projeto e a necessidade identificada durante o desenvolvimento.

---

# 17. Objetivo técnico do MVP

Além de solucionar o problema proposto, o MVP tem como objetivo demonstrar conhecimentos de desenvolvimento backend e práticas de desenvolvimento de software.

O projeto deverá permitir praticar:

* Análise e documentação de requisitos;
* Modelagem de banco de dados;
* PHP;
* MySQL/MariaDB;
* Autenticação;
* Autorização e controle de acesso;
* CRUD;
* Regras de negócio;
* Relacionamentos entre entidades;
* APIs, quando aplicável;
* Validação de dados;
* Manipulação de arquivos;
* Registro de histórico;
* Organização do código;
* Git e GitHub.

O escopo deverá permanecer controlado para que o projeto possa ser concluído e utilizado como **projeto de portfólio**, evitando a inclusão de funcionalidades que não sejam necessárias para demonstrar os conhecimentos propostos.
