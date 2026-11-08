<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TaskFlow - Projetos</title>
  <link rel="icon" href="../img/logo.png" type="image/png">
  <link rel="stylesheet" href="../css/base.css">
  <link rel="stylesheet" href="../css/projetos.css">
</head>
<body>
  <aside class="sidebar" id="sidebar">
    <h1 class="logo">TaskFlow</h1>
    <a href="dashboard.php">Dashboard</a>
    <a href="minhas-tarefas.php">Minhas tarefas</a>
    <a href="projetos.php" class="ativo">Projetos</a>
    <a href="categorias.php">Categorias</a>
    <a href="usuarios.php">Usuários</a>
    <a href="login.php" id="btnSair">Sair</a>
    <!-- BACK-END: trocar "Usuário" pelo nome do usuário logado (sessão) -->
    <p class="usuario suave">Usuário</p>
  </aside>

  <main>
  <button class="btn sec menu-btn" id="btnMenu">☰ Menu</button>

  <h2>Projetos</h2>
  <form id="formProjeto" class="card form" action="" method="post">
    <h3 class="full" id="tituloForm">Novo projeto</h3>
    <input type="hidden" id="pId" name="id">
    <div class="full"><label for="pNome">Nome do projeto *</label><input id="pNome" name="nome" required maxlength="80"></div>
    <div class="full"><label for="pDescricao">Descrição</label><textarea id="pDescricao" name="descricao" rows="2"></textarea></div>
    <div><label for="pInicio">Data de início *</label><input type="date" id="pInicio" name="inicio" required></div>
    <div><label for="pFim">Conclusão prevista *</label><input type="date" id="pFim" name="fim" required></div>
      <div class="full"><button type="submit" class="btn">Salvar projeto</button> <button type="reset" class="btn sec">Limpar</button></div>
  </form>

  <div class="card">
    <div class="filtros"><input id="pBusca" placeholder="Buscar por nome..."></div>
    <div class="tabela">
      <table>
        <thead><tr><th>Projeto</th><th>Período</th><th>Tarefas</th><th class="col-progresso">Progresso</th><th>Ações</th></tr></thead>
        <!-- BACK-END: um <tr> por projeto. Progresso = tarefas concluídas / total * 100:
            <div class="progresso"><i style="width:50%"></i></div><span class="suave">50%</span> -->
        <tbody id="corpoProjetos">
          <tr class="sem-registros"><td colspan="5" class="vazio">Nenhum projeto cadastrado.</td></tr>
        </tbody>
      </table>
    </div>
  </div>
  </main>

  <script src="../js/base.js"></script>
  <script src="../js/projetos.js"></script>
</body>
</html>
