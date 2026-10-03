**HelpDesk**
    Sistema de gerenciamento de chamados de suporte interno desenvolvido como projeto de portfólio.

*Contexto*
    Uma empresa fictícia possui uma equipe de suporte interno responsável por atender problemas relacionados a computadores, sistemas, acessos e infraestrutura.

    Atualmente, as solicitações de suporte podem ser realizadas por diferentes canais, dificultando o acompanhamento dos atendimentos e a organização das demandas.

    O HelpDesk tem como objetivo centralizar essas solicitações em um único sistema.

*Objetivos do sistema*
    O sistema tem como objetivos:
        * Evitar que solicitações de suporte sejam esquecidas;
        * Criar um protocolo para cada solicitação;
        * Permitir que o solicitante acompanhe o status do atendimento;
        * Organizar as solicitações por categoria e status;
        * Manter um histórico dos atendimentos;
        * Permitir visualizar a quantidade de chamados existentes por status.

    O sistema deverá centralizar as solicitações de suporte, permitindo que usuários registrem chamados e acompanhem seu andamento, enquanto os atendentes poderão organizar, assumir, atualizar e encerrar esses chamados.

*Usuários*
    Inicialmente, o sistema terá dois perfis de usuário.

*Solicitante*
    Funcionário que necessita de suporte.

    Pode:
        * Entrar no sistema;
        * Abrir chamados;
        * Visualizar seus próprios chamados;
        * Acompanhar o status dos chamados;
        * Consultar o histórico de seus chamados;
        * Realizar ações permitidas sobre seus chamados, conforme as regras de negócio.

*Atendente*

    Profissional responsável pelo atendimento dos chamados.

    Pode:
        * Visualizar chamados;
        * Filtrar chamados;
        * Assumir chamados;
        * Alterar o status dos chamados;
        * Alterar a prioridade;
        * Registrar observações;
        * Registrar a solução;
        * Encerrar chamados;
        * Consultar o histórico dos atendimentos.

**Escopo**

*Autenticação*
    * Login;
    * Logout;
    * Controle de acesso por perfil.

*Solicitante*
    * Abrir chamado;
    * Listar seus chamados;
    * Visualizar chamado;
    * Acompanhar status;
    * Consultar histórico.

*Atendente*
    * Listar chamados;
    * Filtrar chamados;
    * Visualizar chamado;
    * Assumir chamado;
    * Alterar status;
    * Alterar prioridade;
    * Registrar observações;
    * Registrar solução;
    * Encerrar chamado.

*Sistema*
    * Gerenciamento de categorias;
    * Geração de protocolo;
    * Registro do histórico de alterações;
    * Controle de acesso conforme o perfil do usuário.