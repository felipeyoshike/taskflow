<?php
 require "../processamento/verificarLogin.php";
 require "../processamento/funcoesProjetos.php";

 $projetoEditar = null;
 if (isset($_GET['editar'])) {
   $projetoEditar = buscarProjeto($_GET['editar']);
 }
 $projetos = listarProjetos($_SESSION['usuario_id']);
?>

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
    <a href="../processamento/sair.php" id="btnSair">Sair</a>
    <p class="usuario suave"><?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></p>
  </aside>

  <main>
  <button class="btn sec menu-btn" id="btnMenu">☰ Menu</button>

  <h2>Projetos</h2>
  <form id="formProjeto" class="card form" action="../processamento/processamentoProjetos.php" method="post">
    <h3 class="full" id="tituloForm"><?php echo $projetoEditar ? 'Editar projeto' : 'Novo projeto'; ?></h3>
    <input type="hidden" id="pId" name="inputId" value="<?php echo $projetoEditar['id'] ?? ''; ?>">

    <div class="full">
      <label for="pNome">Nome do projeto *</label>
      <input id="pNome" name="inputNome" required maxlength="80" value="<?php echo htmlspecialchars($projetoEditar['nome'] ?? ''); ?>">
    </div>

    <div class="full">
      <label for="pDescricao">Descrição</label>
      <textarea id="pDescricao" name="inputDescricao" rows="2"><?php echo htmlspecialchars($projetoEditar['descricao'] ?? ''); ?></textarea>
    </div>

    <div>
      <label for="pInicio">Data de início *</label>
      <input type="date" id="pInicio" name="inputInicio" required value="<?php echo $projetoEditar['inicio'] ?? ''; ?>">
    </div>

    <div>
      <label for="pFim">Conclusão prevista *</label>
      <input type="date" id="pFim" name="inputFim" required value="<?php echo $projetoEditar['fim'] ?? ''; ?>">
    </div>

    <div class="full">
      <button type="submit" class="btn">Salvar projeto</button>
      <?php if ($projetoEditar) { ?>
        <a href="projetos.php" class="btn cancelar">Cancelar edição</a>
      <?php } else { ?>
        <button type="reset" class="btn sec">Limpar</button>
      <?php } ?>
    </div>
  </form>

  <div class="card">
    <div class="filtros"><input id="pBusca" placeholder="Buscar por nome..."></div>
    <div class="tabela">
      <table>
        <thead><tr><th>Projeto</th><th>Período</th><th>Tarefas</th><th class="col-progresso">Progresso</th><th>Ações</th></tr></thead>
        <tbody id="corpoProjetos">
          <?php while ($p = mysqli_fetch_assoc($projetos)) {
            $total = (int) $p['total_tarefas'];
            $feitas = (int) $p['concluidas'];
            $pct = $total > 0 ? round($feitas / $total * 100) : 0;
          ?>
            <tr>
              <td><b><?php echo htmlspecialchars($p['nome']); ?></b><br><span class="suave"><?php echo htmlspecialchars($p['descricao'] ?? ''); ?></span></td>
              <td><?php echo date('d/m/Y', strtotime($p['inicio'])); ?> a <?php echo date('d/m/Y', strtotime($p['fim'])); ?></td>
              <td><?php echo $feitas; ?>/<?php echo $total; ?></td>
              <td>
                <div class="progresso"><i style="width:<?php echo $pct; ?>%"></i></div>
                <span class="suave"><?php echo $pct; ?>%</span>
              </td>
              <td>
                <a href="projetos.php?editar=<?php echo $p['id']; ?>" class="btn sec peq">Editar</a>
                <form action="../processamento/processamentoProjetos.php" method="post" style="display:inline">
                  <input type="hidden" name="inputExcluirId" value="<?php echo $p['id']; ?>">
                  <button class="btn perigo peq" data-confirmar="Excluir este projeto? As tarefas dele ficarão sem projeto.">Excluir</button>
                </form>
              </td>
            </tr>
          <?php } ?>
          <tr class="sem-registros" <?php if (mysqli_num_rows($projetos) > 0) echo 'hidden'; ?>>
            <td colspan="5" class="vazio">Nenhum projeto cadastrado.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  </main>

  <script src="../js/base.js"></script>
  <script src="../js/projetos.js"></script>
</body>
</html>