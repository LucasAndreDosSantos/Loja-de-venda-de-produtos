<?php
    require_once "../../config.php";
    try{
        //Iniciar uma sessão
        if(!isset($_SESSION))
            session_start();

         //configuração da conexão
         $host_config = DB_DRIVER.":host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME."";
         $dbusername = DB_USER;
         $dbpassword = DB_PASSWORD; 
    
        //Instancia um objeto PDO, conectando no MySQL
        $pdo = new PDO($host_config, $dbusername, $dbpassword);

        //Recuperando os dados do formulário de cadastro
        $id = isset($_POST['inputID']) ? $_POST['inputID'] : null;
        $nome_produto = isset($_POST["inputNome"]) ? $_POST["inputNome"]:null;
        $descricao_produto = isset($_POST["inputDescricao"]) ? $_POST["inputDescricao"]:null;
        $imagem_produto = isset($_FILES['inputImagem']['name']) ?  $_FILES['inputImagem']['name']:null;
        $preco_produto = isset($_POST["inputPreco"]) ? $_POST["inputPreco"]:null;
        $quantidade_produto = isset($_POST["inputQuantidade"]) ? $_POST["inputQuantidade"]:null;
        $categoria_produto = isset($_POST["inputCategoria"]) ? $_POST["inputCategoria"]:null;


        if($imagem_produto == null){
          $imagem_produto = isset($_POST['inputImagemGuardada']) ? $_POST['inputImagemGuardada'] : null;
        }else{
          //Processo de Upload da Imagem
          $_UP['pasta'] = '../imagens/';
          $_UP['tamanho'] = 1024 * 1024 * 2; 
          $_UP['extensoes'] = array('jpg', 'png', 'gif');

          if ($_FILES['inputImagem']['error'] != 0) {
            $_SESSION["error_imagem"] = "Não foi possível fazer o upload da imagem";
            header("Location:formulario-produto.php");
            exit;
          }

          $extensao = strtolower(end(explode('.', $_FILES['inputImagem']['name'])));
          if (array_search($extensao, $_UP['extensoes']) === false) {
            $_SESSION["error_imagem"] = "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
            header("Location:formulario-produto.php");
            exit;
          }
          if ($_UP['tamanho'] < $_FILES['inputImagem']['size']) {
            $_SESSION["error_imagem"] = "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
            header("Location:formulario-produto.php");
            exit;
          }

          $nome_final = $_FILES['inputImagem']['name'];
          
          if (move_uploaded_file($_FILES['inputImagem']['tmp_name'], $_UP['pasta'] . $nome_final)) {
            echo"";
          } else {
            $_SESSION["error_login"] = "Não foi possível enviar o arquivo, tente novamente";
            header("Location:formulario-produto.php");
            exit;
          }
        }

        $bt = isset($_POST['btEnvio']) ? $_POST['btEnvio'] : null;

        if($bt === "Cadastrar"){

            //Comando sql para inserir dados
            $sql = "INSERT INTO `product`(`product_name`, `product_description`, `img_path`, `price`, `product_quantity`, `category_id`) VALUES (:pname, :pdescription, :imgpath, :price, :productquantity, :categoryid)";
            //Pré-processa o sql
            $stmt = $pdo->prepare($sql);
                
            //Montar os dados para inserção
            $data = [
                'pname' =>  $nome_produto,
                'pdescription' =>  $descricao_produto,
                'imgpath' => $imagem_produto,
                'price' => $preco_produto,
                'productquantity' => $quantidade_produto,
                'categoryid' =>  $categoria_produto
            ];

            //Executa o comando
            $stmt->execute($data);

            header("Location:../administrador/todosProdutos.php");

        }else if($bt === "Atualizar"){

             //monta a consulta SQL para a atualização
            $sql = "UPDATE product SET product_name = :pname, product_description = :pdescription, img_path = :imgpath, price = :price, product_quantity = :productquantity, category_id  = :categoryid
                    WHERE product_id = :id";
            
            //Prepara a consulta
            
            $stmt = $pdo->prepare($sql);

            //montar os dados para inserção
            $data = [
                'id' => $id,
                'pname' =>  $nome_produto,
                'pdescription' =>  $descricao_produto,
                'imgpath' => $imagem_produto,
                'price' => $preco_produto,
                'productquantity' => $quantidade_produto,
                'categoryid' =>  $categoria_produto
            ]; 

            //executa o comando, passando os parametros que devem ser atualizados
            $stmt->execute($data);      
            
            header("Location:../administrador/todosProdutos.php");    

        }
        //fecha a conexão
        $pdo = null;

    }catch(PDOException $e){
        print "Erro!: ". $e->getMessage()."<br>\n";
    }
?>