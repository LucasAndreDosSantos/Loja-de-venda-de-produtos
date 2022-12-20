<?php
    require_once "../../config.php";
    echo "AB";
    try{
         //configuração da conexão
         $host_config = DB_DRIVER.":host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME."";
         $dbusername = DB_USER;
         $dbpassword = DB_PASSWORD; 

        //instancia um objeto PDO, conectando no MySQL
        $pdo = new PDO($host_config, $dbusername, $dbpassword);

        //Receber o id que será excluído
        $id = isset($_GET['id']) ? $_GET['id'] : null;
            
        if($id != null){
            //comandos sql para deletar 
            $sql = "DELETE FROM product WHERE product_id = :id";
            $stmt = $pdo->prepare($sql);

            
            //executa o comando
            $stmt->execute(['id' => $id]);

            header("Location:../administrador/todosProdutos.php");

        }else{
            echo "Dados inválidos";
        }

        //fecha a conexão
        $pdo = null;

    }catch(PDOException $e){
        print "Erro!: ". $e->getMessage()."<br>\n";
    }
?>


