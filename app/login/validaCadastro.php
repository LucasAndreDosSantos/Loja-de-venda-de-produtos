<?php
    try{
        require_once "../../config.php";
        //Iniciar uma sessão
        if(!isset($_SESSION))
            session_start();

        //Configuração da conexão
        $host_config = DB_DRIVER.":host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME."";
        $dbusername = DB_USER;
        $dbpassword = DB_PASSWORD; 
    
        //Instancia um objeto PDO, conectando no MySQL
        $pdo = new PDO($host_config, $dbusername, $dbpassword);

        //Recuperando os dados do formulário de cadastro
        $nome_cadastrado = isset($_POST["inputNome"]) ? $_POST["inputNome"]:null;
        $email_cadastrado = isset($_POST["inputEmail"]) ? $_POST["inputEmail"]:null;
        $senha_cadastrada = isset($_POST["inputSenha"]) ? $_POST["inputSenha"]:null;
        $telefone_cadastrado = isset($_POST["inputTelefone"]) ? $_POST["inputTelefone"]:null;
        $endereco_cadastrado = isset($_POST["inputEndereco"]) ? $_POST["inputEndereco"]:null;
        $cidade_cadastrada = isset($_POST["inputCidade"]) ? $_POST["inputCidade"]:null;
        $tipo = 1; 

        $sql ="SELECT email FROM user WHERE email LIKE '$email_cadastrado'";

        //Pré-processa o sql
        $stmt = $pdo->prepare($sql);
            
        //Executa o comando
        $stmt->execute(['email'=> $email_digitado,'password'=> $senha_digitada]);
                    
        //retornar um registro em forma de array associativo
        $stmt->fetch(PDO::FETCH_ASSOC);

        if($stmt->rowCount()<1){

            if($nome_cadastrado != null && $email_cadastrado != null && $senha_cadastrada != null && $telefone_cadastrado != null && $endereco_cadastrado != null && $cidade_cadastrada != null){
                //Comando sql para inserir dados
                $sql = "INSERT INTO user (user_name, email, password, phone, adress, city, type) VALUES (:user_name, :email, :password, :phone, :adress, :city, :type)";
                            
                //Pré-processa o sql
                $stmt = $pdo->prepare($sql);
                
                //Montar os dados para inserção
                $data = [
                    'user_name' => $nome_cadastrado,
                    'email' => $email_cadastrado,
                    'password' => $senha_cadastrada,
                    'phone' => $telefone_cadastrado,
                    'adress' => $endereco_cadastrado,
                    'city' => $cidade_cadastrada,
                    'type' => $tipo
                ];
                
                //Executa o comando
                $stmt->execute($data);

                header("Location:../produto/todos-produtos.php");

                $_SESSION["user"] = $nome_cadastrado;
                $_SESSION["logado"] = TRUE;

            }else{
                echo "Dados não foram inseridos";
            }
        }else{
            $_SESSION["msg_login"] = "E-mail digitado já está cadastrado no sistema";
            header("Location:cadastro.php"); //Redirecionando para a página de login;
        }

        //fecha a conexão
        $pdo = null;

    }catch(PDOException $e){
        print "Erro!: ". $e->getMessage()."<br>\n";
    }
?>
