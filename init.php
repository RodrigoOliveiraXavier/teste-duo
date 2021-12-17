<?php

//Define a constante com a raiz do projeto
define('__PATH__', __DIR__);

//Arquivo com os dados do banco de dados
$config_dir = 'config.ini';

//Valida se o arquivo existe
if (!file_exists($config_dir)) {
  echo 'Arquivo de conexão com o banco de dados não localizado!';
  die;
}

//Lê os dados do arquivo
$db_config = parse_ini_file($config_dir, true);

$port = $db_config['port'] ?? '3306';
$host = $db_config['host'];
$name = $db_config['name'];
$user = $db_config['user'];
$pass = $db_config['pass'];

//Monta a string de conexão PDO
$conecta_pdo = "mysql:host=$host;port=$port;dbname=$name";

//Monta a conexão com o banco de dados
try {
  $conn = new PDO($conecta_pdo, $user, $pass);  //Cria conexão PDO
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Seta os atributos de erros
  $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
} catch (PDOException $error) {
  echo "Falha na conexão com o banco de dados, Erro: <b>" . $error->getMessage() . "</b> Código do erro: " . $error->getCode();
  die;
}
