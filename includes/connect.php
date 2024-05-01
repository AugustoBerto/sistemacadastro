<?php

// Conecta ao banco de dados utilizando os parâmetros de conexão (config.php)
$connect = new mysqli(M_HOST, M_USER, M_PASS, M_DBNAME);

// Verifica se houve erro na conexão
if ($connect->connect_error) {
    die("Conexão falhou: " . $connect->connect_error);
}