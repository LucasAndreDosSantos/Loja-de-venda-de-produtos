<?php
require_once 'consultar-categoria.php';
?>

<!doctype html>
<html lang="pt">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Tela Admnistrador</title>
  </head>

  <body>
    
    <?php
      include "../layout/cabecalho.php";
    ?>
    
    <!-- Mensagem inicial -->
    <div class="jumbotron bg-transparent" style="height:10px">
      <div class="container">
        <h1 class="font-weight-bold text-center" style="font-family:courier; color:#67AECA">Cadastro de Categorias</h1>
      </div>
    </div>

    <!-- Form -->
    <div class="row justify-content-center">

      <div class="container col-md-6 ">

        <form action="adicionar-categoria.php" method="POST">

          <!-- Row 1 -->
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="inputDescricao">Nome</label>
              <input type="text" class="form-control" name="inputNome" id="inputNome" placeholder="Nome da categoria" required>
            </div>
          </div>

          <!-- Row 2 -->
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="inputDescricao">Descrição</label>
              <input type="text" class="form-control" name="inputDescricao" id="inputDescricao" placeholder="Descrição da categoria" required>
            </div>
          </div>

          <!-- Row3 -->
          <div class="form-row justify-content-center mt-4">
            <button class="btn btn-outline-primary col-md-12" href="adicionar-categoria.php" type="submit" name="btEnvio">Cadastrar</button>
          </div>

        </form>

      </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>

</html>