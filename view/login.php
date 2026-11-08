<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TaskFlow - Login</title>
  <link rel="icon" href="../img/logo.png" type="image/png">
  <link rel="stylesheet" href="../css/login.css">
</head>
<body>
  <div class="login-pagina">
    <div class="login-card">
      <h1 class="login-logo">TaskFlow</h1>

      <form id="formLogin" class="login-form" action="" method="post" novalidate>
        <h2>Entrar</h2>

        <p id="msgErro" class="msg-erro" role="alert" hidden></p>

        <div>
          <label for="lEmail">E-mail</label>
          <input id="lEmail" name="email" type="email" autocomplete="email" required>
        </div>

        <div>
          <label for="lSenha">Senha</label>
          <div class="campo-senha">
            <input id="lSenha" name="senha" type="password" autocomplete="current-password" required>
            <button type="button" id="btnVerSenha" class="ver-senha">Mostrar</button>
          </div>
        </div>

        <button id="btnEntrar" class="btn">Entrar</button>

        <div class="login-links">
          <a href="cadastro.php" class="link">Criar uma conta</a>
          <a href="troca-senha.php" id="linkSenha" class="link">Esqueci a senha</a>
        </div>
      </form>
    </div>
  </div>

  <script src="../js/login.js"></script>
</body>
</html>