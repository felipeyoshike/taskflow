<?php
 require "../processamento/verificarLogin.php";
 require "../processamento/funcoesTarefas.php";
 require "../processamento/funcoesProjetos.php";

 date_default_timezone_set('America/Sao_Paulo');
 $hoje = date('Y-m-d');
 $usuario_id = $_SESSION['usuario_id'];

 $resumo = resumoTarefas($usuario_id, $hoje);
 $proximas = listarProximasTarefas($usuario_id);
 $projetos = listarProjetos($usuario_id);

 $total = (int) $resumo['total'];
 $concluidas = (int) $resumo['concluidas'];
 $pendentes = (int) $resumo['pendentes'];          
 $atrasadas = (int) $resumo['atrasadas'];
 $noPrazo = $pendentes - $atrasadas;                     

 function percentual($valor, $total){
   return $total > 0 ? round($valor / $total * 100) : 0;
 }
?>

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
    <a href="../processamento/sair.php" id="btnSair">Sair</a>
    <p class="usuario suave"><?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></p>
  </aside>

  <main>
  <button class="btn sec menu-btn" id="btnMenu">Menu</button>

  <h2>Dashboard</h2>
  <p class="suave" id="dataHoje"></p>

  <div class="grid cards4">
    <div class="card stat"><b><?php echo $total; ?></b><span>Total de tarefas</span></div>
    <div class="card stat"><b><?php echo $pendentes; ?></b><span>Pendentes</span></div>
    <div class="card stat concluida"><b><?php echo $concluidas; ?></b><span>Concluídas</span></div>
    <div class="card stat atrasada"><b><?php echo $atrasadas; ?></b><span>Atrasadas</span></div>
  </div>

  <div class="grid cols2">
    <div class="card">
      <h3>Próximos vencimentos</h3>
      <ul class="lista">
        <?php while ($t = mysqli_fetch_assoc($proximas)) {
          $dias = (strtotime($t['vencimento']) - strtotime($hoje)) / 86400;
          $classe = $dias < 0 ? 'atrasada' : ($dias <= 3 ? 'proxima' : 'pendente');
        ?>
          <li>
            <span><?php echo htmlspecialchars($t['titulo']); ?></span>
            <span class="badge <?php echo $classe; ?>"><?php echo date('d/m/Y', strtotime($t['vencimento'])); ?></span>
          </li>
        <?php } ?>
        <?php if (mysqli_num_rows($proximas) == 0) { ?>
          <li class="vazio">Nenhuma tarefa pendente.</li>
        <?php } ?>
      </ul>
    </div>
    <div class="card">
      <h3>Tarefas por status</h3>
      <div class="linha-graf"><span>Pendentes</span><div class="progresso"><i style="width:<?php echo percentual($noPrazo, $total); ?>%;background:var(--cor)"></i></div><b><?php echo $noPrazo; ?></b></div>
      <div class="linha-graf"><span>Concluídas</span><div class="progresso"><i style="width:<?php echo percentual($concluidas, $total); ?>%;background:var(--ok)"></i></div><b><?php echo $concluidas; ?></b></div>
      <div class="linha-graf"><span>Atrasadas</span><div class="progresso"><i style="width:<?php echo percentual($atrasadas, $total); ?>%;background:var(--erro)"></i></div><b><?php echo $atrasadas; ?></b></div>
    </div>
  </div>

  <div class="card">
    <h3>Projetos</h3>
    <ul class="lista">
      <?php while ($p = mysqli_fetch_assoc($projetos)) {
        $totalProjeto = (int) $p['total_tarefas'];
        $feitasProjeto = (int) $p['concluidas'];
        $pct = percentual($feitasProjeto, $totalProjeto);
      ?>
        <li>
          <div style="flex:1">
            <?php echo htmlspecialchars($p['nome']); ?> <span class="suave"><?php echo $feitasProjeto; ?>/<?php echo $totalProjeto; ?> tarefas</span>
            <div class="progresso"><i style="width:<?php echo $pct; ?>%"></i></div>
          </div>
          <b><?php echo $pct; ?>%</b>
        </li>
      <?php } ?>
      <?php if (mysqli_num_rows($projetos) == 0) { ?>
        <li class="vazio">Nenhum projeto cadastrado.</li>
      <?php } ?>
    </ul>
  </div>
  </main>

  <script src="../js/base.js"></script>
  <script src="../js/dashboard.js"></script>
</body>
</html>