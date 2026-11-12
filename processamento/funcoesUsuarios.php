<?php

require_once __DIR__ . "/funcoesBD.php";

function validarLogin($email, $senha){
  $conexao = conectarBD();
  $consulta = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
  $resultado = mysqli_query($conexao, $consulta);
  return mysqli_fetch_assoc($resultado);
}

function inserirUsuario($nome, $email, $senha){
  $conexao = conectarBD();
  $consulta = "INSERT INTO usuarios (nome, email, senha)
              VALUES ('$nome', '$email', '$senha')";
  mysqli_query($conexao, $consulta);
}

function retornarUsuarios(){
  $conexao = conectarBD();
  $consulta = "SELECT * FROM usuarios";
  $listarClientes = mysqli_query($conexao, $consulta);
  return $listarClientes;
}

function buscarUsuario($id){
  $conexao = conectarBD();
  $consulta = "SELECT * FROM usuarios WHERE id = $id";
  $resultado = mysqli_query($conexao, $consulta);
  return mysqli_fetch_assoc($resultado);
}

function atualizarUsuario($id, $nome, $email, $senha){
  $conexao = conectarBD();
  if ($senha != "") {
    $consulta = "UPDATE usuarios SET nome = '$nome', email = '$email', senha = '$senha' WHERE id = $id";
  } else {
    $consulta = "UPDATE usuarios SET nome = '$nome', email = '$email' WHERE id = $id";
  }
  mysqli_query($conexao, $consulta);
}

function atualizarSenha($email, $senha){
  $conexao = conectarBD();
  $consulta = "UPDATE usuarios SET senha = '$senha' WHERE email = '$email'";
  mysqli_query($conexao, $consulta);
  return mysqli_affected_rows($conexao);
}

function excluirUsuario($id){
  $conexao = conectarBD();
  $consulta = "DELETE FROM usuarios WHERE id = $id";
  mysqli_query($conexao, $consulta);
}

?>