<?php
    //inicia a sessão
     if(!isset($_SESSION))
         session_start();

    //verifica se a compra deu certo para montar a mensagem a ser mostrada
    if(isset($_SESSION['compra_efetuada'])){
        $msg = "A magia está no ar!sua Compra foi realizada com sucesso!";
        $config ="primary";
        $link = "todos-produtos.php";
        $texto_link = "Ir para lista de produtos.";

        unset($_SESSION['compra_efetuada']);
    }
    else{
        //compra não foi efetuada
        $msg = "Oh não, houve um desequilibrio na magia e sua compra não foi efetivada! Verifique o carrinho.";
        $config = "danger";
        $link = "carrinho.php";
        $texto_link = "Ir para carrinho de compra.";
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

        <title>Finalizar</title>
    </head>

    <body>
        <?php
            include "../layout/cabecalho.php";
        ?>
        
        <div class="container">
            <div class="container"> 
                <h1 class="display-6 text-center font-weight-bold" style="font-family:courier; color:#67AECA">Confirmação</h1>
            </div>
            <div class="alert alert-<?=$config?> text-center" role="alert">
                <h3 style="font-family:courier;"> <?= $msg ?> </h3>
                <hr>
                <a href=<?= $link ?> class="alert-link font-weight-bold" style="font-family:courier;"> <?= $texto_link ?></a>
            </div>
        </div>
    
        <!-- JavaScript (Opcional) -->
        <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>