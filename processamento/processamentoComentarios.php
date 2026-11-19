<?php

session_start();
require_once __DIR__ . "/funcoesComentarios.php";

if (!isset($_SESSION['usuario_id'])) {
  header('Location:../view/login.php');
  die();
}

$usuario_id = (int) $_SESSION['usuario_id'];
$tarefa_id = (int) ($_POST['inputComentarioTarefaId'] ?? 0);

$voltar = '../view/minhas-tarefas.php' . ($tarefa_id > 0 ? '?comentarios=' . $tarefa_id : '');

if (!empty($_POST['inputExcluirComentarioId'])){
  excluirComentario((int) $_POST['inputExcluirComentarioId'], $usuario_id);

  header('Location:' . $voltar);
  die();
}

$texto = trim($_POST['inputComentarioTexto'] ?? '');

if ($texto != "" && mb_strlen($texto) <= 500){

  if (!empty($_POST['inputComentarioId'])){
    atualizarComentario((int) $_POST['inputComentarioId'], $usuario_id, $texto);

    header('Location:' . $voltar);
    die();
  }

  if ($tarefa_id > 0){
    inserirComentario($tarefa_id, $usuario_id, $texto);
  }
}

header('Location:' . $voltar);
die();

?>