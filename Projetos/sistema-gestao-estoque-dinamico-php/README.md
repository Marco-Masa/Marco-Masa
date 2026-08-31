# 📦 Sistema de Gestão de Estoque Dinâmico em PHP

Este projeto é uma aplicação web funcional desenvolvida para fins acadêmicos, demonstrando a integração prática entre **PHP**, **HTML5** e **CSS3** sem a utilização de frameworks ou arquivos JavaScript. O sistema gerencia um controle de estoque em tempo real utilizando conceitos estruturais fundamentais da linguagem PHP.

---

## 🚀 Funcionalidades da Aplicação

1. **Cadastro de Produtos:** Permite inserir novos produtos validando o formato dos dados (campos obrigatórios, números inteiros para quantidade e valores decimais maiores que zero para preço). Possui validação contra duplicidade de nomes.
2. **Movimentação de Estoque:** Menu interativo baseado em `<select>` que possibilita dar entrada (somar) ou saída (subtrair) na quantidade de itens e atualizar o preço de venda de um produto já cadastrado.
3. **Listagem Geral:** Relatório estruturado em formato de tabela exibindo todos os itens gravados na memória.
4. **Alertas Críticos:** Painel automatizado que avisa visualmente quais produtos atingiram o limite mínimo de segurança (definido em 5 unidades).

---

## 🛠️ Tecnologias e Conceitos PHP Aplicados

O sistema foi arquitetado focando no cumprimento das diretrizes de lógica estudadas:

*   **Persistência com Sessões (`$_SESSION`):** Como não há banco de dados SQL implementado, o sistema utiliza as sessões nativas do PHP para persistir e manter os dados armazenados temporariamente na memória a cada recarregamento de página.
*   **Comunicação Baseada em Protocolo HTTP:**
    *   **Método `POST`:** Utilizado para envio seguro dos dados de formulários de cadastro e movimentação.
    *   **Método `GET`:** Utilizado via parâmetros de URL para alternar entre as abas visuais do painel.
*   **Funções Modulares:** Lógica isolada em sub-rotinas reutilizáveis para garantir organização e legibilidade de código.
*   **Estruturas de Repetição Praticadas:**
    *   `foreach`: Aplicado na função de listagem para percorrer e mapear chaves e valores do array associativo de produtos.
    *   `for`: Aplicado na função de alertas críticos, demonstrando o controle de repetição por meio de um contador manual baseado no tamanho dinâmico do array (`count()`).
*   **Controle de Visibilidade Dinâmico (CSS + PHP):** Substituição do JavaScript pela renderização condicional do PHP, injetando as classes CSS `.bloco-visivel` (`display: block`) ou `.bloco-oculto` (`display: none`) dependendo da navegação do usuário.

---

## 📁 Estrutura de Arquivos

O projeto foi unificado de maneira limpa em um único arquivo de execução para facilitar o deploy e a correção:

```text
- index.php         # Arquivo principal contendo a Lógica PHP, Interface HTML e Estilização CSS.
- README.md         # Documentação completa do projeto.
```

---

## 💻 Como Executar o Projeto Localmente

Para rodar esta aplicação, você precisará de um ambiente de desenvolvimento local que suporte PHP (XAMPP, WampServer, Laragon ou Docker).

### Passo a Passo (Exemplo com XAMPP):

1. Certifique-se de ter o **XAMPP** instalado em sua máquina.
2. Ative o módulo **Apache** através do painel de controle do XAMPP.
3. Navegue até o diretório padrão de arquivos do servidor:
   * **Windows:** `C:\xampp\htdocs\`
   * **Linux:** `/opt/lampp/htdocs/`
4. Crie uma pasta chamada `controle-estoque` dentro desse diretório.
5. Salve o arquivo do projeto como `index.php` dentro da pasta criada.
6. Abra o seu navegador web e acesse a URL:
   ```text
   http://localhost/controle-estoque/index.php
   ```

---

## 🧠 Arquitetura do Mapa Mental (Resumo do Projeto)

Abaixo está a representação textual da estrutura conceitual utilizada para a criação do mapa mental digital exigido:

*   **Nó Central:** `Sistema de Estoque PHP Sem JS`
    *   **Entrada de Dados (Forms):** Cadastro (Nome, Qtd, Preço) $\rightarrow$ Validação de Tipos $\rightarrow$ Bloqueio de Duplicados.
    *   **Processamento de Estado:** Inicialização da Sessão (`session_start`) $\rightarrow$ Escuta de Requisições (`POST`/`GET`).
    *   **Regras de Negócio (Funções):**
        *   `gerarTabelaEstoque()` $\rightarrow$ Loop `foreach` $\rightarrow$ Renderização de Linhas HTML.
        *   `gerarAlertasReposicao()` $\rightarrow$ Loop `for` baseado em índice $\rightarrow$ Validação de Limite Crítico ($\le 5$).
    *   **Navegação Visual (UI):** Abas Dinâmicas via Parâmetro GET $\rightarrow$ Alternância de Estado CSS (`display: block/none`).
