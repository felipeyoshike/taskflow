<?php

session_start();
require_once __DIR__ . "/funcoesProjetos.php";

if (!empty($_POST['inputId']) && !empty($_POST['inputNome']) && !empty($_POST['inputInicio']) && !empty($_POST['inputFim'])){

  $id = $_POST['inputId'];
  $nome = $_POST['inputNome'];
  $descricao = $_POST['inputDescricao'] ?? "";
  $inicio = $_POST['inputInicio'];
  $fim = $_POST['inputFim'];

  atualizarProjeto($nome, $descricao, $inicio, $fim, $id);

  header('Location:../view/projetos.php');
  die();
}

if (!empty($_POST['inputNome']) && !empty($_POST['inputInicio']) && !empty($_POST['inputFim'])){
  $nome = $_POST['inputNome'];
  $descricao = $_POST['inputDescricao'];
  $inicio = $_POST['inputInicio'];
  $fim = $_POST['inputFim'];
  $usuario_id = $_SESSION['usuario_id'];

  inserirProjeto($nome, $descricao, $inicio, $fim, $usuario_id);

  header('Location:../view/projetos.php');
  die();
}

if (!empty($_POST['inputExcluirId'])){
    excluirProjeto($_POST['inputExcluirId']);
  
    header('Location:../view/projetos.php');
    die();
}

?>