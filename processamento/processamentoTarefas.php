<?php

session_start();
require_once __DIR__ . "/funcoesTarefas.php";

if (!empty($_POST['inputStatusId']) && !empty($_POST['inputNovoStatus'])){
  if ($_POST['inputNovoStatus'] == 'Concluída' || $_POST['inputNovoStatus'] == 'Pendente'){
    alterarStatusTarefa($_POST['inputStatusId'], $_POST['inputNovoStatus']);
  }

  header('Location:../view/minhas-tarefas.php');
  die();
}

if (!empty($_POST['inputId']) && !empty($_POST['inputTitulo']) && !empty($_POST['inputCategoria']) && !empty($_POST['inputVencimento'])){
  atualizarTarefa($_POST['inputId'], $_POST['inputTitulo'], $_POST['inputDescricao'] ?? "", $_POST['inputVencimento'],
                  $_POST['inputPrioridade'], $_POST['inputStatus'], $_POST['inputCategoria'], $_POST['inputProjeto'] ?? "");

  header('Location:../view/minhas-tarefas.php');
  die();
}

if (!empty($_POST['inputTitulo']) && !empty($_POST['inputCategoria']) && !empty($_POST['inputVencimento'])){
  $titulo = $_POST['inputTitulo'];
  $descricao = $_POST['inputDescricao'] ?? "";
  $categoria_id = $_POST['inputCategoria'];
  $projeto_id = $_POST['inputProjeto'] ?? "";
  $vencimento = $_POST['inputVencimento'];
  $prioridade = $_POST['inputPrioridade'];
  $status = $_POST['inputStatus'];
  $usuario_id = $_SESSION['usuario_id'];

  inserirTarefa($titulo, $descricao, $vencimento, $prioridade, $status, $usuario_id, $categoria_id, $projeto_id);

  header('Location:../view/minhas-tarefas.php');
  die();
}

if (!empty($_POST['inputExcluirId'])){
    excluirTarefa($_POST['inputExcluirId']);
  
    header('Location:../view/minhas-tarefas.php');
    die();
}



?>