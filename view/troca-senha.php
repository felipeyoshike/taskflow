<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../img/logo.png" type="image/png">
  <link rel="stylesheet" href="../css/login.css">
  <title>TaskFlow - Trocar senha</title>
</head>
<body>
  <div class="login-pagina">
    <div class="login-card">
      <h1 class="login-logo">TaskFlow</h1>

      <form id="formTrocaSenha" class="login-form" action="" method="post" novalidate>
        <h2>Trocar senha</h2>

        <p id="msgErro" class="msg-erro" role="alert" hidden></p>

        <div>
          <label for="tEmail">E-mail cadastrado</label>
          <input id="tEmail" name="email" type="email" autocomplete="email" required>
        </div>

        <div>
          <label for="tNova">Nova senha</label>
          <div class="campo-senha">
            <input id="tNova" name="nova_senha" type="password" autocomplete="new-password" required>
            <button type="button" class="ver-senha" data-alvo="tNova">Mostrar</button>
          </div>
          <span class="dica">Mínimo de 6 caracteres</span>
        </div>

        <div>
          <label for="tNova2">Confirmar nova senha</label>
          <div class="campo-senha">
            <input id="tNova2" name="confirmar_nova_senha" type="password" autocomplete="new-password" required>
            <button type="button" class="ver-senha" data-alvo="tNova2">Mostrar</button>
          </div>
        </div>

        <button id="btnSalvar" class="btn">Salvar nova senha</button>

        <div class="login-links">
          <a href="login.php" class="link">Voltar para o login</a>
        </div>
      </form>
    </div>
  </div>

  <script src="../js/troca-senha.js"></script>
</body>
</html>