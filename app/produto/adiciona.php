<?php
    include_once "produtos.php"; // Inclui apenas uma vez
    
    //Inicia ou retoma uma sessão
    if(!isset($_SESSION)){
        session_start();
    }

    //recupera o carrinho que está na sessão ou cria um novo array
    $cart = isset($_SESSION['cart'])? $_SESSION['cart']:array();
    
    //Pega o id
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        //Verifica se o produto já existe no carrinho
        $exist_produto = false;

        foreach($cart as $i => $produto){
            if($produto['product_id'] == $id){
                $exist_produto = true;
                
                if($cart[$i]['qt'] < $lista_produtos[$id]['product_quantity'] && $lista_produtos[$id]['product_quantity'] > $_GET['input_quantity']){
                    //Atualiza a quantidade de elementos no carrinho
                    $cart[$i]['qt']+=$_GET['input_quantity'];
                }
                
                
            }

        } #fim ($cart as $i => $produto)

        if(!$exist_produto){
            //Adiciona o item ao carrinho
            $qt_produtos = count($lista_produtos);
            
            //Procura o id
            $i = 0;

            while($i < $qt_produtos && $lista_produtos[$i]['product_id'] != $id){
                $i++;
            }
            
            if($lista_produtos[$id]['product_quantity'] < $_GET['input_quantity']){
                if($i < $qt_produtos){
                    $produto = $lista_produtos[$i];
                    $produto['qt'] = $_GET['input_quantity'];
                    $cart[] = $produto;
                    
                }

            } 
        } #fim if(!exist_produto)

    } #fim if(isset($_GET['id']))

    $_SESSION['cart'] = $cart;
    
    //Redireciona para página de produtos
    header("Location:carrinho.php");
?>