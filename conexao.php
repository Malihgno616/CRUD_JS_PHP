<?php 

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "fetch_php";

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
  // echo "Conexão realizada com sucesso!!";

} catch(PDOException $err) {
  echo "Error: " . $err->getMessage();
}