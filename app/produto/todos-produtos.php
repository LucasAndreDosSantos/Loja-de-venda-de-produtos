<?php
    include "produtos.php";

    //Inicia ou retoma uma sessão
    if(!isset($_SESSION)){
        session_start();
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Meta tags Obrigatórias -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>Lojinha</title>
    </head>

    <body>
        
        <?php
            include "../layout/cabecalho.php";
        ?>

        <!-- Mensagem inicial -->
        <div class="container text-center my-4">
            <h1 class="font-weight-bold" style="font-family:courier; color:#67AECA">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#67AECA" class="bi bi-moon-stars" viewBox="0 0 16 16">
                        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278zM4.858 1.311A7.269 7.269 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.316 7.316 0 0 0 5.205-2.162c-.337.042-.68.063-1.029.063-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286z"/>
                    <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
                </svg>
                Encantus
            <h1>
            <h3 style="font-family:courier; color:#675682">O seu mundo com mais fantasia<h3>
        </div> <!-- Fim da mensagem inicial -->

        <!-- Produtos -->
        <div class="container">
        <div class="form-group row">
            <div class="row row-cols-1 row-cols-md-5 g-4">
            <?php 
                //$all_products foi declarado em data.php - simulando banco de dados
                foreach($lista_produtos as $product) {
                    //monta o caminho da imagem                    
                    $img_path = IMG. $product['img_path'];
                    $link = "adiciona.php?id=".$product['product_id'];
            ?>
                <div class="col-5">
                    <div class="card h-100">
                        <center><img class="card-img-top" src="<?= $img_path ?>" alt="<?= $product['product_name'] ?>" style="width:250px; height:250px; margin-top:5px"></center>
                        <div class="card-body">
                            <h6 class="card-title  text-dark">
                                <?= $product['product_name'] ?>
                            </h6>
                            <p class="card-text "><small class="text-muted"><?= $product['product_description'] ?></small></p>
                            <h5 class="card-text text-end text-info">R$<?= number_format($product['price'],2,',','') ?></h5>
                            
                        </div>

                        <div class="card-footer border-light">
                            <form action="adiciona.php" method="get" name="form_cart" id="form_cart">
                                <div class="row">
                                    <input type="hidden" name="id" value="<?= $product['product_id'] ?>" >
                                    <div class="col">
                                        <input class="form-control" type="number submit" name="input_quantity" min="1" value="1">
                                    </div>
                                    <div class="col">
                                    <input type="submit" class="btn btn-outline-danger" value="Adicionar" href=<?=$link;?>>
                                    </div>    
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                
            <?php } //fim foreach
            ?>

        </div><!-- /.row -->
    </div><!-- /.container -->      

        <!-- JavaScript (Opcional) -->
            <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>