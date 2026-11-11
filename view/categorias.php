<?php
 require "../processamento/verificarLogin.php"; 
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
  <form id="formCategoria" class="card form form-categoria" action="" method="post">
    <h3 class="full" id="tituloForm">Nova categoria</h3>
    <input type="hidden" id="cId" name="id">

    <div>
      <label for="cNome">Nome *</label>
      <input id="cNome" name="nome" required maxlength="50">
    </div>

    <div>
      <label for="cDescricao">Descrição</label>
      <input id="cDescricao" name="descricao" maxlength="255">
    </div>

    <div class="full">
      <button type="submit" class="btn">Salvar categoria</button>
      <button type="reset" class="btn sec">Limpar</button>
    </div>
  </form>

  <div class="card">
    <div class="filtros"><input id="cBusca" placeholder="Buscar por nome..."></div>
    <div class="tabela">
      <table>
        <thead><tr><th>Categoria</th><th>Descrição</th><th>Tarefas</th><th>Ações</th></tr></thead>
        <!-- BACK-END: um <tr> por categoria -->
        <tbody id="corpoCategorias">
          <tr class="sem-registros"><td colspan="4" class="vazio">Nenhuma categoria cadastrada.</td></tr>
        </tbody>
      </table>
    </div>
  </div>
  </main>

  <script src="../js/base.js"></script>
  <script src="../js/categorias.js"></script>
</body>
</html>