<?php

require_once __DIR__ . "/funcoesBD.php";

function inserirProjeto($nome, $descricao, $inicio, $fim, $usuario_id){
  $conexao = conectarBD();
  $consulta = "INSERT INTO projetos (nome, descricao, inicio, fim, usuario_id)
              VALUES ('$nome', '$descricao', '$inicio', '$fim', '$usuario_id')";
  mysqli_query($conexao, $consulta);
}

function atualizarProjeto($nome, $descricao, $inicio, $fim, $id){
  $conexao = conectarBD();
  $consulta = "UPDATE projetos SET nome = '$nome', descricao = '$descricao', inicio = '$inicio', fim = '$fim' WHERE id = $id";
  mysqli_query($conexao, $consulta);
}

function excluirProjeto($id){
  $conexao = conectarBD();
  $consulta = "DELETE FROM projetos WHERE id = $id";
  mysqli_query($conexao, $consulta);
}

function listarProjetos($usuario_id){
  $conexao = conectarBD();
  $usuario_id = (int) $usuario_id;
  $consulta = "SELECT p.*,
                      COUNT(t.id) AS total_tarefas,
                      COALESCE(SUM(t.status = 'Concluída'), 0) AS concluidas
               FROM projetos p
               LEFT JOIN tarefas t ON t.projeto_id = p.id
               WHERE p.usuario_id = $usuario_id
               GROUP BY p.id
               ORDER BY p.nome";
  return mysqli_query($conexao, $consulta);
}

function buscarProjeto($id){
  $conexao = conectarBD();
  $consulta = "SELECT * FROM projetos WHERE id = $id";
  $resultado = mysqli_query($conexao, $consulta);
  return mysqli_fetch_assoc($resultado);
}

?>