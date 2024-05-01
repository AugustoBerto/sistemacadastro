<?php
// Importa as configurações
include ("../vendor/autoload.php");
include ("../includes/config.php");
include ("../includes/connect.php");

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
            $message = "Login bem-sucedido!";
        } else {
            $message = "Email ou senha incorretos";
        }
    } else {
        $message = "Email não cadastrado";
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
        $message = "Este email já está cadastrado";
    } else {
        // Insere os dados na tabela
        $register = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

        // Executa o INSERT e verifica se foi bem-sucedido
        if ($connect->query($register) === TRUE) {
            $message = "Usuário registrado com sucesso!";
        } else {
            $message = "Erro ao registrar usuário: " . $connect->error;
        }
    }
}

// Fecha conexão
$connect->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/forgot.css">
    <link rel="stylesheet" href="../assets/css/colors.css">
    <title>Recuperação de Senha</title>
</head>

<body>
    <div class="container">
        <form class="form">
            <?php if (!empty($message)): ?>
                <p><?php echo $message; ?></p>
            <?php endif; ?>
            <a href="../index.php" class="mobile-text">Voltar para tela de login</a>
        </form>
    </div>
</body>

</html>

</html>