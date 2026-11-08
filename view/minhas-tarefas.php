<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Minhas tarefas - TaskFlow</title>
  <link rel="stylesheet" href="../css/base.css">
  <link rel="stylesheet" href="../css/minhas-tarefas.css">
</head>
<body>
  <aside class="sidebar" id="sidebar">
    <h1 class="logo">TaskFlow</h1>
    <a href="dashboard.php" class="ativo">Dashboard</a>
    <a href="minhas-tarefas.php">Minhas tarefas</a>
    <a href="projetos.php">Projetos</a>
    <a href="categorias.php">Categorias</a>
    <a href="usuarios.php">Usuários</a>
    <a href="login.php" id="btnSair">Sair</a>
    <!-- BACK-END: trocar "Usuário" pelo nome do usuário logado (sessão) -->
    <p class="usuario suave">Usuário</p>
  </aside>

  <main>
  <button class="btn sec menu-btn" id="btnMenu">☰ Menu</button>

  <h2>Minhas tarefas</h2>
  <form id="formTarefa" class="card form" action="" method="post">
    <h3 class="full" id="tituloForm">Nova tarefa</h3>
    <input type="hidden" id="tId" name="id">
    <div class="full"><label for="tTitulo">Título *</label><input id="tTitulo" name="titulo" required maxlength="100"></div>
    <div class="full"><label for="tDescricao">Descrição</label><textarea id="tDescricao" name="descricao" rows="2"></textarea></div>
    <!-- BACK-END: preencher as opções de categoria e projeto com os dados do banco -->
    <div><label for="tCategoria">Categoria *</label><select id="tCategoria" name="categoria_id" required><option value="">Selecione...</option></select></div>
    <div><label for="tProjeto">Projeto (opcional)</label><select id="tProjeto" name="projeto_id"><option value="">Sem projeto</option></select></div>
    <div><label for="tVencimento">Vencimento *</label><input type="date" id="tVencimento" name="vencimento" required></div>
    <div><label for="tPrioridade">Prioridade</label><select id="tPrioridade" name="prioridade"><option>Baixa</option><option selected>Média</option><option>Alta</option></select></div>
    <div><label for="tStatus">Status</label><select id="tStatus" name="status"><option>Pendente</option><option>Concluída</option></select></div>
      <div class="full"><button type="submit" class="btn">Salvar tarefa</button> <button type="reset" class="btn sec">Limpar</button></div>
  </form>

  <div class="card">
    <div class="filtros">
      <input id="fBusca" placeholder="Buscar por título...">
      <select id="fStatus"><option value="">Todos os status</option><option>Pendente</option><option>Concluída</option><option>Atrasada</option></select>
      <select id="fCategoria"><option value="">Todas as categorias</option></select>
      <button type="button" class="btn sec" id="btnOrdem">Ordenar por prazo</button>
    </div>
    <div class="tabela">
      <table>
        <thead><tr><th>Tarefa</th><th>Categoria</th><th>Projeto</th><th>Prazo</th><th>Prioridade</th><th>Situação</th><th>Ações</th></tr></thead>
        <!-- BACK-END: um <tr> por tarefa. Atributos usados pelos filtros do JavaScript:
            data-status="Pendente | Concluída | Atrasada"  data-categoria="id da categoria"  data-vencimento="AAAA-MM-DD"
            Exemplo:  <tr data-status="Pendente" data-categoria="1" data-vencimento="2026-11-20"> ... </tr>
            Botão excluir:  <button class="btn perigo peq" data-confirmar="Excluir esta tarefa?">Excluir</button> -->
        <tbody id="corpoTarefas">
          <tr class="sem-registros"><td colspan="7" class="vazio">Nenhuma tarefa cadastrada.</td></tr>
        </tbody>
      </table>
    </div>
  </div>
  </main>

  <script src="../js/base.js"></script>
  <script src="../js/minhas-tarefas.js"></script>
</body>
</html>
