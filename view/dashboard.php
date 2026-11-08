<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TaskFlow - Dashboard</title>
  <link rel="icon" href="../img/logo.png" type="image/png">
  <link rel="stylesheet" href="../css/base.css">
  <link rel="stylesheet" href="../css/dashboard.css">
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
  <button class="btn sec menu-btn" id="btnMenu">Menu</button>

  <h2>Dashboard</h2>
  <p class="suave" id="dataHoje"></p>

  <!-- BACK-END: os números abaixo virão do banco (COUNT das tarefas) -->
  <div class="grid cards4">
    <div class="card stat"><b>0</b><span>Total de tarefas</span></div>
    <div class="card stat"><b>0</b><span>Pendentes</span></div>
    <div class="card stat concluida"><b>0</b><span>Concluídas</span></div>
    <div class="card stat atrasada"><b>0</b><span>Atrasadas</span></div>
  </div>

  <div class="grid cols2">
    <div class="card">
      <h3>Próximos vencimentos</h3>
      <!-- BACK-END: um <li> por tarefa pendente, ordenadas pelo vencimento -->
      <ul class="lista">
        <li class="vazio">Nenhuma tarefa pendente.</li>
      </ul>
    </div>
    <div class="card">
      <h3>Tarefas por status</h3>
      <!-- BACK-END: largura da barra = quantidade / total * 100 (%) -->
      <div class="linha-graf"><span>Pendentes</span><div class="progresso"><i style="width:0%;background:var(--cor)"></i></div><b>0</b></div>
      <div class="linha-graf"><span>Concluídas</span><div class="progresso"><i style="width:0%;background:var(--ok)"></i></div><b>0</b></div>
      <div class="linha-graf"><span>Atrasadas</span><div class="progresso"><i style="width:0%;background:var(--erro)"></i></div><b>0</b></div>
    </div>
  </div>

  <div class="card">
    <h3>Projetos</h3>
    <!-- BACK-END: um <li> por projeto, com a barra de progresso (% de tarefas concluídas) -->
    <ul class="lista">
      <li class="vazio">Nenhum projeto cadastrado.</li>
    </ul>
  </div>
  </main>

  <script src="../js/base.js"></script>
  <script src="../js/dashboard.js"></script>
</body>
</html>
