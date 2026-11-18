<?php

session_start();
require_once __DIR__ . "/funcoesUsuarios.php";

if (!empty($_POST['inputEmailLogin']) && !empty($_POST['inputSenhaLogin'])){
  $usuario = validarLogin($_POST['inputEmailLogin'], $_POST['inputSenhaLogin']);

  if ($usuario) {
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nome'] = $usuario['nome'];
    header('Location:../view/dashboard.php');
  } else {
    header('Location:../view/login.php?erro=1');
  }
  die();
}

if (!empty($_POST['inputExcluirId'])){
  excluirUsuario($_POST['inputExcluirId']);

  if ((int) $_POST['inputExcluirId'] === (int) $_SESSION['usuario_id'] && !buscarUsuario((int) $_POST['inputExcluirId'])) {
    session_destroy();
    header('Location:../view/login.php');
    die();
  }

  header('Location:../view/usuarios.php');
  die();
}

if (!empty($_POST['inputId']) && !empty($_POST['inputNome']) && !empty($_POST['inputEmail'])){
  $senha = $_POST['inputSenha'] ?? "";

  atualizarUsuario($_POST['inputId'], $_POST['inputNome'], $_POST['inputEmail'], $senha);

  header('Location:../view/usuarios.php');
  die();
}

if (!empty($_POST['inputNovaSenha']) && !empty($_POST['inputConfirmarEmail'])){
  $alterou = atualizarSenha($_POST['inputConfirmarEmail'], $_POST['inputNovaSenha']);

  if ($alterou > 0) {
    header('Location:../view/login.php');
  } else {
    header('Location:../view/trocar-senha.php?erro=1');
  }
  die();
}

if (!empty($_POST['inputNome']) && !empty($_POST['inputEmail']) && !empty($_POST['inputSenha'])){
  $nome = $_POST['inputNome'];
  $email = $_POST['inputEmail'];
  $senha = $_POST['inputSenha'];

  inserirUsuario($nome, $email, $senha);

  if (isset($_POST['origem']) && $_POST['origem'] == 'usuarios') {
    header('Location:../view/usuarios.php');
  } else {
    header('Location:../view/login.php');
  }

  die();
}

?>