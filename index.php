<?php 

include_once "conexao.php";

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <title>CRUD - PHP FETCH</title>
</head>
<body>
    <div class="container">
      <div class="row mt-4">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
          <div>
            <h4>Listar Usuários</h4>
          </div>
          <div>
            <button 
              type="button" 
              class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#cadUsuarioModal">
              Cadastrar
            </button>
          </div>
        </div>
      </div>
      <hr>
      <span id="msgAlert"></span>
      <div class="row">
        <div class="col-lg-12">             
          <span class="listar-usuarios">

          </span>       
        </div>
      </div>
    </div>

    <div class="modal fade" 
         id="cadUsuarioModal" 
         tabindex="-1" 
         aria-labelledby="cadUsuarioModalLabel" 
         aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="cadUsuarioModalLabel">Cadastrar Usuário</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
            <div class="modal-body">
                <form id="cad-usuario-form">
                  <span id="msgAlertError"></span>
                  <div class="mb-3">
                    <label for="nome" class="col-form-label">Nome:</label>
                    <input type="text" name="nome" placeholder="Digite o nome completo" class="form-control" id="nome" >
                  </div>
                  <div class="mb-3">
                    <label for="email" class="col-form-label">Email:</label>
                    <input type="text" name="email" placeholder="Digite o seu melhor email" class="form-control" id="email" >
                  </div>
                  <div class="modal-footer">
                    <button 
                    type="button" 
                    class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"
                    >Fechar</button>
                    <input 
                    type="submit"
                    id="cad-usuario-btn"
                    class="btn btn-outline-success btn-sm" value="Cadastrar"/>
                  </div>
                </form>
            </div> 
          </div>
        </div>
    </div>

  <script src="js/custom.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  
</body>
</html>