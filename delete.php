<?php 
include_once "conexao.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)){

  $query_user = "DELETE FROM usuarios WHERE id=:id";
  $result_user = $conn->prepare($query_user);
  $result_user->bindParam(':id', $id);
  $result_user->execute();

  if ($result_user->execute()){
    $return = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>
    Erro: Usuário apagado com sucesso!"];
  } else {
    $return = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>
    Erro: Usuário não encontrado!"];
  }
} else {
  $return = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>
  Erro: Usuário não encontrado!"];
}

echo json_encode($return);