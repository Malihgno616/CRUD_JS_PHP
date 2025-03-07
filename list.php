<?php 
include_once "conexao.php";

$query_users = "SELECT id, nome, email from usuarios LIMIT 10";
$result_users = $conn->prepare($query_users);
$result_users->execute();

while($row_user = $result_users->fetch(PDO::FETCH_ASSOC)){
  // var_dump($row_user);
  extract($row_user);
  $data .= "<table><tr>
            <td>$id</td>
            <td>$nome</td>
            <td>$email</td>
            <td>Ações</td>
            </tr></table>";
}

echo "$data";