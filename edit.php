<?php 

include("conexao.php");

$datas = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($datas['id'])){
 
  $return = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>
    Erro: Tente mais tarde!</div>"];

  } elseif (empty($datas['nome'])) {

    $return = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>
    Erro: Preencha seu nome!</div>"];

  } elseif (empty($datas['email'])) {

    $return = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>
    Erro: Preencha seu email!</div>"];

  } else {

    $query_user = "UPDATE usuarios SET nome =:nome, email=:email WHERE id=:id";
    
    $edit_user = $conn->prepare($query_user);
    $edit_user->bindParam(':nome', $datas['nome']);
    $edit_user->bindParam(':email', $datas['email']);
    $edit_user->bindParam(':id', $datas['id']);

    if ($edit_user->execute()) {
      $return = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>
      Usuário editado com sucesso!
      </div>
    "];
    } else {
      $return = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>
      Erro: Usuário não editado!"];
    }

} 

echo json_encode($return);