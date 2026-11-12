<?php
 require "../processamento/verificarLogin.php";
 require "../processamento/funcoesCategorias.php";

 $categoriaEditar = null;
 if (isset($_GET['editar'])) {
   $categoriaEditar = buscarCategoria($_GET['editar']);
 }
 $categorias = listarCategorias();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TaskFlow - Categorias</title>
  <link rel="icon" href="../img/logo.png" type="image/png">
  <link rel="stylesheet" href="../css/base.css">
  <link rel="stylesheet" href="../css/categorias.css">
</head>
<body>
  <aside class="sidebar" id="sidebar">
    <h1 class="logo">TaskFlow</h1>
    <a href="dashboard.php">Dashboard</a>
    <a href="minhas-tarefas.php">Minhas tarefas</a>
    <a href="projetos.php">Projetos</a>
    <a href="categorias.php" class="ativo">Categorias</a>
    <a href="usuarios.php">Usuários</a>
    <a href="../processamento/sair.php" id="btnSair">Sair</a>
    <p class="usuario suave"><?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></p>
  </aside>

  <main>
  <button class="btn sec menu-btn" id="btnMenu">☰ Menu</button>

  <h2>Categorias</h2>
  <form id="formCategoria" class="card form" action="../processamento/processamentoCategorias.php" method="post">
    <h3 class="full" id="tituloForm"><?php echo $categoriaEditar ? 'Editar categoria' : 'Nova categoria'; ?></h3>
    <input type="hidden" id="cId" name="inputId" value="<?php echo $categoriaEditar['id'] ?? ''; ?>">

    <div class="full">
      <label for="cNome">Nome *</label>
      <input id="cNome" name="inputNome" required maxlength="50" value="<?php echo htmlspecialchars($categoriaEditar['nome'] ?? ''); ?>">
    </div>

    <div class="full">
      <label for="cDescricao">Descrição</label>
      <textarea id="cDescricao" name="inputDescricao" rows="2" maxlength="255"><?php echo htmlspecialchars($categoriaEditar['descricao'] ?? ''); ?></textarea>
    </div>

    <div class="full">
      <button type="submit" class="btn">Salvar categoria</button>
      <button type="reset" class="btn sec">Limpar</button>
      <?php if ($categoriaEditar) { ?><a href="categorias.php" class="btn cancelar">Cancelar edição</a><?php } ?>
    </div>
  </form>

  <div class="card">
    <div class="filtros"><input id="cBusca" placeholder="Buscar por nome..."></div>
    <div class="tabela">
      <table>
        <thead><tr><th>Categoria</th><th>Descrição</th><th>Tarefas</th><th class="col-acoes">Ações</th></tr></thead>
        <tbody id="corpoCategorias">
          <?php while ($c = mysqli_fetch_assoc($categorias)) { ?>
            <tr>
              <td><b><?php echo htmlspecialchars($c['nome']); ?></b></td>
              <td><?php echo htmlspecialchars($c['descricao'] ?? ''); ?></td>
              <td>-</td>
              <td class="col-acoes">
                <a href="categorias.php?editar=<?php echo $c['id']; ?>" class="btn sec peq">Editar</a>
                <form action="../processamento/processamentoCategorias.php" method="post" style="display:inline">
                  <input type="hidden" name="inputExcluirId" value="<?php echo $c['id']; ?>">
                  <button class="btn perigo peq" data-confirmar="Excluir esta categoria?">Excluir</button>
                </form>
              </td>
            </tr>
          <?php } ?>
          <tr class="sem-registros" <?php if (mysqli_num_rows($categorias) > 0) echo 'hidden'; ?>>
            <td colspan="4" class="vazio">Nenhuma categoria cadastrada.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  </main>

  <script src="../js/base.js"></script>
  <script src="../js/categorias.js"></script>
</body>
</html>