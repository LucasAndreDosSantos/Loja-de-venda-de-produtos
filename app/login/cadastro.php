<?php
if (!isset($_SESSION))
    session_start();

//Verificar se existe um cookie salvo

if (isset($_COOKIE["usermail"])) {
    $_SESSION["logado"] = TRUE;
    //Recupera o nome que está no Cookie e joga para a sessão
    $_SESSION["user"] = $_COOKIE["username"];

    //Redirecionar para home
    header("Location:../produto/todos-produtos.php");
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

    <title>Cadastro</title>
</head>

<body class="text-center">

    <div class="row justify-content-center mt-4">
        <div class="jumbotron col-md-4 bg-light border mt-2">
            <div class="container">
                <img class="mb-1" src="img/user.svg" alt="" width="72" height="72">
                <h5 class="lead"> Cadastro </h5>
                <h5> Preencha os campos abaixo: </h5>

                <form class="form-signin" action="validaCadastro.php" method="POST">
                    <input type="nome" name="inputNome" class="form-control" placeholder="Nome *" required>
                    <input type="email" name="inputEmail" class="form-control mt-2" placeholder="E-mail *" required autofocus>
                    <input type="password" name="inputSenha" class="form-control mt-2" placeholder="Senha *" required>
                    <input type="phone" name="inputTelefone" class="form-control mt-2" placeholder="Telefone *" required>
                    <input type="endereço" name="inputEndereco" class="form-control mt-2" placeholder="Endereço *" required>
                    <input type="cidade" name="inputCidade" class="form-control mt-2" placeholder="Cidade *" required>

                    <button class="btn btn-lg btn-outline-danger btn-block mt-3" type="submit">Cadastrar</button>
                </form>
                <a href="login.php" class="btn mt-3">Já se cadastrou? Faça o login aqui.</a>
            </div>
        </div>
    </div>



    <?php
    //Verificar se a mensagem de erro existe

    if (isset($_SESSION["msg_login"])) {
        echo '<div class = "text-center  text-danger mt-3">';
        echo $_SESSION["msg_login"];
        echo '</div';

        //Exclui a mensagem da sessão

        unset($_SESSION["msg_login"]);
    }
    ?>
</body>

</html>