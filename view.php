<?php 
include_once "conexao.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)){

  $query_user = "SELECT id, nome, email FROM usuarios WHERE id = :id LIMIT 1";
  $result_user = $conn->prepare($query_user);
  $result_user->bindParam(':id', $id);
  $result_user->execute();

  $row_user = $result_user->fetch(PDO::FETCH_ASSOC);  

  $return = ['erro' => false, 'datas' => $row_user];
 
} else {
  $return = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>
  Erro: Usuário não encontrado!"];
}

echo json_encode($return);