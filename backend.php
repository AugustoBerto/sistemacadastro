<?php

// Configurando e criando conexão com o banco de dados 
$host = "localhost";
$username = "root";
$password = "";
$database = "sistema";

$connect = new mysqli($host, $username, $password, $database);

// Verifica se houve algum erro na conexão
if ($connect->connect_error) {
    die("Conexão falhou: " . $connect->connect_error);
}

// Login: Compara e valida os valores do banco de dados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $connect->query($sql);

    // Confirmação de login
    if ($result->num_rows > 0) {
        echo "Login bem-sucedido!";
    } else {
        echo "Email ou senha incorretos.";
    }
}

// Registro: Consulta e Insere valores no banco de dados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verifica se o email já existe no banco de dados
    $check_email = "SELECT * FROM users WHERE email='$email'";
    $email_check = $connect->query($check_email);

    if ($email_check->num_rows > 0) {
        echo "Este email já está cadastrado.";
    } else {
        $register = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

        // Confirmação de registro
        if ($connect->query($register) === TRUE) {
            echo "Usuário registrado com sucesso!";
        } else {
            echo "Erro ao registrar usuário: " . $connect->error;
        }
    }
}

$connect->close();

// :)