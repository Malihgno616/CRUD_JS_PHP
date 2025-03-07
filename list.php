<?php 
include_once "conexao.php";

$page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);

if (!empty($page)){

  // Calcular o inicio visualização
  $qtd_reg_page = 10;
  $start = ($page * $qtd_reg_page) - $qtd_reg_page;

  $query_users = "SELECT id, nome, email from usuarios ORDER BY id DESC LIMIT $start, $qtd_reg_page";
  $result_users = $conn->prepare($query_users);
  $result_users->execute();

  $data = "<div class='table-responsive'>
  <table class='table table-dark table-striped'>
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nome</th>
                      <th>E-mail</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>

                ";

  while($row_user = $result_users->fetch(PDO::FETCH_ASSOC)){
    // var_dump($row_user);
    extract($row_user);
    $data .= "<tr>
              <td>$id</td>
              <td>$nome</td>
              <td>$email</td>
              <td>Ações - $page</td>
              </tr>";
  }

  $data .= " </tbody>
            </table>
            </div>";
  
  // Paginação - Somar a quantidade de usuários
  $query_pg = "SELECT COUNT(id) AS num_result FROM usuarios";            
  $result_pg = $conn->prepare($query_pg);
  $result_pg->execute();
  $row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

  //  Quantidade de página
  $qtd_page = ceil($row_pg['num_result'] / $qtd_reg_page);
  
  $max_links = 10;

  $data .= '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">' ;
  
  $data .= "<li class='page-item'><a 
  class='page-link' href=# onclick='listUsers(1)'>Primeira</a></li>";
  
  for($pag_ant = $page - $max_links; $pag_ant <= $page -1; $pag_ant++){
    if($pag_ant >= 1){
        $data .= "<li class='page-item'><a class='page-link' href='#' onclick='listUsers($pag_ant)'>$pag_ant</a></li>";
    }
      
  }

  $data .= "<li class='page-item active'><a class='page-link' href='#'>$page</a></li>";
 
  for($pag_aft = $page + 1; $pag_aft <= $pagina + $max_links; $pag_aft++){
    if($pag_aft <= $qtd_page){
      $data .= "<li class='page-item'><a class='page-link' href='#' onclick='listUsers($pag_aft)'>$pag_aft</a></li>";
    }
  } 
  
  $data .= "<li class='page-item'><a class='page-link' href='#' onclick='listUsers($qtd_page)'>Última</a></li>";
  
  $data .= '</ul></nav>';

  echo "$data";

} else {
  echo "<div class='alert alert-danger' role='alert'>
      Erro: Nenhum usuário encontrado
  </div>
";
}