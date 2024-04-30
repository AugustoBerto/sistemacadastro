<?php

// Parâmetros de conexão
$host = "localhost";
$username = "root";
$password = "";
$database = "sistema";

// Conecta ao banco de dados utilizando os parâmetros de conexão
$connect = new mysqli($host, $username, $password, $database);

// Verifica se houve erro na conexão
if ($connect->connect_error) {
    die("Conexão falhou: " . $connect->connect_error);
}

// Login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {

    // Captura os dados do formulário (Login)
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    // Verifica se o email fornecido existe na tabela (users)
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $connect->query($sql);

    // Validação
    if ($result->num_rows > 0) {
        // Captura os dados do usuário
        // Verifica se a senha é valida
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            echo "Login bem-sucedido!";
        } else {
            echo "Email ou senha incorretos";
        }
    } else {
        echo "Email não cadastrado";
    }
}

// Cadastro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {

    // Captura os dados do formulário (cadastro)
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing da senha

    // Consulta o email na tabela (users)
    $check_email = "SELECT * FROM users WHERE email='$email'";
    $email_check = $connect->query($check_email);

    // Verifica se o email já está em uso
    if ($email_check->num_rows > 0) {
        echo "Este email já está cadastrado";
    } else {
        // Insere os dados na tabela
        $register = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

        // Executa o INSERT e verifica se foi bem-sucedido
        if ($connect->query($register) === TRUE) {
            echo "Usuário registrado com sucesso!";
        } else {
            echo "Erro ao registrar usuário: " . $connect->error;
        }
    }
}

// Fecha conexão
$connect->close();

// :)