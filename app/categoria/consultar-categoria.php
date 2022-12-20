<?php
    require_once "../../config.php";

    try{
        if (!isset($_SESSION))
            session_start();

        //Configuração da conexão
        $host_config = DB_DRIVER.":host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME."";
        $dbusername = DB_USER;
        $dbpassword = DB_PASSWORD; 

        //instancia um objeto PDO, conectando no MySQL
        $pdo = new PDO($host_config, $dbusername, $dbpassword);

        //Montar a consulta SQL para recuperar todos os produtos cadastrados
        $sql = "SELECT * FROM category";

        //Executa o comando sql e retorna para $consulta
        $consulta = $pdo->query($sql);

        //Retorna todos os registros selecionados em forma de array associativo
        $lista_categorias = $consulta->fetchAll(PDO::FETCH_ASSOC);

        //fecha a conexão
        $pdo = null;

    }catch(PDOException $e){
        print "Erro!: ". $e->getMessage()."<br>\n";
    }
?>


