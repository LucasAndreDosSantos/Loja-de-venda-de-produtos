<?php

  require_once '../categoria/consultar-categoria.php';

  if (!isset($_SESSION))
    session_start();

  //recupera os dados do produto a ser editado
  $produto = isset($_SESSION['produto']) ? $_SESSION['produto'] : null;

  //exclui o produto da sessão
  unset($_SESSION['produto']);

  if ($produto != null) {
    ///configuração para editar
    $id_editar = $produto['product_id'];
    $name_editar = $produto['product_name'];
    $descricao_editar = $produto['product_description'];
    $imagem_editar = $produto['img_path'];
    $preco_editar = $produto['price'];
    $quantidade_editar = $produto['product_quantity'];
    $categoria_editar = $produto['category_id'];

    //configuração do botão 
    $texto_bt = "Atualizar";
    $cor_bt = "info";
  } else {
    //configuração para cadastrar
    $id_editar = null;
    $name_editar = null;
    $descricao_editar = null;
    $imagem_editar = null;
    $preco_editar = null;
    $quantidade_editar = null;
    $categoria_editar = null;

    //configuração do botão 
    $texto_bt = "Cadastrar";
    $cor_bt = "primary";
  }

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
        <h1 class="font-weight-bold text-center" style="font-family:courier; color:#67AECA">Cadastro de Produtos</h1>
      </div>
    </div>

    <!-- Form -->
    <div class="row justify-content-center">

      <div class="container col-md-6 ">

        <form action="adicionar-produto.php" method="POST" enctype="multipart/form-data">

          <!-- Input escondido para armazenar e enviar o id a ser atualizado -->
          <input type="hidden" name="inputID" value="<?= $id_editar ?>">
          <!-- Row 1 -->
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="inputDescricao">Nomes</label>
              <input type="text" class="form-control" name="inputNome" value="<?= $name_editar ?>" id="inputNome" placeholder="Nome do produto" required>
            </div>
          </div>
          <!-- Row 2 -->
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="inputDescricao">Descrição</label>
              <input type="text" class="form-control" name="inputDescricao" value="<?= $descricao_editar ?>" id="inputDescricao" placeholder="Descrição do produto" required>
            </div>
          </div>

          <!-- Row 3 -->
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="inputCategoria">Categoria</label>
              <select class="form-control" name="inputCategoria" id="inputCategoria" required onchange="if (this.value.localeCompare('../categoria/formulario-categoria.php') == 0 ){location = this.value};">
                <?php
                foreach ($lista_categorias as $category) { 
                  if($categoria_editar == $category['category_id']){
                    $selecionado = true;
                  }?>
                  <option <?php if($selecionado == true){?>selected<?php } ?> value = <?= $category['category_id'] ?>><?= $category['category_name'] ?></option>
                <?php } ?>
                <option value="../categoria/formulario-categoria.php"> Adicionar categoria ...</option>
              </select>
            </div>
          </div>
          
          <!-- Input escondido para armazenar e enviar a imagem que não foi atualizada -->
          <input type="hidden" name="inputImagemGuardada" value="<?= $imagem_editar ?>">

          <!-- Row 4 -->
          <div class="form-row">

            <div class="col-md-3 mr-4">
              <div class="form-group">
                <label for="inputPreco">Preço</label>
                <input type="number" class="form-control" name="inputPreco" value="<?= $preco_editar ?>" id="inputPreco" placeholder="1,00" step="0.01" min="0" required>
              </div>
            </div>

            <!-- Row 5 -->
            <div class="form-group col-md-3">
              <label for="inputQuantidade">Quantidade</label>
              <input type="number" class="form-control" name="inputQuantidade" value="<?= $quantidade_editar ?>" id="inputQuantidade" min="1" placeholder="1" required>
            </div>

          </div>


          <!-- Row 6 -->
          <div class="form-row justify-content-center">
            <div class="form-group col-md-12">
              <label for="inputImagem">Imagem do produto</label>
              <?php if($imagem_editar == null){
                $required = "required";
              }else{
                $required = "";
                ?><style>input[type='file'] {color: transparent;}</style>
              <?php } ?>

              <input type="file" class="form-control-file" name="inputImagem" value="<?= $imagem_editar ?>" id="inputImagem" placeholder="Imagem do produto" accept="image/*" <?= $required ?>>
            </div>
          </div>



          <!-- Row7 -->
          <div class="form-row justify-content-center mt-4">

            <button class="btn btn-outline-<?= $cor_bt ?> col-md-10" value="<?= $texto_bt ?>" href="adicionar-produto.php" type="submit" name="btEnvio"><?= $texto_bt ?></button>
          </div>

        </form>

      </div>

    </div>

    <?php
    //Verificar se a mensagem de erro existe

    if (isset($_SESSION["error_imagem"])) {
      echo '<div class = "text-center  text-danger mt-3 h2" >';
      echo $_SESSION["error_imagem"];
      echo '</div';

      //Exclui a mensagem da sessão

      unset($_SESSION["error_imagem"]);
    }
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>

</html>