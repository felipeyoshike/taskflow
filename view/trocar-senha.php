<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TaskFlow - Trocar senha</title>
  <link rel="icon" href="../img/logo.png" type="image/png">
  <link rel="stylesheet" href="../css/login.css">
</head>
<body>
  <div class="login-pagina">
    <div class="login-card">
      <h1 class="login-logo">TaskFlow</h1>

      <form id="formTrocaSenha" class="login-form" action="../processamento/processamentoUsuarios.php" method="POST" novalidate>
        <h2>Trocar senha</h2>

        <p id="msgErro" class="msg-erro" role="alert" <?php if (!isset($_GET['erro'])) echo 'hidden'; ?>>
          E-mail não encontrado.
        </p>

        <div>
          <label for="tEmail">E-mail cadastrado</label>
          <input id="tEmail" name="inputConfirmarEmail" type="email" autocomplete="email" required>
        </div>

        <div>
          <label for="tNova">Nova senha</label>
          <div class="campo-senha">
            <input id="tNova" name="inputNovaSenha" type="password" autocomplete="new-password" required>
            <button type="button" class="ver-senha" data-alvo="tNova">Mostrar</button>
          </div>
          <span class="dica">Mínimo de 6 caracteres</span>
        </div>

        <button id="btnSalvar" class="btn">Salvar nova senha</button>

        <div class="login-links">
          <a href="login.php" class="link">Voltar para o login</a>
        </div>
      </form>
    </div>
  </div>

  <script src="../js/trocar-senha.js"></script>
</body>
</html>