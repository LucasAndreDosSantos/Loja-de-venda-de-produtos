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
       
        $email_digitado = isset($_POST["inputEmail"]) ? $_POST["inputEmail"]:null;
        $senha_digitada = isset($_POST["inputSenha"]) ? $_POST["inputSenha"]:null;
    


        if($email_digitado != null && $senha_digitada != null ){
            //Comando sql para buscar dados correspondentes ao email e senha digitados
            $sql ="SELECT * FROM user WHERE email LIKE '$email_digitado' AND password LIKE '$senha_digitada'";
                        
            //Pré-processa o sql
            $stmt = $pdo->prepare($sql);
            
            //Executa o comando
            $registro = $stmt->execute(['email'=> $email_digitado,'password'=> $senha_digitada]);
            
            //retornar um registro em forma de array associativo
            $user = $stmt ->fetch(PDO::FETCH_ASSOC);

            //verifica se há registros 
            if($stmt->rowCount()>0){
                echo "Usuário presente no sistema";

                if(isset($_POST["checkConectado"])){
                    //Criar cookies com os dados do usuário
                    //Cookies com a duração de 1h = 3600 segundos
                    //Armazena o e-mail do usuário

                    setcookie("usermail", $user['email'], time() + 3600);
                    //Armazena o nome do usuário
                    setcookie("username", $user['user_name'], time() + 3600);

                    echo "Checkbox de permanecer conectado foi selecionada";
                }

                $_SESSION["user"] = $user['user_name'];
                $_SESSION["logado"] = TRUE;

                if($user['type'] == 1){
                    header("Location:../produto/todos-produtos.php");
                }else{
                    header("Location:../administrador/todosProdutos.php");
                }
                
            }
           
            else{
                $_SESSION["msg_login"] = "E-mail ou senha incorretos";
                header("Location:login.php"); //Redirecionando para a página de login;
            }
        }else{
            echo "Banco de dados não funcinou";
        }
        //fecha a conexão
        $pdo = null;

    }catch(PDOException $e){
        print "Erro!: ". $e->getMessage()."<br>\n";
    }
?>
