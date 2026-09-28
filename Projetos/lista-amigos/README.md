# 👥 Sistema Lista de Amigos — CRUD e Login

> Projeto acadêmico de **Desenvolvimento de Sistemas II**: aplicação web para autenticação de usuários e gerenciamento de uma lista de amigos, com cadastro, consulta, atualização e exclusão de registros.

![PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white) ![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white) ![HTML](https://img.shields.io/badge/HTML-E34F26?logo=html5&logoColor=white) ![Status](https://img.shields.io/badge/status-projeto%20acad%C3%AAmico-008F83)

## 📖 Sobre o projeto

O **Sistema Lista de Amigos** reúne, em uma aplicação web, os conceitos de autenticação, sessões PHP, formulários e persistência de dados. Depois de realizar o login, o usuário acessa um menu com as opções de adicionar e listar amigos. A listagem permite selecionar registros para atualização ou exclusão.

O projeto foi desenvolvido como atividade prática de **Desenvolvimento de Sistemas II** e documentado em uma apresentação que relaciona as telas do sistema às operações executadas no servidor e no banco de dados.

## 🎯 Objetivos

- Construir uma interface web para o cadastro de amigos.
- Implementar as quatro operações de um **CRUD**.
- Autenticar usuários antes de liberar o acesso às páginas protegidas.
- Utilizar sessões PHP para controlar o acesso.
- Armazenar e consultar registros em banco de dados MySQL.
- Apresentar o funcionamento do sistema e os conhecimentos técnicos empregados.

## 🛠️ Tecnologias

| Tecnologia | Utilização |
| --- | --- |
| PHP | Processamento de formulários, autenticação, sessões e operações CRUD. |
| MySQL | Armazenamento dos dados de usuários e amigos. |
| MySQLi | Comunicação entre o PHP e o banco de dados. |
| HTML | Estrutura das páginas e formulários. |
| W3.CSS | Estilização das interfaces. |
| Font Awesome | Ícones das ações e dos botões. |

## 🔐 Autenticação e controle de acesso

1. O usuário preenche o formulário de login.
2. `loginAction.php` processa as credenciais e consulta os dados de autenticação.
3. Com credenciais válidas, a aplicação registra o estado de autenticação na sessão PHP.
4. As páginas protegidas utilizam `verificarAcesso.php` para conferir a sessão.
5. Sem uma sessão autenticada, o acesso é redirecionado para a página de acesso negado.
6. A opção **Logout** permite encerrar a sessão.

> **Nota técnica:** esta versão acadêmica demonstra autenticação por sessão. Não deve ser tratada como implementação pronta para produção. Antes de publicar uma aplicação real, recomenda-se revisar o armazenamento de senhas, o tratamento das entradas, as consultas SQL, a proteção contra CSRF e a configuração de sessão.

## 🗂️ Operações CRUD

| Operação | Ação no sistema | Resultado |
| --- | --- | --- |
| **Create** | Adicionar amigo | Insere um novo registro. |
| **Read** | Listar amigos | Exibe os registros cadastrados. |
| **Update** | Atualizar amigo | Modifica os dados de um registro identificado pelo código. |
| **Delete** | Excluir amigo | Remove o registro após a confirmação do usuário. |

Os registros de amigos são apresentados com **código, nome, apelido e e-mail**. A tela de listagem disponibiliza os comandos de atualização e exclusão para cada item.

## 🔄 Fluxo de utilização

```text
Tela de login
    │
    ├── Sem autenticação ──> Acesso negado
    │
    └── Autenticado
          │
          ▼
     Menu principal
          │
          ├── Adicionar amigo ──> Cadastro ──> Banco de dados
          │
          ├── Listar amigos ────> Consulta ──> Banco de dados
          │                            │
          │                            ├── Atualizar registro
          │                            └── Excluir registro
          │
          └── Logout ──────────> Encerramento da sessão
```

## 🧩 Organização do código

Entre os arquivos centrais da aplicação estão:

| Arquivo | Responsabilidade |
| --- | --- |
| `index.php` | Exibe a tela de login. |
| `loginAction.php` | Processa a autenticação. |
| `verificarAcesso.php` | Verifica o estado de autenticação da sessão. |
| `acessoNegado.php` | Exibe a mensagem de acesso negado. |
| `principal.php` | Exibe o menu principal. |
| `cadastro.php` / `cadastroAction.php` | Exibem e processam o cadastro. |
| `listar.php` | Consulta e apresenta os amigos. |
| `atualizar.php` / `atualizarAction.php` | Exibem e processam a atualização. |
| `excluir.php` / `excluirAction.php` | Exibem e processam a exclusão. |
| `conexaoBD.php` | Centraliza a conexão com o banco de dados. |

Os nomes acima descrevem os arquivos principais do projeto; outros arquivos e recursos podem integrar a distribuição original.

## 🚀 Como executar localmente

**Pré-requisitos:** servidor web com PHP e extensão MySQLi habilitada, além de um servidor MySQL. Um ambiente local como XAMPP ou equivalente pode ser utilizado.

1. Coloque os arquivos PHP do projeto na pasta servida pelo seu servidor web.
2. Crie um banco de dados MySQL e importe o script SQL do projeto, **caso ele esteja disponível**. Se o script não estiver incluído, obtenha a estrutura das tabelas utilizada pela atividade antes de executar o sistema.
3. Configure em `conexaoBD.php` o host, o banco, o usuário e a senha correspondentes ao seu ambiente local.
4. Cadastre um usuário de teste conforme a estrutura de autenticação da aplicação.
5. Inicie o servidor web e o MySQL.
6. Acesse a URL local correspondente à pasta do projeto, por exemplo `http://localhost/nome-da-pasta/`.
7. Faça o login e teste as operações de cadastro, listagem, atualização e exclusão.

**Atenção:** o nome do banco, a estrutura SQL e as credenciais dependem da configuração do ambiente. Não publique senhas reais nem arquivos com segredos no repositório.

## 🧪 Roteiro de demonstração e testes

| Cenário | Comportamento esperado |
| --- | --- |
| Login com credenciais válidas | Acesso ao menu principal. |
| Login com credenciais inválidas | Acesso não autorizado. |
| Abertura de página protegida sem sessão | Redirecionamento para acesso negado. |
| Cadastro de um amigo | Novo registro disponível na listagem. |
| Consulta da lista | Exibição dos amigos cadastrados. |
| Alteração de um amigo | Dados atualizados no registro correspondente. |
| Confirmação da exclusão | Remoção do registro selecionado. |
| Cancelamento da exclusão | Registro preservado. |
| Logout | Encerramento da sessão autenticada. |

Esta tabela é um **roteiro de verificação funcional**; não representa uma suíte de testes automatizados.

## 📊 Apresentação acadêmica

A apresentação em PowerPoint acompanha o projeto e aborda o objetivo, as tecnologias, a autenticação, o menu principal, as quatro operações CRUD, o fluxo de utilização e as habilidades demonstradas.

**Arquivo sugerido no repositório:** [`Apresentacao_Lista_de_Amigos.pptx`](Apresentacao_Lista_de_Amigos.pptx)

## 📁 Organização sugerida do repositório

```text
sistema-de-amigos/
├── README.md
├── [arquivos PHP originais do projeto]
├── Apresentacao_Lista_de_Amigos.pptx
└── img/
    └── gabi.png
```

A estrutura acima é uma **sugestão de publicação**, não uma representação obrigatória da organização original dos arquivos.

## 📚 Aprendizados

O projeto integra conhecimentos de interface web, processamento de formulários, consultas e alterações em banco de dados, controle de sessão e organização de uma aplicação PHP. A documentação e a apresentação permitem relacionar o código às funcionalidades visíveis para o usuário.

## 🎓 Contexto acadêmico

- **Disciplina:** Desenvolvimento de Sistemas II.
- **Projeto:** Sistema Lista de Amigos — CRUD e Login.
- **Instituição:** ETEC / Centro Paula Souza.

## 🔗 Referências

- [Documentação do PHP](https://www.php.net/manual/pt_BR/)
- [Documentação do MySQL](https://dev.mysql.com/doc/)
- [W3.CSS](https://www.w3schools.com/w3css/)
- [Font Awesome](https://fontawesome.com/)
- [Sintaxe Markdown no GitHub](https://docs.github.com/pt/get-started/writing-on-github/getting-started-with-writing-and-formatting-on-github/basic-writing-and-formatting-syntax)

---

<p align="center"><strong>Projeto acadêmico • Desenvolvimento de Sistemas II</strong><br>Aprendendo desenvolvimento web na prática, do login ao CRUD.</p>
