# TaskFlow

Sistema web de gerenciamento de tarefas, desenvolvido com **HTML, CSS, JavaScript, PHP e MySQL**.
Cada usuário organiza suas tarefas em categorias e projetos, acompanha prazos e progresso em um dashboard e registra comentários em cada tarefa.

Trabalho Prático 2 (Back-End) da disciplina **Linguagem de Programação IV** — Fatec Presidente Prudente, curso de Análise e Desenvolvimento de Sistemas. Desenvolvido individualmente.

## Funcionalidades

**Acesso e segurança**
- Login com usuário e senha gravados no banco de dados
- Cadastro de novos usuários
- Recuperação de senha (troca de senha informando o e-mail cadastrado)
- Controle de acesso por variáveis de sessão: páginas internas só abrem com o usuário logado
- Se o usuário excluir a própria conta, a sessão é encerrada e ele volta para o login

**Cadastros (CRUD completo, com persistência no MySQL)**
- Usuários
- Categorias (mostra quantas tarefas cada categoria possui)
- Projetos (período de início e fim, com barra de progresso)
- Tarefas (título, descrição, categoria, projeto, vencimento, prioridade e status)
- Comentários das tarefas (criar, ver, editar e excluir; só o autor altera o próprio comentário)

**Funcionalidades da temática (gestão de tarefas)**
- Situação calculada automaticamente a partir da data: *Pendente*, *Vence em breve*, *Atrasada* ou *Concluída*
- Concluir e reabrir tarefas com um clique, o que atualiza o progresso dos projetos
- Dashboard com total de tarefas, pendentes, concluídas e atrasadas, próximos vencimentos, gráfico por status e progresso por projeto
- Busca por título, filtro por status e categoria e ordenação por prazo

## Telas

| Tela | Arquivo |
|------|---------|
| Login | `view/login.php` |
| Cadastro de usuário | `view/cadastro.php` |
| Trocar senha | `view/trocar-senha.php` |
| Dashboard | `view/dashboard.php` |
| Minhas tarefas (com janela de comentários) | `view/minhas-tarefas.php` |
| Projetos | `view/projetos.php` |
| Categorias | `view/categorias.php` |
| Usuários | `view/usuarios.php` |

## Tecnologias

- **Front-end:** HTML5, CSS3 e JavaScript puro
- **Back-end:** PHP (método POST e variáveis de sessão)
- **Banco de dados:** MySQL/MariaDB, acessado com a extensão `mysqli`
- **Versionamento:** Git e GitHub

## Estrutura do projeto

```
taskflow/
├── index.php            # redireciona para o login
├── view/                # páginas (HTML + PHP)
├── css/                 # estilos (base.css + um arquivo por página)
├── js/                  # scripts de cada página
├── img/                 # logotipo
└── processamento/
    ├── funcoesBD.php            # conexão com o banco
    ├── funcoes*.php             # consultas SQL de cada entidade
    ├── processamento*.php       # recebem os formulários (POST) e redirecionam
    ├── verificarLogin.php       # bloqueia páginas para quem não está logado
    └── sair.php                 # encerra a sessão
```

O fluxo segue sempre o mesmo caminho: a página em `view/` envia um formulário por **POST** para um arquivo `processamento*.php`, que chama as funções de `funcoes*.php`, grava ou consulta o MySQL e redireciona de volta para a página.

## Banco de dados

Banco: `taskflow`

| Tabela | Principais campos |
|--------|-------------------|
| `usuarios` | id, nome, email, senha |
| `categorias` | id, nome, descricao, usuario_id |
| `projetos` | id, nome, descricao, inicio, fim, usuario_id |
| `tarefas` | id, titulo, descricao, vencimento, prioridade, status, usuario_id, categoria_id, projeto_id |
| `comentarios` | id, tarefa_id, usuario_id, texto, criado_em, editado_em |

Relacionamentos: um usuário possui categorias, projetos e tarefas; cada tarefa pertence a uma categoria e, opcionalmente, a um projeto; cada comentário pertence a uma tarefa e a um usuário.

As chaves estrangeiras usam `ON DELETE CASCADE`: ao excluir um usuário, suas categorias, projetos, tarefas e comentários também são removidos, e ao excluir uma tarefa seus comentários são apagados junto. Ao excluir um projeto, as tarefas dele continuam existindo, apenas sem projeto (`ON DELETE SET NULL`).

## Como executar

1. Instale o **XAMPP** (ou outro ambiente com Apache, PHP e MySQL) e inicie o Apache e o MySQL.
2. Copie a pasta do projeto para `htdocs` (por exemplo, `C:\xampp\htdocs\taskflow`).
3. No phpMyAdmin, crie o banco `taskflow` e importe o arquivo `taskflow.sql` (backup do banco, incluído no repositório). Ele já traz alguns registros de exemplo.
4. Confira a conexão em `processamento/funcoesBD.php` (padrão: servidor `localhost`, usuário `root`, sem senha, banco `taskflow`).
5. Acesse `http://localhost/taskflow/`.

Usuário de exemplo já cadastrado no backup: `felipe@gmail.com` / senha `123456`.

## Uso de inteligência artificial

O desenvolvimento contou com o apoio do **Claude (Anthropic)** como ferramenta de auxílio:

- Protótipo de interface e estilos (HTML/CSS/JavaScript) das telas
- Módulo de comentários das tarefas (interface e funções de banco)
- Pequenos ajustes de layout e consultas SQL

O restante do back-end em PHP (login, sessões, recuperação de senha, CRUDs de usuários, categorias, projetos e tarefas) e a integração com o MySQL foram desenvolvidos pelo autor. Todo o código gerado com apoio de IA foi revisado, testado e integrado manualmente.

## Segurança

Por se tratar de um trabalho acadêmico, **nenhum tipo de segurança foi considerado no desenvolvimento do projeto**. Por exemplo, as senhas ficam gravadas em texto puro no banco e a maioria das consultas SQL é montada com concatenação de texto, sem proteção contra SQL Injection. Este sistema não deve ser usado em produção sem esses cuidados.

## Autores

- Felipe Yoshike — [@felipeyoshike](https://github.com/felipeyoshike)

## Licença

Distribuído sob a licença MIT. Veja o arquivo [LICENSE](LICENSE).
