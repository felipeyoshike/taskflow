<?php

require_once __DIR__ . "/funcoesBD.php";

function inserirTarefa($titulo, $descricao, $vencimento, $prioridade, $status, $usuario_id, $categoria_id, $projeto_id){
  $conexao = conectarBD();
  $projeto = ($projeto_id != "") ? (int) $projeto_id : "NULL";   
  $consulta = "INSERT INTO tarefas (titulo, descricao, vencimento, prioridade, status, usuario_id, categoria_id, projeto_id)
              VALUES ('$titulo', '$descricao', '$vencimento', '$prioridade', '$status', $usuario_id, $categoria_id, $projeto)";
  mysqli_query($conexao, $consulta);
}

function listarTarefas($usuario_id){
  $conexao = conectarBD();
  $consulta = "SELECT t.*, c.nome AS categoria_nome, p.nome AS projeto_nome
               FROM tarefas t
               INNER JOIN categorias c ON c.id = t.categoria_id
               LEFT JOIN projetos p ON p.id = t.projeto_id
               WHERE t.usuario_id = $usuario_id
               ORDER BY t.vencimento";
  return mysqli_query($conexao, $consulta);
}

function buscarTarefa($id){
  $conexao = conectarBD();
  $consulta = "SELECT * FROM tarefas WHERE id = $id";
  $resultado = mysqli_query($conexao, $consulta);
  return mysqli_fetch_assoc($resultado);
}

function excluirTarefa($id){
  $conexao = conectarBD();
  $consulta = "DELETE FROM tarefas WHERE id = $id";
  mysqli_query($conexao, $consulta);
}

function atualizarTarefa($id, $titulo, $descricao, $vencimento, $prioridade, $status, $categoria_id, $projeto_id){
  $conexao = conectarBD();
  $projeto = ($projeto_id != "") ? (int) $projeto_id : "NULL";
  $consulta = "UPDATE tarefas SET titulo = '$titulo', descricao = '$descricao', vencimento = '$vencimento',
                                  prioridade = '$prioridade', status = '$status',
                                  categoria_id = $categoria_id, projeto_id = $projeto
               WHERE id = $id";
  mysqli_query($conexao, $consulta);
}

?>