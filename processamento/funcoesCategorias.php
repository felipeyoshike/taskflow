<?php

require_once __DIR__ . "/funcoesBD.php";

function inserirCategoria($nome, $descricao, $usuario_id){
    $conexao = conectarBD();
    $consulta = "INSERT INTO categorias (nome, descricao, usuario_id)
                VALUES ('$nome', '$descricao', '$usuario_id')";
    mysqli_query($conexao, $consulta);
}

function atualizarCategoria($nome, $descricao, $id){
    $conexao = conectarBD();
    if ($descricao != "") {
        $consulta = "UPDATE categorias SET nome = '$nome', descricao = '$descricao' WHERE id = $id";
    } else {
        $consulta = "UPDATE categorias SET nome = '$nome', descricao = '' WHERE id = $id";
    }
    mysqli_query($conexao, $consulta);
}

function buscarCategoria($id){
    $conexao = conectarBD();
    $consulta = "SELECT * FROM categorias WHERE id = $id";
    $resultado = mysqli_query($conexao, $consulta);
    return mysqli_fetch_assoc($resultado);
}

function listarCategorias(){
    $conexao = conectarBD();
    $consulta = "SELECT * FROM categorias ORDER BY nome";
    return mysqli_query($conexao, $consulta);
}

function excluirCategoria($id){
    $conexao = conectarBD();
    $consulta = "DELETE FROM categorias WHERE id = $id";
    mysqli_query($conexao, $consulta);
}

function listarCategoriasDoUsuario($usuario_id){
  $conexao = conectarBD();
  $usuario_id = (int) $usuario_id;
  // total_tarefas: quantas tarefas existem em cada categoria (0 quando não tem nenhuma)
  $consulta = "SELECT c.*, COUNT(t.id) AS total_tarefas
               FROM categorias c
               LEFT JOIN tarefas t ON t.categoria_id = c.id
               WHERE c.usuario_id = $usuario_id
               GROUP BY c.id
               ORDER BY c.nome";
  return mysqli_query($conexao, $consulta);
}

?>