<?php
    try{
        include_once "produtos.php";

        //verifica se não há uma sessão iniciada, se não houver, inicia uma nova sessão
        if(!isset($_SESSION)){
            session_start();
        }


        $host_config = DB_DRIVER.":host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME."";
        $dbusername = DB_USER;
        $dbpassword = DB_PASSWORD; 

        //Instancia um objeto PDO, conectando no MySQL
        $pdo = new PDO($host_config, $dbusername, $dbpassword);


        //se existir o carrinho na sessão    
        if(isset($_SESSION['cart'])){
            $qt_itens_qt_ok = 0;
            
            //percorrer todos os itens do carrinho
            foreach($_SESSION['cart'] as $produto){
                $qt_produtos = count($lista_produtos); //conta a número de produtos cadastrados
                $i = 0;  //perquisar o id no array $lista_produtos

                while($i < $qt_produtos && $lista_produtos[$i]['product_id'] != $produto['product_id']){
                    $i++;
                
                }
                
                if($i < $qt_produtos){            
                    //verificar se a quantidade no carrinho é menor ou igual ao estoque  
                    if($produto['qt'] <= $lista_produtos[$i]['product_quantity']){
                        //atualizar a quantidade o array $lista_produtos
                        $lista_produtos[$i]['product_quantity'] -= $produto['qt'];
                        $qt_itens_qt_ok++;

                            //Comando sql para inserir dados
                            $sql =  "UPDATE product SET  product_quantity = :product_quantity
                            WHERE product_id = :product_id";
                                        
                            //Pré-processa o sql
                            $stmt = $pdo->prepare($sql);
                            
                            //montar os dados para atualização
                            $data = [
                                'product_id' => $lista_produtos[$i]['product_id'],
                                'product_quantity' =>  $lista_produtos[$i]['product_quantity']
                            ];

                            //Executa o comando
                            $stmt->execute($data);
                    }            
                } #fim  if($i < $qt_produtos)
            }#fim foreach
            
            if($qt_itens_qt_ok == count($_SESSION['cart'])){
                //atualizar a variável da sessão
                $_SESSION['lista_produtos'] =  $lista_produtos;
                //limpar o carrinho
                unset($_SESSION['cart']);
                
                //guarda na sessão que a compra deu certo
                $_SESSION['compra_efetuada'] = true;
            }
        } #fim if(isset($_SESSION['carrinho']))

        //redireciona para página mensagem.php
        header("Location:mensagem.php");

        //fecha a conexão
        $pdo = null;
        

    }catch(PDOException $e){
        print "Erro!: ". $e->getMessage()."<br>\n";
    }
?>