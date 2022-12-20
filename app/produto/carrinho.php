<?php
    //Inicia ou retoma uma sessão
    if(!isset($_SESSION)){
        session_start();
    }

    //recupera o carrinho que está na sessão
    $cart = isset($_SESSION['cart'])? $_SESSION['cart']:NULL;
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Meta tags Obrigatórias -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <title>Encantus | Carrinho</title>
    </head>
    <body>
        <?php
            include "../layout/cabecalho.php";
        ?>
    
        <!-- Título da tabela -->
        <div class="jumbotron bg-transparent" style="height:10px">
            <div class="container">
                <h1 class="font-weight-bold text-center" style="font-family:courier; color:#67AECA">Carrinho de compras</h1>
            </div>
        </div>

        <!-- carrinho vazio ou não -->
        <?php //verificar se o carrinho está vazio
            if($cart == NULL){  // mensagem informando que o carrinho está vazio
        ?>

            <!-- Mensagem de carrinho vazio -->
            <div class="container">
                <div class="alert alert-info text-center" role="alert">
                    <h3  style="font-family:courier; color:#67AECA"> Carrinho de compras vazio </h3>
                </div>
            </div>

        <?php 
        } else { //mostra a tabela com os produtos do carrinho
        ?>
            <!-- Tabela -->
            <div class="container">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th scope="col">Imagem</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Total</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $total_compra = 0; //armazena o valor total da compra
                            foreach ($cart as $product){ 
                                $total = $product['qt'] * $product['price'];
                                $total_compra += $total;
                                $img_path = "img-produtos/".$product['img_path'];    
                                $link = "excluir.php?id=".$product['product_id'];

                        ?>   
                            <tr class="text-center">
                                <th scope="row" ><img class="card-img-top" src="<?= $img_path ?>" alt="<?= $product['product_name'] ?>" style="width:100px; height:100px;"></th>
                                <td><?php echo $product['product_description'];?></td>
                                <td><?php echo $product['qt'];?></td>
                                <td><?php echo "R$ ". number_format($total,"2",",",""); ?></td>
                                <td><a class="btn btn-outline-danger" href=<?= $link;?> role="button">Excluir do carrinho</td>
                            </tr>
                        <?php } #fim foreach?>
                    </tbody> 
                </table> 
            </div>

            <!-- Exibe o total da compra -->
            <div class="container">
                <h3 class="text-secondary"> Total da Compra: R$ <?=number_format($total_compra,2,",","")?></h3>
            </div>

            <!-- Ir para a lista de produtos ou finalizar a compra -->
            <div class="container">
                <!--Botão ir para produtos-->
                <a class="btn btn-outline-primary" href="todos-produtos.php" role="button">Ir para Lista de Produtos</a>
                
                <!--Botão finalizar compra-->
                <?php
                    //Verifica se há algum usuário logado
                    if(isset($_SESSION["logado"]) && $_SESSION["logado"] == true) {
                ?>
                    
                    <a class="btn btn-outline-success" href="finalizar.php" role="button">Finalizar Compra</a>                   
                <?php 
                    } else {
                ?>
                    <a class="btn btn-outline-success" href="../login/login.php" role="button">Faça login para finalizar a compra</a>               
                <?php 
                    } #fim if($_SESSION["logado"] = TRUE;)...else
                ?>
            </div> 
        <?php 
            }//fim if-else
        ?>
        
        <!-- JavaScript (Opcional) -->
        <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>