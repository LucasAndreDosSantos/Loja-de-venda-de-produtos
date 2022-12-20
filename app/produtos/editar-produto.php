<?php
    require_once "../../config.php";
    if(!isset($_SESSION))
        session_start();
    
    try{
         //configuração da conexão
         $host_config = DB_DRIVER.":host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME."";
         $dbusername = DB_USER;
         $dbpassword = DB_PASSWORD; 

        //instancia um objeto PDO, conectando no MySQL
        $pdo = new PDO($host_config, $dbusername, $dbpassword);


        /** 
         Arrumar o upload das imagens
        **/

        //Receber o id que será atualizado
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if($id != null){

            //comandos sql para buscar um regisstro de id específic
            $sql = "SELECT * FROM product WHERE product_id = :id";
            $stmt = $pdo->prepare($sql);
            
            //executa o comando
           $registro =  $stmt->execute(['id' => $id]);

            //retornar um registro em forma de array associativo
            $produto = $stmt->fetch(PDO::FETCH_ASSOC);

            //envia os dados do produto para sessão
            if($stmt->rowCount() > 0){
                $_SESSION['produto'] = $produto;
            }
            echo "<pre>";
            print_r($produto);
            echo "</pre>";

            header("Location:formulario-produto.php");

        }else{
            echo "Dados inválidos";
        }

        //fecha a conexão
        $pdo = null;

    }catch(PDOException $e){
        print "Erro!: ". $e->getMessage()."<br>\n";
    }
?>


