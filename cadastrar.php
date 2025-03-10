<?php 

include("conexao.php");

$datas = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($datas['nome'])){
 
  $return = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>
    Erro: Preencha seu nome!</div>"];

  } elseif (empty($datas['email'])) {

    $return = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>
    Erro: Preencha seu email!</div>"];

  } else {

    $query_user = "INSERT INTO usuarios (nome,email) VALUES (:nome, :email)";
    $cad_user = $conn->prepare($query_user);
    $cad_user->bindParam(':nome', $datas['nome']);
    $cad_user->bindParam(':email', $datas['email']);

    $cad_user->execute();
    if ($cad_user->rowCount()) {
      $return = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>
      Usuário cadastrado com sucesso!
      </div>
    "];
    } else {
      $return = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>
      Erro: Usuário não cadastrado!"];
    }
} 


echo json_encode($return);