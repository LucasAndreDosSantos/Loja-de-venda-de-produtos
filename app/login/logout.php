<?php
    if(!isset($_SESSION)){
        session_start();
    }

    //verifica se existe o carrinho na sessão    
    if(isset($_SESSION['cart'])){
        //limpa o carrinho
        unset($_SESSION['cart']);
    }

    unset($_SESSION["user"]);
    unset($_SESSION["logado"]);

    session_unset();
    session_destroy();

    setcookie("usermail", "", time() -1);
                
    setcookie("username", "", time() -1);

    header("Location:login.php");
?>