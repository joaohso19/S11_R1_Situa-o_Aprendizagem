# Gestão de Alunos
## Mini Sistema com CRUD (HTML + CSS + PHP + PostgreSQL)

### 1. Sobre o Projeto
Este mini sistema foi desenvolvido em sala de aula com a orientação do professor, com o objetivo de aprender na prática os conceitos básicos de desenvolvimento web backend utilizando **PHP estruturado** e banco de dados relacional **PostgreSQL**.

O projeto contempla um CRUD completo (Criar, Consultar, Atualizar e Deletar) para cadastro de alunos, além de um módulo de controle de acesso (login, cadastro de usuários e proteção de páginas através de sessões).

---

### 2. Objetivos
1. **Relatório de alunos cadastrados:** listagem geral de todos os alunos registrados no banco.
2. **Consulta de aluno específico:** busca individual das informações através do ID do aluno.
3. **Atualizar cadastro do aluno:** alteração de dados cadastrais existentes informando o ID.
4. **Excluir aluno(s):** remoção de registro do banco de dados pelo ID.
5. **Cadastrar novo aluno:** formulário para inserção de novos alunos.
6. **Autenticação de usuários:** sistema de login, cadastro de conta e controle de sessão para restringir o acesso às páginas do sistema.

---

### 3. Tecnologias Utilizadas
* **HTML5:** estruturação visual das telas e formulários (`<form>`, `<input>`, `<main>`, etc.).
* **CSS3:** estilização e layout das páginas (`header`, `footer`, inputs).
* **PHP:** processamento das requisições via método `POST`, manipulação de sessões (`$_SESSION`) e lógica das funções.
* **PostgreSQL:** sistema gerenciador de banco de dados relacional.
* **PDO (PHP Data Objects):** extensão do PHP para conexão segura com o banco, utilizando *prepared statements* (`prepare` e `bindParam`) contra injeção de SQL.

---

### 4. Estrutura de Pastas do Projeto

```text
mini_sistema/
│
├── app/                      # Telas operacionais do CRUD de alunos
│   ├── create.php            # Tela de cadastro de aluno
│   ├── relatorio.php         # Tela que lista todos os alunos
│   ├── consultar.php         # Tela de busca de aluno por ID
│   ├── update.php            # Tela de edição de dados do aluno
│   └── delete.php            # Tela de exclusão de aluno
│
├── database/                 # Configuração do banco de dados
│   └── connect.php           # Script de conexão PDO com PostgreSQL
│
├── includes/                 # Componentes reutilizáveis e regras de negócio
│   ├── functions.php         # Todas as funções de CRUD (alunos e usuários)
│   ├── header.php            # Cabeçalho padrão do site
│   └── footer.php            # Rodapé padrão do site
│
├── login/                    # Módulo de autenticação
│   ├── cadastrar.php         # Cadastro de novo usuário do sistema
│   ├── login.php             # Tela de login com validação
│   ├── logout.php            # Encerramento da sessão
│   └── verifica_user.php     # Trava de segurança (bloqueia quem não logou)
│
└── index.php                 # Página inicial / Menu principal
```

---

### 5. Estrutura do Banco de Dados

No PostgreSQL foram criadas duas tabelas principais:

#### Tabela `usuarios`
Responsável por armazenar quem tem permissão para entrar no sistema:
```sql
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);
```

#### Tabela `alunos`
Responsável pelo cadastro dos estudantes:
```sql
CREATE TABLE alunos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    turma VARCHAR(50) NOT NULL,
    email VARCHAR(150),
    nasc DATE,
    ativo BOOLEAN DEFAULT TRUE
);
```

---

### 6. Como o Sistema Funciona

#### 6.1. Conexão com o Banco (`database/connect.php`)
A conexão é feita utilizando `new PDO()` apontando para o servidor PostgreSQL (configurado no IP do laboratório da aula):
* Criação do objeto `$conexao`.
* Tratamento de exceções com bloco `try / catch (PDOException $e)`.

#### 6.2. Autenticação e Sessão (`login/`)
* **Cadastro (`cadastrar.php`):** executa a função `cadastrar_user()`, gravando e-mail e senha na tabela `usuarios`.
* **Login (`login.php`):** chama `consulta_user()`, confere se os dados informados batem com o banco e, se corretos, inicia a sessão gravando `$_SESSION['id']`.
* **Segurança (`verifica_user.php`):** incluído nas páginas restritas. Se o usuário tentar acessar sem estar logado (`!isset($_SESSION['id'])`), é redirecionado automaticamente para `login.php`.
* **Logout (`logout.php`):** limpa o array `$_SESSION` e destrói a sessão com `session_destroy()`.

#### 6.3. Módulo de Alunos (`app/` e `includes/functions.php`)
* **Cadastrar Aluno (`create.php`):** formulário com Nome, Turma, E-mail, Data de Nascimento e Status Ativo (Sim/Não). Envia para a função `cadastrar()`.
* **Relatório Geral (`relatorio.php`):** chama a função `relatorio()`, que executa um `SELECT * FROM alunos ORDER BY id` e exibe os registros na tela.
* **Consultar Específico (`consultar.php`):** recebe o ID do aluno e busca seus detalhes via `consultar($conexao, $id)`.
* **Atualizar Aluno (`update.php`):** recebe o ID do registro e os novos dados para rodar a query de `UPDATE`.
* **Excluir Aluno (`delete.php`):** solicita o ID e executa a query `DELETE FROM alunos WHERE id = :id`.

---

### 7. Principais Aprendizados em Aula

Durante as aulas práticas com o professor, aprendemos:
1. **Separar responsabilidades:** manter conexão (`database/`), funções de banco (`functions.php`), layouts repetidos (`header.php` e `footer.php`) e páginas de visualização em pastas separadas.
2. **Segurança básica com PDO:** nunca concatenar variáveis diretamente no SQL. Usar sempre `prepare()` e `bindParam()` para evitar vulnerabilidades de SQL Injection.
3. **Persistência de Sessão:** utilizar `session_start()` e `$_SESSION` para controlar quem pode ou não navegar pelas páginas internas.
4. **Ciclo de vida do formulário web:** envio de dados via `POST` e tratamento no mesmo arquivo usando a checagem `if($_SERVER['REQUEST_METHOD'] == 'POST')`.

---

### 8. Conclusão
O desenvolvimento deste projeto foi fundamental para entender o fluxo de dados completo de uma aplicação web clássica, desde a interface HTML até a gravação e manipulação das tabelas no PostgreSQL através do PHP. O resultado foi um mini sistema funcional e bem estruturado.