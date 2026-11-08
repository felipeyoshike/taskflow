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
    <a href="login.php" id="btnSair">Sair</a>
    <!-- BACK-END: trocar "Usuário" pelo nome do usuário logado (sessão) -->
    <p class="usuario suave">Usuário</p>
  </aside>

<main>
<button class="btn sec menu-btn" id="btnMenu">☰ Menu</button>

<h2>Usuários</h2>
<form id="formUsuario" class="card form" action="" method="post">
  <h3 class="full" id="tituloForm">Novo usuário</h3>
  <input type="hidden" id="uId" name="id">
  <div><label for="uNome">Nome completo *</label><input id="uNome" name="nome" required></div>
  <div><label for="uEmail">E-mail *</label><input id="uEmail" name="email" type="email" required></div>
  <div><label for="uSenha">Senha (ao editar, vazio mantém a atual)</label><input id="uSenha" name="senha" type="password"></div>
  <div><label for="uSenha2">Confirmar senha</label><input id="uSenha2" name="confirmar_senha" type="password"></div>
    <div class="full"><button type="submit" class="btn">Salvar usuário</button> <button type="reset" class="btn sec">Limpar</button></div>
</form>

<div class="card">
  <div class="filtros"><input id="uBusca" placeholder="Buscar por nome ou e-mail..."></div>
  <div class="tabela">
    <table>
      <thead><tr><th>Nome</th><th class="col-email">E-mail</th><th>Ações</th></tr></thead>
      <!-- BACK-END: um <tr> por usuário (nunca exiba a senha) -->
      <tbody id="corpoUsuarios">
        <tr class="sem-registros"><td colspan="3" class="vazio">Nenhum usuário cadastrado.</td></tr>
      </tbody>
    </table>
  </div>
</div>
</main>

<script src="../js/base.js"></script>
<script src="../js/usuarios.js"></script>
</body>
</html>
