<?php
// Importa as configurações
include ("../includes/config.php");
include ("../includes/connect.php");

// Verifica se o formulário de redefinição de senha foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['token'])) {
    $token = $_POST['token'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Atualiza a senha na tabela de usuários
    $update_sql = "UPDATE users SET password='$password', reset_token=NULL WHERE reset_token='$token'";
    if ($connect->query($update_sql) === TRUE) {
        $message = "Senha redefinida com sucesso!";
    } else {
        $message = "Erro ao redefinir senha: " . $connect->error;
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