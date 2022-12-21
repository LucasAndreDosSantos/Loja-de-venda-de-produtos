<?php 

if(!isset($_SESSION))
    session_start();

//ATENÇÃO: APP_HOST: a partir do servidor(pasta htdocs), qual a pasta que App está localizada
define('APP_HOST'       , $_SERVER['HTTP_HOST'] . "/Semana 13");
define('PATH', realpath('./'));
define('IMG', "http://".APP_HOST."/app/imagens/");
define('TITLE'          , "Funko Store!");
define('DB_HOST'        , "localhost");
define('DB_USER'        , " ");
define('DB_PASSWORD'    , " ");
define('DB_NAME'        , "db_store");
define('DB_DRIVER'      , "mysql");
define('DB_PORT'        , "3306");


?>
