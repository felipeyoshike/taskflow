<?php

function conectarBD(){
  $conexao = mysqli_connect("localhost", "root", "", "taskflow");
  return($conexao);
}

?>