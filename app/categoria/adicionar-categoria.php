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
        $nome_produto = isset($_POST["inputNome"]) ? $_POST["inputNome"]:null;
        $descricao_produto = isset($_POST["inputDescricao"]) ? $_POST["inputDescricao"]:null;

        //Comando sql para inserir dados
        $sql = "INSERT INTO `category`(`category_name`, `category_description`) VALUES (:categoryname, :categorydescription)";
        //Pré-processa o sql
        $stmt = $pdo->prepare($sql);
                
        //Montar os dados para inserção
        $data = [
            'categoryname' =>  $nome_produto,
            'categorydescription' =>  $descricao_produto,
        ];

        //Executa o comando
        $stmt->execute($data);

        header("Location:../produtos/formulario-produto.php");

        //fecha a conexão
        $pdo = null;

    }catch(PDOException $e){
        print "Erro!: ". $e->getMessage()."<br>\n";
    }
?>
