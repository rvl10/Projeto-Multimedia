<?php

//Dados do banco de dados
define("DB_HOST", "localhost");
define("DB_NAME", "projeto_multimedia");
define("DB_USER", "root");
define("DB_PASS", "");

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

//Conexao com Banco de Dados
return new PDO(sprintf("mysql:host=%s;dbname=%s", DB_HOST, DB_NAME), DB_USER, DB_PASS);
