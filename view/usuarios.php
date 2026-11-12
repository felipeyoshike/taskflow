<?php
  require "../processamento/verificarLogin.php";
  require "../processamento/funcoesUsuarios.php";
  $usuarios = retornarUsuarios();

  $usuarioEditar = null;
  if (isset($_GET['editar'])) {
    $usuarioEditar = buscarUsuario($_GET['editar']);
  }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TaskFlow - Usuários</title>
  <link rel="icon" href="../img/logo.png" type="image/png">
  <link rel="stylesheet" href="../css/base.css">
  <link rel="stylesheet" href="../css/usuarios.css">
</head>
<body>
  <aside class="sidebar" id="sidebar">
    <h1 class="logo">TaskFlow</h1>
    <a href="dashboard.php">Dashboard</a>
    <a href="minhas-tarefas.php">Minhas tarefas</a>
    <a href="projetos.php">Projetos</a>
    <a href="categorias.php">Categorias</a>
    <a href="usuarios.php" class="ativo">Usuários</a>
    <a href="../processamento/sair.php" id="btnSair">Sair</a>
    <p class="usuario suave"><?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></p>
  </aside>

  <main>
    <button class="btn sec menu-btn" id="btnMenu">☰ Menu</button>

    <h2>Usuários</h2>
    <form id="formUsuario" class="card form" action="../processamento/processamentoUsuarios.php" method="post">
      <h3 class="full" id="tituloForm"><?php echo $usuarioEditar ? 'Editar usuário' : 'Novo usuário'; ?></h3>
      <input type="hidden" id="uId" name="inputId" value="<?php echo $usuarioEditar['id'] ?? ''; ?>">
      <div><label for="uNome">Nome completo *</label><input id="uNome" name="inputNome" value="<?php echo htmlspecialchars($usuarioEditar['nome'] ?? ''); ?>" required></div>
      <div><label for="uEmail">E-mail *</label><input id="uEmail" name="inputEmail" type="email" value="<?php echo htmlspecialchars($usuarioEditar['email'] ?? ''); ?>" required></div>
      <div><label for="uSenha">Senha</label><input id="uSenha" name="inputSenha" type="password"></div>
      <div class="full">
        <button type="submit" class="btn">Salvar usuário</button>
        <button type="reset" class="btn sec">Limpar</button>
        <?php if ($usuarioEditar) { ?><a href="usuarios.php" class="btn cancelar">Cancelar edição</a><?php } ?>
      </div>
    </form>

    <div class="card">
      <div class="filtros"><input id="uBusca" placeholder="Buscar por nome ou e-mail..."></div>
      <div class="tabela">
        <table>
          <thead><tr><th>Nome</th><th class="col-email">E-mail</th><th class="col-acoes">Ações</th></tr></thead>
          <!-- BACK-END: um <tr> por usuário (nunca exiba a senha) -->
          <tbody id="corpoUsuarios">
            <?php while ($u = mysqli_fetch_assoc($usuarios)) { ?>
              <tr>
                <td><b><?php echo htmlspecialchars($u['nome']); ?></b></td>
                <td><?php echo htmlspecialchars($u['email']); ?></td>
                <td class="col-acoes">
                  <a href="usuarios.php?editar=<?php echo $u['id']; ?>" class="btn sec peq">Editar</a>
                  <form action="../processamento/processamentoUsuarios.php" method="post" style="display:inline">
                    <input type="hidden" name="inputExcluirId" value="<?php echo $u['id']; ?>">
                    <button class="btn perigo peq" data-confirmar="Excluir este usuário?">Excluir</button>
                  </form>
                </td>
              </tr>
            <?php } ?>

            <tr class="sem-registros" <?php if (mysqli_num_rows($usuarios) > 0) echo 'hidden'; ?>>
              <td colspan="3" class="vazio">Nenhum usuário cadastrado.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <script src="../js/base.js"></script>
  <script src="../js/usuarios.js"></script>
</body>
</html>