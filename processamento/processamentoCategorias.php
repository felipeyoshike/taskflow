<?php

session_start();
require_once __DIR__ . "/funcoesCategorias.php";

if(!empty($_POST['inputId']) && !empty($_POST['inputNome'])){
    $id = $_POST['inputId'];
    $nome = $_POST['inputNome'];
    $descricao = $_POST['inputDescricao'] ?? "";

    AtualizarCategoria($nome, $descricao, $id);

    header('Location:../view/categorias.php');
    die();
}

if(!empty($_POST['inputNome'])){
    $usuario_id = $_SESSION['usuario_id'];
    $nome = $_POST['inputNome'];
    $descricao = $_POST['inputDescricao'] ?? "";

    InserirCategoria($nome, $descricao, $usuario_id);

    header('Location:../view/categorias.php');
    die();
}

if (!empty($_POST['inputExcluirId'])){
    excluirCategoria($_POST['inputExcluirId']);
  
    header('Location:../view/categorias.php');
    die();
}
  


?>