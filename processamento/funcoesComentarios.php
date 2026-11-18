<?php

require_once __DIR__ . "/funcoesBD.php";

function listarComentarios($usuario_id){
  $conexao = conectarBD();
  $consulta = "SELECT c.id, c.tarefa_id, c.usuario_id, c.texto, c.criado_em, c.editado_em, u.nome AS usuario_nome
               FROM comentarios c
               INNER JOIN tarefas t ON t.id = c.tarefa_id
               INNER JOIN usuarios u ON u.id = c.usuario_id
               WHERE t.usuario_id = ?
               ORDER BY c.criado_em";
  $stmt = mysqli_prepare($conexao, $consulta);
  mysqli_stmt_bind_param($stmt, "i", $usuario_id);
  mysqli_stmt_execute($stmt);
  return mysqli_stmt_get_result($stmt);
}

function inserirComentario($tarefa_id, $usuario_id, $texto){
  $conexao = conectarBD();
  $consulta = "INSERT INTO comentarios (tarefa_id, usuario_id, texto)
               SELECT t.id, ?, ? FROM tarefas t WHERE t.id = ? AND t.usuario_id = ?";
  $stmt = mysqli_prepare($conexao, $consulta);
  mysqli_stmt_bind_param($stmt, "isii", $usuario_id, $texto, $tarefa_id, $usuario_id);
  mysqli_stmt_execute($stmt);
  return mysqli_stmt_affected_rows($stmt) > 0;
}

function atualizarComentario($id, $usuario_id, $texto){
  $conexao = conectarBD();
  $consulta = "UPDATE comentarios SET texto = ?, editado_em = NOW() WHERE id = ? AND usuario_id = ?";
  $stmt = mysqli_prepare($conexao, $consulta);
  mysqli_stmt_bind_param($stmt, "sii", $texto, $id, $usuario_id);
  mysqli_stmt_execute($stmt);
  return mysqli_stmt_affected_rows($stmt) > 0;
}

function excluirComentario($id, $usuario_id){
  $conexao = conectarBD();
  $consulta = "DELETE FROM comentarios WHERE id = ? AND usuario_id = ?";
  $stmt = mysqli_prepare($conexao, $consulta);
  mysqli_stmt_bind_param($stmt, "ii", $id, $usuario_id);
  mysqli_stmt_execute($stmt);
  return mysqli_stmt_affected_rows($stmt) > 0;
}

?>