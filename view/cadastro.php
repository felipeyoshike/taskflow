<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../img/logo.png" type="image/png">
  <link rel="stylesheet" href="../css/login.css">
  <title>TaskFlow - Cadastro</title>
</head>
<body>
  <div class="login-pagina">
    <div class="login-card">
      <h1 class="login-logo">TaskFlow</h1>

      <form id="formCadastro" class="login-form" action="" method="post" novalidate>
        <h2>Criar conta</h2>

        <p id="msgErro" class="msg-erro" role="alert" hidden></p>

        <div>
          <label for="cNome">Nome completo</label>
          <input id="cNome" name="nome" type="text" autocomplete="name" required>
        </div>

        <div>
          <label for="cEmail">E-mail</label>
          <input id="cEmail" name="email" type="email" autocomplete="email" required>
        </div>

        <div>
          <label for="cSenha">Senha</label>
          <div class="campo-senha">
            <input id="cSenha" name="senha" type="password" autocomplete="new-password" required>
            <button type="button" class="ver-senha" data-alvo="cSenha">Mostrar</button>
          </div>
          <span class="dica">Mínimo de 6 caracteres</span>
        </div>

        <div>
          <label for="cSenha2">Confirmar senha</label>
          <div class="campo-senha">
            <input id="cSenha2" name="confirmar_senha" type="password" autocomplete="new-password" required>
            <button type="button" class="ver-senha" data-alvo="cSenha2">Mostrar</button>
          </div>
        </div>

        <button id="btnCadastrar" class="btn">Cadastrar</button>

        <div class="login-links">
          <a href="login.php" class="link">Já tenho uma conta</a>
        </div>
      </form>
    </div>
  </div>

  <script src="../js/cadastro.js"></script>
</body>
</html>